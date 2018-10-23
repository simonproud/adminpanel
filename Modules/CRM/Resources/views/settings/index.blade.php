@extends('layouts.default')

@section('content')
    <div class="panel panel-default panel-with-tabs">
        <div class="panel-heading">
            <ul class="nav nav-tabs pull-right">
                <li class="nav-item">
                    <a href="#leads" data-toggle="tab" class="nav-link active">
                        <i class="fa fa-home"></i>
                        <span class="hidden-xs">Лиды</span>
                    </a>
                </li>
                <li  class="nav-item">
                    <a href="#orders" data-toggle="tab" class="nav-link">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="hidden-xs">Заказы</span>
                    </a>
                </li>
                <li  class="nav-item">
                    <a href="#contacts" data-toggle="tab" class="nav-link">
                        <i class="fa fa-user"></i>
                        <span class="hidden-xs">Контакты</span>
                    </a>
                </li>
                <li  class="nav-item">
                    <a href="#clients" data-toggle="tab" class="nav-link">
                        <i class="fa fa-user"></i>
                        <span class="hidden-xs">Клиенты</span>
                    </a>
                </li>
                <li  class="nav-item">
                    <a href="#widgets" data-toggle="tab" class="nav-link">
                        <i class="fab fa-simplybuilt"></i>
                        <span class="hidden-xs">Виджеты</span>
                    </a>
                </li>
            </ul>
            <h4 class="panel-title">Настройки модуля CRM</h4>
        </div>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active show" id="leads">
                <div class="btn-row"><a href="/crm/settings/createfield?q=leads" class="btn btn-success">Создать поле</a></div>
                <div class="row">

                    <fields-cstm-list :vitems="{{json_encode($fields['leads'])}}" :vfields="{{json_encode($fields['fields'])}}"  vimodel="leads"></fields-cstm-list>
                </div>
            </div>
            <div class="tab-pane fade in" id="orders">
                <div class="btn-row"><a href="/crm/settings/createfield?q=orders" class="btn btn-success">Создать поле</a></div>
                <div class="row">
                    <fields-cstm-list :vitems="{{json_encode($fields['orders'])}}" :vfields="{{json_encode($fields['fields'])}}" vimodel="orders"></fields-cstm-list>
                </div>
            </div>
            <div class="tab-pane fade in" id="contacts">
                <div class="btn-row"><a href="/crm/settings/createfield?q=contacts" class="btn btn-success">Создать поле</a></div>
                <div class="row">
                    <fields-cstm-list :vitems="{{json_encode($fields['contacts'])}}" :vfields="{{json_encode($fields['fields'])}}" vimodel="contacts"></fields-cstm-list>
                </div>
            </div>
            <div class="tab-pane fade in" id="clients">
                <div class="btn-row"><a href="/crm/settings/createfield?q=clients" class="btn btn-success">Создать поле</a></div>
                <div class="row">
                    <fields-cstm-list :vitems="{{json_encode($fields['clients'])}}" :vfields="{{json_encode($fields['fields'])}}" vimodel="clients"></fields-cstm-list>
                </div>
            </div>
            <div class="tab-pane fade in" id="widgets">
                Виджеты
            </div>
        </div>
    </div>

@endsection
