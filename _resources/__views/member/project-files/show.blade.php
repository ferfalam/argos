@extends('layouts.member-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title">  {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 bg-title-right">
            <ol class="breadcrumb">
                <li><a href="{{ route('member.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">@lang('app.menu.projects')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')

<link rel="stylesheet" href="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.css') }}">
    <style>
        .file-bg {
            height: 150px;
            overflow: hidden;
            position: relative;
        }
        .file-bg .overlay-file-box {
            opacity: .9;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            text-align: center;
        }

        .d-box{
            display: -webkit-box;
        }

        .tab-content{
            display: grid;
        }
        
        .nav-link{
            margin-bottom: 0px;
        }

        .list-group-item{
            display: -webkit-box;
        }

        .list-group-item .row{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-default,
        .btn-circle{
            padding: 6px 0px !important;
        }
    </style>
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('member.projects.show_project_menu')
        </div>
    </div>

    <div class="row m-b-20 d-box">
        <div class="col-xs-12">
            <x-main-header title="modules.projects.files">
                <x-slot name="title">
                    @lang('modules.projects.files')
                </x-slot>

                <x-slot name="btns">
                    <a href="javascript:;" id="show-dropzone"
                    class="btn btn-cs-green"><i class="ti-upload"></i> @lang('modules.projects.uploadFile')</a>
                </x-slot>
            </x-main-header>
        </div>
    </div>

    
    <div class="row m-b-20 hide" id="file-dropzone">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($upload)
                        <form action="{{ route('member.files.store') }}" class="dropzone"
                              id="file-upload-dropzone">
                            {{ csrf_field() }}
        
                            {!! Form::hidden('project_id', $project->id) !!}
        
                            <input name="view" type="hidden" id="view" value="list">
        
                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger">@lang('messages.storageLimitExceedContactAdmin')</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <section id="section-line-3" class="show">
                <div class="row">
                    <div class="col-xs-12" id="files-list-panel">
                        <div class="panel panel-default">
                            <ul class="nav customtab nav-tabs" role="tablist" id="list-tabs">
                                <li role="presentation" class="active nav-item" data-pk="list"><a href="#list" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> List</span></a></li>
                                <li role="presentation" class="nav-item" data-pk="thumbnail"><a href="#thumbnail" class="nav-link thumbnail" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Thumbnail</span></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="list">
                                    <ul class="list-group" id="files-list">
                                        @forelse($project->files as $file)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        {{ $file->filename }}
                                                    </div>
                                                    <div class="col-md-3">

                                                        <a target="_blank" href="{{ $file->file_url }}" data-toggle="tooltip" data-original-title="View" class="btn btn-info btn-circle">
                                                            <i class="fa fa-search"></i>
                                                        </a>

                                                        @if(is_null($file->external_link))
                                                        <a href="{{ route('member.files.download', $file->id) }}" data-toggle="tooltip" data-original-title="Download" class="btn btn-default btn-circle" style="padding: 6px 0px !important;">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                        @endif

                                                        @if($file->user_id == $user->id || $project->isProjectAdmin || $user->cans('edit_projects'))
                                                            &nbsp;&nbsp;
                                                            <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-file-id="{{ $file->id }}" class="btn btn-danger btn-circle sa-params" data-pk="list"><i class="fa fa-times"></i></a>
                                                        @endif
                                                        <span class="m-l-10">{{ $file->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        @lang('messages.noFileUploaded')
                                                    </div>
                                                </div>
                                            </li>
                                        @endforelse

                                    </ul>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="thumbnail">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- .row -->

@endsection

@push('footer-script')
<script src="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.js') }}"></script>
<script>
    $('#show-dropzone').click(function () {
        $('#file-dropzone').toggleClass('hide show');
    });

    $("body").tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    @if($upload)
        // "myAwesomeDropzone" is the camelized version of the HTML element's ID
        Dropzone.options.fileUploadDropzone = {
        paramName: "file", // The name that will be used to transfer the file
//        maxFilesize: 2, // MB,
        dictDefaultMessage: "@lang('modules.projects.dropFile')",
        accept: function (file, done) {
            done();
        },
        init: function () {
            this.on("success", function (file, response) {
                var viewName = $('#view').val();

                if(response.status == 'fail') {
                    $.showToastr(response.message, 'error');
                    return;
                }

                if(viewName == 'list') {
                    $('#files-list-panel ul.list-group').html(response.html);
                } else {
                    $('#thumbnail').empty();
                    $(response.html).hide().appendTo("#thumbnail").fadeIn(500);
                }
            })
        }
    };
    @endif
    $('body').on('click', '.sa-params', function () {
        var id = $(this).data('file-id');
        var deleteView = $(this).data('pk');
        swal({
            title: "@lang('messages.sweetAlertTitle')",
            text: "@lang('messages.confirmation.deleteFile')",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "@lang('messages.deleteConfirmation')",
            cancelButtonText: "@lang('messages.confirmNoArchive')",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                var url = "{{ route('member.files.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE', 'view': deleteView},
                    success: function (response) {
                        console.log(response);
                        if (response.status == "success") {
                            $.unblockUI();
                            if(deleteView == 'list') {
                                $('#files-list-panel ul.list-group').html(response.html);
                            } else {
                                $('#thumbnail').empty();
                                $(response.html).hide().appendTo("#thumbnail").fadeIn(500);
                            }
                        }
                    }
                });
            }
        });
    });

    $('.thumbnail').on('click', function(event) {
        event.preventDefault();
        $('#thumbnail').empty();
        var projectID = "{{ $project->id }}";
        $.easyAjax({
            type: 'GET',
            url: "{{ route('member.files.thumbnail') }}",
            data: {
                id: projectID
            },
            success: function (response) {
                $(response.view).hide().appendTo("#thumbnail").fadeIn(500);
            }
        });
    });


    $('#list-tabs').on("shown.bs.tab",function(event){
        var tabSwitch = $('#list').hasClass('active');
        if(tabSwitch == true) {
            $('#view').val('list');
        } else {
            $('#view').val('thumbnail');
        }
    });

    $('ul.showProjectTabs .projectFiles').addClass('tab-current');

</script>
@endpush
