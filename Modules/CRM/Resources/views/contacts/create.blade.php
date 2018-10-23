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
            <h4 class="panel-title">Создать контакт</h4>
        </div>
        <div class="panel-body">
            <contact-create></contact-create>
        </div>
    </div>
@endsection
