@extends('layouts.default')

@section('content')

    <div class="row justify-content-center">
	
        <div class="col-md-3">
		
		
			<div class="card"><div class="card-header">{{$USER_FIRST_NAME}} {{$USER_SECOND_NAME}} <a href="{{route('personal.edit')}}"><i class="far fa-edit"></i></a></div> <div class="card-body">


					<div class="image">
						@isset($USER_AVATAR) <img src="{{$USER_AVATAR}}" alt="" style="max-width:100%;"/>@endisset
					</div>
                </div></div>
		</div>
		 <div class="col-md-9">
		
			<div class="card"><div class="card-header">You will be mine</div> <div class="card-body">

					<table class="table table-profile">
						<thead>
						<tr>
							<th></th>
							<th>
								<h4>@isset($USER_FIRST_NAME){{$USER_FIRST_NAME}}@endisset @isset($USER_SECOND_NAME){{$USER_SECOND_NAME}}@endisset @isset($USER_COUNTRY)<small>{{$USER_COUNTRY}}</small>@endisset</h4>
							</th>
						</tr>
						</thead>
						<tbody>
						@isset($USER_WORKING_POSITION)
						<tr class="highlight">
							<td class="field">Должность</td>
							<td>{{$USER_WORKING_POSITION}}</td>
						</tr>
						<tr class="divider">
							<td colspan="2"></td>
						</tr>
						@endisset

						@isset($USER_PERSONAL_PHONE)
							<tr class="">
								<td class="field">Контактный телефон</td>
								<td><a href="tel:{{$USER_PERSONAL_PHONE}}">{{$USER_PERSONAL_PHONE}}</a></td>
							</tr>

						@endisset
						@isset($USER_CONTACT_PHONE)
							<tr class="">
								<td class="field">Дополнительный телефон</td>
								<td><a href="tel:{{$USER_CONTACT_PHONE}}">{{$USER_CONTACT_PHONE}}</a></td>
							</tr>

						@endisset
						@isset($USER_EMAIL)
							<tr class="">
								<td class="field">Контактный E-mail</td>
								<td><a href="mailto:{{$USER_EMAIL}}">{{$USER_EMAIL}}</a></td>
							</tr>
						@endisset
						@isset($USER_ADDRESS)

						<tr class="divider">
							<td colspan="2"></td>
						</tr>
						<tr class="highlight">
							<td class="field">Домашний адрес</td>
							<td>{{$USER_ADDRESS}}</td>
						</tr>
						<tr class="divider">
							<td colspan="2"></td>
						</tr>
						@endisset
						@isset($USER_VK)
							<tr class="">
								<td class="field">VK:</td>
								<td><a href="{{$USER_VK}}" target="_blank">{{$USER_VK}}</a></td>
							</tr>

						@endisset
						@isset($USER_INSTAGRAM)
							<tr class="">
								<td class="field">Instagram:</td>
								<td><a href="{{$USER_INSTAGRAM}}" target="_blank">{{$USER_INSTAGRAM}}</a></td>
							</tr>

						@endisset
						@isset($USER_SKYPE)
							<tr class="">
								<td class="field">Skype:</td>
								<td><a href="skype:{{$USER_SKYPE}}" target="_blank">{{$USER_SKYPE}}</a></td>
							</tr>

						@endisset
						</tbody>
					</table>
                </div></div>
		</div>

	</div>
<!--
	<div class="panel panel-inverse" data-sortable-id="ui-widget-1">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
				   data-click="panel-expand">
					<i class="fa fa-expand"></i>
				</a>
				
			</div>
			<h4 class="panel-title">Блоки статистики</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
			<div class="widget widget-stats bg-gradient-teal m-b-10">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
				<div class="stats-content">
					<div class="stats-title">TODAY'S VISITS</div>
					<div class="stats-number">7,842,900</div>
					<div class="stats-progress progress">
						<div class="progress-bar" style="width: 70.1%;"></div>
					</div>
					<div class="stats-desc">Better than last week (70.1%)</div>
				</div>
			</div>
				</div>
				<div class="col-md-4">
			<div class="widget widget-stats bg-gradient-teal m-b-10">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
				<div class="stats-content">
					<div class="stats-title">TODAY'S VISITS</div>
					<div class="stats-number">7,842,900</div>
					<div class="stats-progress progress">
						<div class="progress-bar" style="width: 70.1%;"></div>
					</div>
					<div class="stats-desc">Better than last week (70.1%)</div>
				</div>
			</div>
			</div><div class="col-md-4">
			<div class="widget widget-stats bg-gradient-teal m-b-10">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
				<div class="stats-content">
					<div class="stats-title">TODAY'S VISITS</div>
					<div class="stats-number">7,842,900</div>
					<div class="stats-progress progress">
						<div class="progress-bar" style="width: 70.1%;"></div>
					</div>
					<div class="stats-desc">Better than last week (70.1%)</div>
				</div>
			</div>
			</div>
			</div>
	</div>
	</div>-->

@endsection
