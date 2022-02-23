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
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/summernote/dist/summernote.css') }}">
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
                <div class="panel-heading">@lang('modules.gdpr.rightOfAccess')</div>

                <div class="panel-body">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    {!! Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'POST']) !!}
                                    <label for="">@lang('modules.gdpr.allowLead')</label>
                                    <div class="form-group">
                                        <label class="radio-inline">
                                            <input type="radio"
                                                   class="checkbox"
                                                   @if($gdprSetting->public_lead_edit) checked @endif
                                                   value="1" name="public_lead_edit">@lang('app.yes')
                                        </label>
                                        <label class="radio-inline m-l-10">
                                            <input type="radio"
                                                   @if($gdprSetting->public_lead_edit==0) checked @endif
                                                   value="0" name="public_lead_edit">@lang('app.no')
                                        </label>


                                    </div>

                                    <button type="button" onclick="submitForm();" class="btn btn-cs-green">@lang('app.submit')</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>

            </div>
        </div>


    </div>
    <!-- .row -->

@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/summernote/dist/summernote.min.js') }}"></script>
    <script>
        $('.summernote').summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ["view", ["fullscreen"]]
            ]
        });
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

