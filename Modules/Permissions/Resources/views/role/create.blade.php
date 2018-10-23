@extends('layouts.default')

@section('content')

            <div class="card">
			
                <div class="card-header">Create ROLE FORM</div>

                <div class="card-body">
				
					<form method="POST" action="{{route('permissions.role.create')}}">
					@csrf
					  <div class="form-group">
						<label for="ROLE_NAME">Имя роли</label>
						<input type="text" class="form-control" name="ROLE_NAME" id="ROLE_NAME" required="required" aria-describedby="ROLE_NAME_HELP" placeholder="Редактор">
						<small id="ROLE_NAME_HELP" class="form-text text-muted">Название автоматически транслитерируется в латиницу</small>
					  </div>
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
							  <input class="form-check-input" type="checkbox" name="perm[{{$permission->name}}]" id="i_{{$permission->name}}">
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
@endsection
