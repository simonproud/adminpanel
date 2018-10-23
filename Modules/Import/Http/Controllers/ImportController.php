<?php

namespace Modules\Import\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Importer;
use Module;
use Schema;
use Modules\Import\Entities\ImportData;
use Modules\Import\Jobs\ImportData as ImportJobs;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('import::index');
    }

    public function parseImport(Request $request)
    {
        $csv_data = [];
        if ($path = $request->file('csv_file')->store('imports')){
            $import_data_file = ImportData::create([
                'original_filename' => $request->file('csv_file')->getClientOriginalName(),
                'main_filename' => '/var/www/html/storage/app/'.$path,
                'import_header' => $request->has('header'),
                'module' => "",
                'import_data' => "",

            ]);
        }

        if($request->has('header')){
            $header = true;

        }else{
            $header = false;
        }
        $modules = Module::allEnabled();
        foreach ($modules as $module){
            $fields[$module->getLowerName()] = $this::getModelFields($module);
        }
        $fields = json_encode($fields);

        $importer = Importer::make('Csv');
        $importer->load('/var/www/html/storage/app/'.$path);
        $collection = array_slice($importer->getCollection()->toArray(), 0 , 3);

        foreach ($collection as $key=>$collect){
            $strf = [];
            $str = explode('|', $collect[0]);
            if($key == 0){
                $headlinesdd = explode('|', $collect[0]);
                continue;
            }else{
            foreach ($str as $keyf=>$item) {
                $strf[$headlinesdd[$keyf]] = $item;
                }
            }
            $import_data[] = $strf;
        }

        $footer = [];
        foreach ( $headlinesdd as $item){
            $footer[] ="FOOT_".$item;
            $headitems[] = $item;
        }
        $hfields = json_encode($headitems);
        $import_data = json_encode($import_data);
        $footer = json_encode($footer);
        $path = json_encode('/'.(string)$path);
        $import_data_file = $import_data_file->id;
        return view('import::import_fields', compact('import_data','path', 'import_data_file', 'fields', 'header', 'hfields', 'footer'));
    }

    public function updateImport(Request $request){
        $request = $request->all();
        $items = '';

        foreach ($request as $key=> $item){
            $request = json_decode($key, true);
        }

        $req = ImportData::find($request['item']);

        $req->import_data = $request['fields'];
        $req->module = $request['module'];


        if($req->save()){
            ImportJobs::dispatch($req);
        }

        return json_encode(['status' => 'TRUE']);
    }
    public function getModelFields($module){
        $tableNames = [];
        $tableNames[] = ['text' => 'Выберите поле', 'value' =>'none', 'selected' => true];
        $models = $this->getModels('../Modules/'.$module->getStudlyName().'/Entities');
        foreach ($models as $model){
            $modelclass = '\\Modules\\'.$module->getStudlyName().'\\Entities\\'.$model;
            $modelIn = new $modelclass;
            if($modelIn->imported){
            //

                $tableNames[] = ['value' => $model, 'text'=> $model, 'disabled' => true];
                foreach($modelIn->getFillable() as $field){
                    $tableNames[] = ['value' => $model.":".$field, 'text'=>$field];
                }
                $cstmFields = $this->getCustomFields($module, $model);
                foreach ($cstmFields as $fld){
                    $tableNames[] = ['text' => 'CSTM::'.$fld['description'], 'value' => $model.'::CSTM::'.$fld['code']];
                }
            $tableNames[] = ['text' => 'Добавить как дополнительное свойство', 'value' => $model.':additional'];

          //  $tableNames[$modelIn->getTable()."_info"] = Schema::getColumnListing($modelIn->getTable()."_info");
            }
        }
        return $tableNames;
    }
    public function getModels($path){
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..' or $result === '.gitkeep') continue;
            $filename = $result;
            if (is_dir($filename)) {
                $out = array_merge($out, getModels($filename));
            }else{
                $out[] = substr($filename,0,-4);
            }
        }
        return $out;
    }

    public  function getCustomFields($module, $m){
        $model = config($module->getLowerName().'.cstm_models.'.$m);
        $modelclass = '\\Modules\\'.$module->getStudlyName().'\\Entities\\'.$model;
        $modelIn = $modelclass::all();

       return $modelIn;
    }




}
