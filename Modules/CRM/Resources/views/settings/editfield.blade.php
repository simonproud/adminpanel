@extends('layouts.default')

@section('content')
    <div class="panel panel-inverse" data-sortable-id="ui-widget-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                   data-click="panel-expand">
                    <i class="fa fa-expand"></i>
                </a>
            </div>
            <h4 class="panel-title">Отредактировать поле {{$req['q']}}</h4>
        </div>
        <div class="panel-body">
            <form action="/crm/settings/savefield" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="model" value="{{$req['model']}}">
                <input type="hidden" name="id" value="{{$item['id']}}">
                <div class="form-group row m-b-15">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control m-b-5" placeholder="Код поля" value="{{$item['code']}}" name="code">
                        </div>
                        <div class="checkbox checkbox-css m-b-20">
                            <input type="checkbox" name="require" <?=($item['require'] == 1)?'checked':''?> id="nf_checkbox_css_1">
                            <label for="nf_checkbox_css_1">Require</label>
                        </div>

                        <div class="form-group">
                            <select name="type" class="form-control text-inverse">
                                <option <?=($item['type'] == 'text')?'selected':''?>>text</option>
                                <option <?=($item['type'] == 'tel')?'selected':''?>>tel</option>
                                <option <?=($item['type'] == 'email')?'selected':''?>>email</option>
                                <option <?=($item['type'] == 'textarea')?'selected':''?>>textarea</option>
                                <option <?=($item['type'] == 'usertype')?'selected':''?>>usertype</option>
                                <option <?=($item['type'] == 'integer')?'selected':''?>>integer</option>
                                <option <?=($item['type'] == 'link_to_model')?'selected':''?>>link_to_model</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="permission" placeholder="Название группы доступов" value="{{$item['permission']}}">
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Описание">{{$item['description']}}</textarea>
                        </div>
                        <div class="checkbox checkbox-css m-b-20">
                            <input type="checkbox" name="active" id="nf_checkbox_css_2">
                            <label for="nf_checkbox_css_2" <?=($item['active'] == 1)?'checked':''?>>Active</label>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control m-b-5" name="order" value="{{$item['order']}}" placeholder="Сортировка" min="0">
                        </div>
                        <input type="submit" class="btn btn-success" value="Сохранить">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
