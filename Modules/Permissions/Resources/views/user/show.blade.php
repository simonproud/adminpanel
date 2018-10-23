@extends('layouts.default')

@section('content')
 
			<div class="card">
				<div class="card-header">Просмотр пользователя {{$user->email}}</div>
					<div class="card-body">
						<form method="POST" action="{{route('permissions.user.update', ['user' => $user->id])}}">
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
										<input class="form-check-input" type="checkbox" name="perm[{{$permission->name}}]" id="i_{{$permission->name}}"
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
       
@endsection
