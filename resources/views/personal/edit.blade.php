@extends('layouts.default')

@section('content')


			<div class="card">
				<div class="card-header">
					@if(isset($userInfo['FIRST_NAME']))
						{{$userInfo['FIRST_NAME']}}  {{$userInfo['SECOND_NAME']}}
					@else
						Заполните анкету полностью
					@endif
				</div>
				<div class="card-body">

					<form action="{{route('personal.saveme')}}" method="POST" enctype="multipart/form-data">
					@csrf
						@php
							$i = 0

						@endphp
						<div class="row">
							@foreach($fields as $f=>$field)

								<div class="col-md-6">
									<div class="form-group">
										<label for="{{$field['code']}}">{{$field['code']}}</label>
										<input type="{{$field['type']}}" name="{{$field['code']}}" value="@isset($userinfo[$field['code']]) {{$userinfo[$field['code']]}} @endisset" class="form-control" id="{{$field['code']}}" aria-describedby="{{$field['code']}}_HELP" @if($field['require'] == 1) required @endif placeholder="Введите {{$field['code']}}">
										<small id="{{$field['code']}}_HELP" class="form-text text-muted">@if($field['require'] == 1)Обязательно к заполнению @else Не обязательно к заполнению@endif</small>
									</div>
								</div>

								@php
									$i++;
									if($i >= 2){
								@endphp
									</div><div class="row">
								@php
								$i = 0;}
								@endphp
							@endforeach
						</div>


					<input type="submit" class="btn btn-outline-success" value="Сохранить">
					<a href="{{ url()->previous() }}" class="btn btn-default">Назад</a>
					</form>

                </div>

			</div>

@endsection
