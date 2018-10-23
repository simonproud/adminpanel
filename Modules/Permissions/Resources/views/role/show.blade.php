@extends('layouts.default')

@section('content')
            <div class="card">
			
                <div class="card-header">UPDATE ROLE "{{$roleName}}"   <a href="{{route('permissions.role.delete', ['name' => $roleName])}}" class="btn btn-danger">Удалить роль</a></div>

                <div class="card-body">
				
				<form method="POST" action="{{route('permissions.role.update', ['name' => $roleName])}}">
					@csrf
					  	@php
								$i = 0;
						@endphp
						<div class="row">
						@foreach($permissions as $permission)
							@php
								$i++;
							@endphp
							<div class="col-md-4">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" value="{{$permission->name}}" name="perm[]" id="i_{{$permission->name}}"
								@php
								if(in_array($permission->name, $allowedPerms)){echo('checked');}
								@endphp
							  >
							  <label class="form-check-label" for="i_{{$permission->name}}">
								{{$permission->name}}
							  </label>
							</div>
							</div>
							@if($i > 2) 
								</div><div class="row">
							@php
								$i = 0;
							@endphp
							@endif
							
						@endforeach
						</div>
						<input type="submit" class="btn btn-success">
					</form>
                </div>
				
            </div>
			<br/> 
			<div class="card">
				<form method="POST" action="{{route('permissions.role.deleteuser', ['name' => $roleName])}}">
					<div class="card-header">Список пользователей участвующих в роли&nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addToRole">Добавить пользователя в роль</button> <input type="submit" class="btn btn-danger" value="Удалить пользователей из роли"></div>
					<div class="card-body">
						@csrf
							@php
									$i = 0;
							@endphp
							<div class="row">
							
							@foreach($users as $user)
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="{{$user->id}}" name="users[]" id="i_{{$user->email}}" >
								  <label class="form-check-label" for="i_{{$user->email}}   ">
									{{$user->email}}   
								  </label>
								</div>
								 
							@endforeach
							</div>
						
					</div>
				</form>	
			</div>
@endsection

<div class="modal fade " id="addToRole" tabindex="-1" role="dialog" aria-labelledby="addToRoleLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
		<form method="POST" action="{{route('permissions.role.adduser', ['name' => $roleName])}}">
		  <div class="modal-header">
			<h5 class="modal-title" id="addToRoleLabel">Выберите пользователей</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
				
				@csrf
				@foreach($allUsers as $user)
					<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="{{$user->id}}" name="users[]" id="i_{{$user->email}}">
								  <label class="form-check-label" for="i_{{$user->email}}   ">
									{{$user->email}}   
								  </label>
					</div>
					 
				@endforeach
				
		  </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			<input type="submit" class="btn btn-primary" value="Добавить">
		</div>
	  </form>
    </div>
  </div>
</div>