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
                <li><a href="{{ route('admin.country.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('app.update')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
 <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">   
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                
                <div class="panel-heading">
                    @lang("modules.countrySettings.updateTitle")
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            {!! Form::open(['id'=>'updateCurrency','class'=>'ajax-form','method'=>'PUT']) !!}
                            <div class="form-group">
                                <label for="name">@lang("modules.countrySettings.countryName")</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $country->name }}">
                            </div>
                            <div class="form-group" >
                                <label for="iso">@lang("modules.countrySettings.countrySymbol")</label>
                                <input type="text" class="form-control" id="iso" name="iso" value="{{ $country->iso }}">
                            </div>
                            <div class="form-group">
                                <label for="iso3">@lang("modules.countrySettings.countryCode")</label>
                                <input type="text" class="form-control" id="iso3" name="iso3" value="{{ $country->iso3 }}">
                            </div>
                            <div class="form-group">
                                <label for="phonecode">@lang("modules.countrySettings.countryPhoneCode")</label>
                                <input type="text" class="form-control" id="phonecode" name="phonecode" value="{{ $country->phonecode }}">
                            </div>
    
                            <button type="submit" id="save-form" class="btn btn-success waves-effect waves-light m-r-10">
                                @lang('app.save')
                            </button>
                            {{-- <button type="reset" class="btn btn-inverse waves-effect waves-light">@lang('app.reset')</button> --}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

@endsection

@push('footer-script')

<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script>
    $('#save-form').click(function () {
        $.easyAjax({
            url: '{{route('admin.country.update', $country->id )}}',
            container: '#updateCurrency',
            type: "POST",
            data: $('#updateCurrency').serialize()
        })
    });
</script>
@endpush

