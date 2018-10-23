@extends('layouts.default')

@section('content')
  <div class="panel panel-inverse" data-sortable-id="ui-widget-1">
    <div class="panel-heading">
      <div class="panel-heading-btn">
        <b-button href="{{ url()->previous() }}" size="xs" variant="outline-danger">Отмена</b-button>
        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
           data-click="panel-expand">
          <i class="fa fa-expand"></i>
        </a>
      </div>
      <h4 class="panel-title">Редактировать заявку</h4>
    </div>
    <div class="panel-body">
        <lead-create userslist="{{json_encode($users)}}" <?if(isset($_REQUEST['lead'])){?>idlead="{{$_REQUEST['lead']}}"<?}else{?>idlead="null"<?}?> cstmfields="{{json_encode($cstm_fields)}}"></lead-create>
    </div>
  </div>
@endsection
