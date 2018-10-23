<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CRM\Entities\ClientCstm;
use Modules\CRM\Entities\ContactCstm;
use Modules\CRM\Entities\LeadCstm;
use Modules\CRM\Entities\OrderCstm;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {


        $fields['fields'] = [
            'id', 'code', 'require', 'type', 'permission', 'description', 'active', 'order', 'create_at', 'updated_at', 'actions'
        ];

        $fields['leads'] = [];
        $leads = LeadCstm::all()->toArray();
        foreach ($leads as $lead){
            $lead['id'] = $lead['id'].'';
            $fields['leads'][] = $lead;
        }

        $fields['contacts'] = [];
        $contacts = ContactCstm::all()->toArray();
        foreach ($contacts as $contact){
            $contact['id'] = $contact['id'].'';
            $fields['contacts'][] = $contact;
        }

        $fields['orders'] = [];
        $orders = OrderCstm::all()->toArray();
        foreach ($orders as $orderv){
            $orderv['id'] = $orderv['id'].'';
            $fields['orders'][] = $orderv;
        }

        $fields['clients'] = [];
        $clients = ClientCstm::all()->toArray();
        foreach ($clients as $client){
            $client['id'] = $client['id'].'';
            $fields['clients'][] = $client;
        }


        $data['fields'] = $fields;
        return view('crm::settings.index', $data);
    }

    public function createfield(Request $request){
        $req = $request->all();
        return view('crm::settings.createfield', $req);
    }
    public function editField(Request $request){
        $req = $request->all();

            $switch = $req['model'];
            switch ($switch) {
                case 'leads':
                    $item = LeadCstm::find($req['q']);
                    break;
                case 'orders':
                    $item = OrderCstm::find($req['q']);
                    break;
                case 'clients':
                    $item = ClientCstm::find($req['q']);
                    break;
                case 'contacts':
                    $item = ContactCstm::find($req['q']);
                    break;
                default:
                    return false;
                    break;

            };

        return view('crm::settings.editfield', ['req' => $req, 'item' => $item]);
    }
    public function deleteField(Request $request){
       $req = $request->all();
        $req['id'] = intval($req['id']);
        $switch = $req['model'];
        switch ($switch) {
            case 'leads':
                $item = LeadCstm::find($req['id']);
                break;
            case 'orders':
                $item = OrderCstm::find($req['id']);
                break;
            case 'clients':
                $item = ClientCstm::find($req['id']);
                break;
            case 'contacts':
                $item = ContactCstm::find($req['id']);
                break;
            default:
                return false;
                break;

        };
        if($item->delete()){
            return json_encode(['status' => 'success']);
        }

        return json_encode(['status' => 'danger']);
    }

    public function saveField(Request $request){
        $req = $request->all();
        if (isset($req['id'])){
        $req['id'] = intval($req['id']);
        }
        $switch = $req['model'];

        if(!isset($req['id'])){
        switch ($switch) {
            case 'leads':
                $item = new LeadCstm;
                break;
            case 'orders':
                $item = new OrderCstm;
                break;
            case 'clients':
                $item = new ClientCstm;
                break;
            case 'contacts':
                $item = new ContactCstm;
                break;
            default:
                return false;
                break;

        }
        }else {
            switch ($switch) {
                case 'leads':
                    $item = LeadCstm::find($req['id']);
                    break;
                case 'orders':
                    $item = OrderCstm::find($req['id']);
                    break;
                case 'clients':
                    $item = ClientCstm::find($req['id']);
                    break;
                case 'contacts':
                    $item = ContactCstm::find($req['id']);
                    break;
                default:
                    return false;
                    break;

            }
        }
            var_dump($req);

        $item->code = $req['code'];
        $item->type = $req['type'];
        $item->permission = ($req['permission'] != null)?$req['permission']:'crm.basic';
        $item->description = $req['description'];
        $item->active = (isset($req['active']))?1:0;
        $item->require = false;
        $item->order = $req['order'];
        if($item->save()){
            $data = json_encode(['status' => 'success', 'text' => 'Поле сохранено']);
        }else{
            $data = json_encode(['status' => 'danger', 'text' => 'Поле не сохранено']);
        }
        return redirect('/crm/settings')->with($data);
    }

}
