<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\User;
use App\UserField;
use App\UserInfo;
use Auth;
 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
 
class PersonalController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');

		
    }
	public function index(){
  			return view('personal.index');
	}
	
	public function getEdit(Request $request){
		$result = [];
        $result['userinfo'] = $request->session()->get('userinfo');

        $fields = UserField::where('active', '1')->orderBy('f_order', 'asc')->get()->toArray();
        $result['fields'] =  $fields;

        return view('personal.edit', $result);
	}
	public function postSaveme(Request $request){
			$ID = Auth::user()->id; 
			$result['id'] = $ID;
			$userFields = UserInfo::where('user_id', $ID)->get();
			if(!empty($userFields)	&& count($userFields) > 0){
				foreach($userFields as $field){
					$fields[$field->key] = $field->value;
				}
				if($fields && !empty($fields)){
					$result['userInfo'] = $fields; 
				}
			}
			foreach($request->all() as $key=>$value){

                if(is_file($value)){
                   $baseinfo = pathinfo($value);
                    $info = Storage::putFileAs(
                        'public/images',  $value, $key.'_'.Auth::user()->id.'_'.$baseinfo['basename']
                    );
                    $infoAr  = pathinfo($info);
                   $value="/storage/images/".$infoAr['filename'];
                }
				if($key=='_token'){continue;}
				
				if(isset($result['userInfo'][$key])){
					//TO UPDATE
					if($value != null && !empty($value) && $value != ''){
						if(UserInfo::where([['user_id', '=', $ID], ['key', '=', $key]])->update(['value' => $value]) == true){
							$statuses[] = 'TRUE';
						}else{
							$statuses[] = 'FALSE';
						}
					}
				}else{
					//TO CREATE IF SETTED
					if($value != '' && $value != null && isset($value)){
						$data['user_id'] = $ID;
						$data['key'] = $key;
						$data['value'] = $value;
						$data['created_at'] = date('Y-m-d H:i:s');
						$data['updated_at'] = date('Y-m-d H:i:s');
						
						if(UserInfo::insert($data) == true){
							$statuses[] = 'TRUE';
						}else{
							$statuses[] = 'FALSE';
						}
					}
				}
				
			}
			
			if(isset($statuses) && !in_array('FALSE', $statuses) ){
                $data['status_code'] = 'success';
                $data['status_text'] = 'PROFILE IS UPDATED';
			}else{
                $data['status_code'] = 'danger';
                $data['status_text'] = 'Houston, we have a problem';
			}

        $data = serialize($data);
			
			
			//return view('personal.edit', $result);
			return redirect(route('personal.index'))->with('status', $data);
		
	}
	public function getSettings(Request $request){
        $this->middleware('personalinfo');
        $result['userinfo'] = $request->session()->get('userinfo');

        return view('personal.settings', $result);
	}
}
