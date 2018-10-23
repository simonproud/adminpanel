<?php

namespace Modules\Permissions\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Permission::create(['name' => 'permission:permissions.access.edit']);
 * Permission::create(['name' => 'permission:permissions.role.create']);
 * Permission::create(['name' => 'permission:permissions.role.edit']);
 * Permission::create(['name' => 'permission:permissions.role.delete']);
 * Permission::create(['name' => 'permission:permissions.role.show']);
 **/
		
	
		
class PermissionController extends Controller
{
	public function __construct(){
		$this->middleware(['auth' ]);
        $this->middleware('userinfo');

	}

	public function index(Request $request){
        //$this->middleware(['permission:permission:basic']);

		$roles = Role::all();
		$allUsers = User::all();
        $data['roles'] = $roles;
		$data['allUsers'] = $allUsers;


		return view('permissions::index', $data);
	}
	public function getMenu(){

    }
	public function getRoleCreate(Request $request){

        $this->middleware(['permission:permission:role-create']);

		$permissions = Permission::all();
		
		$permissionsAr = [];
		
		foreach($permissions as $key=>$value){
			//print_r($value->name);
			$value = $value->name;
			$permissionsAr[$value]  = explode (".", $value);
		}
		$data['permissions'] = $permissions;
		$data['permissionsAr'] = $permissionsAr;
		
		return view('permissions::role.create', $data);
	}
	
	
	public function postRoleDeleteUser($name, Request $request){
        $this->middleware(['permission:permission:role-edit']);
		$req = $request->all();
		foreach($req['users'] as $id){
			$user = User::find($id);
			$user->removeRole($name);
		}
		$data['status_code'] = 'success';
		$data['status_text'] = 'Пользователь отключен от группы "'.$name.'"';
		$data = serialize($data);
		return redirect(route('permissions.role.show', ['name' => $name]))->with('status', $data);
		
	}
	public function postRoleAddUser($name, Request $request){
        $this->middleware(['permission:permission:role-edit']);
		$req = $request->all();
		foreach($req['users'] as $id){
			$user = User::find($id);
			$user->assignRole($name);
		}
		$data['status_code'] = 'success';
		$data['status_text'] = 'Пользователь присоединён к группе "'.$name.'"';
		$data = serialize($data);
		return redirect(route('permissions.role.show', ['name' => $name]))->with('status', $data);
		
	}
	
	public function postUserUpdate($id, Request $request){
	    $user = User::find($id);
        $perms = [];
        $allowedPerms = [];
	     $allowedPermsAr = $user->permissions()->get();
        foreach($allowedPermsAr as $perm){
            $allowedPerms[] = $perm->name;
        }
	   if(isset($request->perm)){ foreach ($request->perm as $key=>$perm){
	        $perms[] = $key;
        }}

	    $user->syncPermissions($perms);
	    return redirect(route('permissions.user.show', ['id' => $id]));
    }
	public function getUserDetail($id, Request $request){

        $allowedPerms = [];
		$user = User::find($id);
        $permissions = Permission::all();
        $allowedPermsAr = $user->permissions()->get();
        foreach($allowedPermsAr as $perm){
            $allowedPerms[] = $perm->name;
        }
		return view('permissions::user.show', ['user' => $user, 'permissions' => $permissions, 'allowedPerms' => $allowedPerms]);
	}
	
	public function getRoleDetail($name, Request $request){

        $this->middleware(['permission:permission:role-show']);
		$permissionsArFull = [];
		$allowedPerms = [];
		
		$permissions = Permission::all();
		foreach($permissions as $key=>$value){
			//print_r($value->name);
			$value = $value->name;
			$permissionsArFull[$value]  = explode (".", $value);
		}
		//
		//
		$role = Role::findByName($name);
		$users = $role->users()->get();
		$allUsers = User::all();
		$allowedPermsAr = $role->permissions()->get();
		foreach($allowedPermsAr as $perm){
			$allowedPerms[] = $perm->name;
		}
		
		$data['allowedPerms'] = $allowedPerms;
		
		 
		$data['permissions'] = $permissions;
		$data['users'] = $users;
		$data['allUsers'] = $allUsers;
		$data['permissionsArFull'] = $permissionsArFull;
		
		
		
		$permissions = Role::findByName($name)->permissions()->get();
		
		if(count($permissions) > 0){
			foreach($permissions as $key=>$perm){
				$perm = $perm->name;
				$permissionsAr[$perm] = explode (".", $perm);
			}
		$data['permissionsAr'] = $permissionsAr;
		}
		$data['roleName'] = $name;

		return view('permissions::role.show', $data);
	}
	
	
	
	public function postRoleUpdate($name, Request $request){
      //  $this->middleware(['permission:permission:role-edit']);
		/*if($name == 'admin'){
			
			$data['status_code'] = 'danger';
			$funny = ['Вы пытаетесь стереть Богов?', 'Не боитесь кары небес?', 'Сейчас придёт злой админ...', 'Во имя Луны! Да будет закрыта эта дверь', 'Серьезно?', 'Да ладно?'];
			$data['status_text'] = $funny[array_rand ($funny)];
			
			$data = serialize($data);
			return redirect(route('permissions.index'))->with('status', $data);
		}*/
		$role = Role::findByName($name);
		$permissions = $request->all();
		
		if(!isset($permissions['perm'])){$permissions['perm'] = [];}
		
		$role->syncPermissions($permissions['perm']);
		
		$data['status_code'] = 'success';
		$data['status_text'] = 'Роль обновлена';
		$data = serialize($data);
		
		return redirect(route('permissions.index'))->with('status', $data);
	}
	
	public function postRoleCreate(Request $request){
        $this->middleware(['permission:permission:role-create']);
		$requestAll = $request->all();
		$name = $requestAll['ROLE_NAME'];
		
		$role = Role::create(['name' => $name]);
		
		if(!empty($requestAll['perm']) && isset($requestAll['perm'])){
		foreach($requestAll['perm'] as $key=>$permission){
			$permissions[] = $key;
		}
		$role->syncPermissions($permissions);
		}
			$data['status_code'] = 'success';
			$data['status_text'] = 'Роль создана';
			$data = serialize($data);
		return redirect(route('permissions.index'))->with('status', $data);
	}
	
	

	public function roleDelete($name){
        $this->middleware(['permission:permission:role-delete']);
		if($name != 'admin'){
			Role::findByName($name)->delete();
			$data['status_code'] = 'success';
			$data['status_text'] = 'Роль удалена';
		}else{
			$data['status_code'] = 'danger';
			$funny = ['Вы пытаетесь стереть Богов?', 'Не боитесь кары небес?', 'Сейчас придёт злой админ...', 'Во имя Луны! Да будет закрыта эта дверь', 'Серьезно?', 'Да ладно?'];
			$data['status_text'] = $funny[array_rand ($funny)];
		}
		$data = serialize($data);
		return redirect(route('permissions.index'))->with('status', $data);
	}
}