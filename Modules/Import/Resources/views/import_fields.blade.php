@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12 ui-sortable">
            <div class="panel panel-inverse">
                <div class="panel-heading">Импорт</div>
                <div class="panel-body"  id="idimport-parse-panel">
                     <import-parse-panel :import_data="{{ $import_data }}" :hasheader="{{$header}}" import_id="{{$import_data_file}}" :filepath="{{$path}}" :ifields="{{$fields}}" :hfields="{{$hfields}}" :tfooter="{{$footer}}"></import-parse-panel>
                </div>
            </div>
        </div>
    </div>
@endsection