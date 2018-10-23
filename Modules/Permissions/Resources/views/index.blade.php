@extends('layouts.default')

@section('content')		
				<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Роли</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Пользователи</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  
		<div class="btn-group mt-3 mb-3" role="group" aria-label="Basic example">
			<a href="{{route('permissions.role.create')}}" class="btn btn-primary">Создать роль</a> 
		</div>
		<div class="row">
		@foreach($roles as $role)
		<div class="col-md-3">
		<div class="card" style="width: 18rem;">
		  <div class="card-body">
			<h5 class="card-title">{{$role->name}}</h5>
			<!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
			<a href="{{route('permissions.role.show', ['name' => $role->name])}}" class="btn btn-primary">Заглянуть</a>
		  </div>
		</div>
		</div>
		@endforeach
		</div>
		
		
  </div>
  <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
	<div class="row">
		@foreach($allUsers as $user)
			<div class="col-md-3">
			<div class="card" style="width: 18rem;">
			  <div class="card-body">
				<h5 class="card-title">{{$user->email}}</h5>
				<!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
				<a href="{{route('permissions.user.show', ['name' => $user->id])}}" class="btn btn-primary">Заглянуть</a>
			  </div>
			</div>
			</div>
		@endforeach
	</div>
  </div>

</div>


@endsection
