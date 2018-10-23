@extends('layouts.default')

@section('content')
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>Всего заявок</h4>
                    <p></p>
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-link"></i></div>
                <div class="stats-info">
                    <h4>В этом месяце</h4>
                    <p>+20.44%</p>
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-users"></i></div>
                <div class="stats-info">
                    <h4>За месяц</h4>
                    <p>1,291,922</p>
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-danger">
                <div class="stats-icon"><i class="fa fa-ruble-sign"></i></div>
                <div class="stats-info">
                    <h4>Не обработанных заявок</h4>
                    <p>4 987 </p>
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
    <div class="panel panel-inverse" data-sortable-id="ui-widget-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <b-button href="/crm/clients/create" size="xs" variant="outline-success">Создать клиента</b-button>
                <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                   data-click="panel-expand">
                    <i class="fa fa-expand"></i>
                </a>
            </div>
            <h4 class="panel-title">Клиенты</h4>
        </div>
        <div class="panel-body">

            <clients-table-component></clients-table-component>
        </div>
    </div>

@stop

