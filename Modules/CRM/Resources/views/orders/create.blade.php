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
            <h4 class="panel-title">Создать заказ</h4>
        </div>
        <div class="panel-body">
            <?
            $lead['id'] = (string)$lead['id'];
            $lead['user_id'] = (string)$lead['user_id'];
            ?>
            <order-create userslist="{{json_encode($users)}}" req="{{json_encode($_GET)}}" lead="{{json_encode($lead)}}" cstmfields="{{json_encode($cstm_fields)}}"></order-create>
        </div>
    </div>
@endsection
