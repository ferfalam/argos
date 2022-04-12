@extends('layouts.app')
@push('head-script')
<style>
    .d-none {
        display: none;
    }

    /* .row{
        display: block !important;
    } */

    .panel{
        box-shadow: none !important;
        border: 1px solid #eeeeee !important;
        border-radius: 6px !important;
        overflow :hidden;
    }

    .panel-body .text-primary{
        margin-top: 0px;
        font-family: "Roboto", sans-serif;
    }
</style>
@endpush

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>
</x-main-header>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <h4 class="text-primary">@lang('zoom::modules.zoomsetting.setting')</h4>
        <form class="ajax-form" method="POST" id="createzoom">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6 ">
                        <div class="form-group">
                            <label class="required">@lang('zoom::modules.zoomsetting.zoomapikey')</label>
                            <input type="password" name="api_key" id="api_key" value="{{$zoom->api_key ?? ''}}" class="form-control">
                            <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label class="required">@lang('zoom::modules.zoomsetting.zoomapisecret')</label>
                            <input type="password" name="secret_key" id="secret_key" value="{{$zoom->secret_key ?? ''}}" class="form-control">
                            <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                </div>
                 
                <div class="row">
                    <div class="col-xs-6 ">
                        <div class="form-group" style="display: none">
                            <label>@lang('zoom::modules.zoomsetting.openZoomApp')</label>
                            <div class="radio-list">
                                <label class="radio-inline p-0">
                                    <div class="radio radio-info">
                                        <input type="radio" name="meeting_app" id="zoom_app" value="zoom_app">
                                        <label for="zoom_app">@lang('app.yes')</label>
                                    </div>
                                </label>
                                <label class="radio-inline">
                                    <div class="radio radio-info">
                                        <input type="radio" name="meeting_app" checked id="in_app" value="in_app">
                                        <label for="in_app">@lang('app.no')</label>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-xs-6">
                        <h3>How to integrate your Zoom Api Key </h3>
                        <ol class="pl-0">
                            <li> Go to <a href="https://marketplace.zoom.us/develop/create" target="_blank">https://marketplace.zoom.us/develop/create</a> with you zoom account
                                credential
                            </li>
                            <li> Create a JWT app to generate your API key & Secret</li>
                            <li>Copy/paste the 2 Api keys </li>
                        </ol>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="mail_from_name">@lang('app.webhook')</label>
                        <p class="text-bold">{{ route('zoom-webhook') }}</p>
                        <p class="text-info">(@lang('zoom::modules.zoomsetting.webhookInfo'))</p>
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <button type="button" id="update-form" class="btn btn-cs-blue"> @lang('app.update')</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('footer-script')
<script>
    $('#update-form').click(function() {
        @if (\App\User::isAdmin(user()->id))
            var url = "{{route('admin.zoom-setting.update', $zoom->id)}}";
        @else
            var url = "{{route('member.zoom-setting.update', $zoom->id)}}";
        @endif

        $.easyAjax({
            url: url,
            container: '#createzoom',
            type: "POST",
            redirect: true,
            data: $('#createzoom').serialize()
        })
    });
</script>

@endpush