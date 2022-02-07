@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title">  {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 bg-title-right">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ __($pageTitle) }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css') }}">
    <style>
        .radio-inline{
            display: inline-flex;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    @include('sections.gdpr_settings_menu')

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.gdpr.rightToDataProtability')</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'POST']) !!}
                            <label for="">@lang('modules.gdpr.enableCustomerExport')</label>
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio"
                                           class="checkbox"
                                           @if($gdprSetting->enable_export) checked @endif
                                           value="1" name="enable_export">@lang('app.yes')
                                </label>
                                <label class="radio-inline m-l-10">
                                    <input type="radio"
                                           @if($gdprSetting->enable_export==0) checked @endif
                                           value="0" name="enable_export">@lang('app.no')
                                </label>


                            </div>

                            <button type="button" onclick="submitForm();" class="btn btn-cs-green">@lang('app.submit')</button>
                            {!! Form::close() !!}
                        </div>
                    </div>


                    {{-- <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="clearfix"></div>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>


    </div>
    <!-- .row -->

@endsection

@push('footer-script')

    <script>
        function submitForm(){

            $.easyAjax({
                url: '{{route('admin.gdpr.store')}}',
                container: '#editSettings',
                type: "POST",
                data: $('#editSettings').serialize(),
            })
        }

    </script>
@endpush

