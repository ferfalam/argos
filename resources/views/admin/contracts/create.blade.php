@extends('layouts.app')
@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/summernote/dist/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.css') }}">

<style>
    .select-organisme-form{
        display: flex;
        align-items: center;
        justify-content: end;
    }

    .select-organisme-form > input{
        margin: 0;
        margin-right: 5px;
        width: 20px;
        height: 20px;
    }

    .select-organisme-form > label{
        margin: 0;
        margin-right: 15px;
        font-size: 22px !important;
        font-weight: 500
    }
    

</style>

@endpush
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
                <li><a href="{{ route('admin.contracts.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('app.addNew')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel panel-inverse">
                    <div class="panel-heading"> @lang('app.add') @lang('app.menu.contract')</div>


                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                        {!! Form::open(['id'=>'createContract','class'=>'ajax-form','method'=>'POST']) !!}
                            <div class="row" style="display: flex;align-items: end;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label required" for="contract_name">@lang('app.contract.name')</label>
                                        <input type="text" class="form-control" id="contract_name" name="contract_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group select-organisme-form">
                                            <input type="radio" name="type-organisme" value="client" id="organisme-client" checked><label class="control-label" for="company_name">@lang('app.client')</label>
                                            <input type="radio" name="type-organisme" value="supplier" id="organisme-supplier"><label class="control-label" for="company_name">@lang('app.supplier')</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group client">
                                            <label class="control-label required" for="company_name">@lang('app.contract.organisme')</label>
                                            <select class="select2 form-control" data-placeholder="@lang('app.client')" name="client" id="clientID">
                                                @foreach($clients as $client)
                                                    <option value="{{ 'client '.$client->id }}" >{{ ucwords($client->company_name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group supplier" style="display: none">
                                            <label class="control-label required" for="company_name">@lang('app.contract.organisme')</label>
                                            <select class="select2 form-control" data-placeholder="@lang('app.client')" name="client" id="clientID" disabled>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ 'supplier '.$supplier->id }}" style="display: none" @if ($suppliers[0]->id == $supplier->id) selected @endif >{{ ucwords($supplier->company_name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group spv" style="display: none">
                                            <label class="control-label required" for="company_name">@lang('app.contract.organisme')</label>
                                            <select class="select2 form-control" data-placeholder="@lang('app.client')" name="client" id="clientID" disabled>
                                                @foreach($spvs as $spv)
                                                    <option value="{{ 'spv '.$spv->id }}" style="display: none" @if ($spvs[0]->id == $spv->id) selected @endif >{{ ucwords($spv->company_name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: flex;align-items: end;">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="subject"  class="control-label required">@lang('app.amount') 
                                            {{-- ({{ $global->currency }}) --}}
                                        </label>
                                        <input type="number" min="0" class="form-control" id="amount" name="amount">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="">
                                        <div class="checkbox checkbox-info">
                                            <input name="no_amount" id="check_amount"
                                                type="checkbox" onclick="setAmount()">
                                            <label for="check_amount">@lang('modules.contracts.noAmount')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  class="control-label required">@lang('modules.contracts.contractType')
                                            <a href="javascript:;"
                                            id="createContractType"
                                            class="btn btn-xs btn-outline btn-success">
                                                <i class="fa fa-plus"></i> @lang('modules.contracts.addContractType')
                                            </a>
                                        </label>
                                        <select class="select2 form-control" data-placeholder="@lang('app.client')" id="contractType" name="contract_type">
                                            @foreach($contractType as $type)
                                                <option
                                                        value="{{ $type->id }}">{{ ucwords($type->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: flex;align-items: end;">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label required">@lang('modules.timeLogs.startDate')</label>
                                        <input id="start_date" name="start_date" type="text"
                                                class="form-control"
                                                value="{{ \Carbon\Carbon::today()->format($global->date_format) }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">@lang('modules.timeLogs.endDate')</label>
                                        <input id="end_date" name="end_date" type="text" class="form-control"
                                            value="{{ \Carbon\Carbon::today()->format($global->date_format) }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="">
                                        <div class="checkbox checkbox-info" onclick="setEndDate()">
                                            <input name="no_enddate" id="no_enddate" type="checkbox">
                                            <label for="no_enddate">@lang('modules.contracts.noEndDate')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="required">Signataire</label>
                                        <select class="select2 form-control" data-placeholder="@lang('app.client')" name="user_id" id="user_id">
                                            @foreach($company_users as $u)
                                                <option value="{{ $u->id }}" >{{ ucwords($u->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Programme</label>
                                        <select class="select2 form-control" data-placeholder="@lang('app.client')" name="project_id" id="project_id">
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}" >{{ ucwords($project->project_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: flex;align-items: end;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('modules.contracts.alternateAddress')</label>
                                        <textarea class="form-control" name="alternate_address" rows="1"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('modules.lead.mobile')</label>
                                        <input type="tel" name="mobile" id="mobile" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>@lang('modules.clients.officePhoneNumber')</label>
                                        <input type="text" name="office_phone" id="office_phone"   class="form-control">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.city')</label>
                                            <input type="text" name="city" id="city"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.state')</label>
                                            <input type="text" name="state" id="state"   class="form-control">
                                        </div>
                                    </div>
                            </div> --}}
                            <div class="row" style="display: flex;align-items: end;">
                                <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.country')</label>
                                            <select name="country" id="country" class="form-control select2">
                                                @foreach ($countries as $country)
                                                    <option value=" {{ $country->name }} ">
                                                        {{ ucfirst(strtolower($country->name)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.postalCode')</label>
                                            <div style="display: flex; align-items: center;">
                                                <select name="city" id="city" class="form-control select2">
                                                    <option value="" disabled>@lang('app.cp')</option>
                                                    @foreach ($tla as $t)
                                                        @if ($t->type == 'city')
                                                            <option value=" {{ $t->name }} ">
                                                                {{ $t->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <a href="javascript:;" class="text-info plus-form" style="margin-left: 10px">
                                                            <img src="{{ asset('img/plus.png') }}" alt="" data-type="city"> </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"  style="display: flex;align-items: end; justify-content:end">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Commentaires</label>
                                            <textarea class="form-control summernote" id="contract_detail" name="contract_detail" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            <div class="row"  style="display: flex;align-items: end;">
                                {{-- <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">@lang('modules.contracts.notes')</label>
                                        <textarea class="form-control summernote" id="description" name="description" rows="4"></textarea>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row"  style="display: flex;align-items: end; margin-bottom:20px">
                                <div class="col-xs-12">
                                    @if($upload)
                                        <button type="button"
                                                class="btn btn-block btn-outline-info btn-sm col-md-2 select-image-button"
                                                style="margin-bottom: 10px;display: none "><i class="fa fa-upload"></i>
                                            File Select Or Upload
                                        </button>
                                        <div id="file-upload-box">
                                            <div class="row" id="file-dropzone">
                                                <div class="col-xs-12">
                                                    <div class="dropzone"
                                                            id="file-upload-edit-dropzone">
                                                        {{ csrf_field() }}
                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple/>
                                                        </div>
                                                        <input name="image_url" id="image_url" type="hidden"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="taskID" id="taskID" value="">
                                    @else
                                        <div class="alert alert-danger">@lang('messages.storageLimitExceed', ['here' => '<a href='.route('admin.billing.packages'). '>Here</a>'])</div>
                                    @endif
                                </div>
                            </div>
                            {{-- @if(isset($contractFiles))
                                <div class="row" id="list">
                                    <ul class="list-group" id="files-list">
                                        @forelse($meetingFiles as $file)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        {{ $file->filename }}
                                                    </div>
                                                    <div class="col-md-3">
                                                            <a target="_blank" href="{{ $file->file_url }}"
                                                                data-toggle="tooltip" data-original-title="View"
                                                                class="btn btn-info btn-circle"><i
                                                                        class="fa fa-search"></i></a>
                                                        @if(is_null($file->external_link))
                                                            &nbsp;&nbsp;
                                                            <a href="{{ route('admin.zoom-meeting-files.download', $file->id) }}"
                                                                data-toggle="tooltip" data-original-title="Download"
                                                                class="btn btn-inverse btn-circle"><i
                                                                        class="fa fa-download"></i></a>
                                                        @endif
                                                        &nbsp;&nbsp;
                                                        <a href="javascript:;" data-toggle="tooltip"
                                                            data-original-title="Delete"
                                                            data-file-id="{{ $file->id }}"
                                                            class="btn btn-danger btn-circle sa-params .file-delete" data-pk="list"><i
                                                                    class="fa fa-times"></i></a>

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
                            @endif --}}

                            <div class="row" style="display: flex;align-items: end; justify-content:end">
                                <button type="submit" id="save-form" class="btn btn-success waves-effect waves-light m-r-10">
                                    @lang('app.save')
                                </button>
                            </div>
                                {{-- <button type="reset" class="btn btn-inverse waves-effect waves-light">@lang('app.reset')</button> --}}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="addModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->.
    </div>
    {{--Ajax Modal Ends--}}
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="taskCategoryModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->.
    </div>
    {{--Ajax Modal Ends--}}
@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.js') }}"></script>
    <script>


        $(".select2").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });



        jQuery('#end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            weekStart: '{{ $global->week_start }}',
            format: '{{ $global->date_picker_format }}',
        });

        $("#start_date").datepicker({
            autoclose: true,
            todayHighlight: true,
            weekStart:'{{ $global->week_start }}',
            format: '{{ $global->date_picker_format }}',
        }).on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#end_date').datepicker('setStartDate', maxDate);
        });

        $('#createContractType').click(function(){
            var url = '{{ route('admin.contract-type.create-contract-type')}}';
            $('#modelHeading').html("@lang('modules.contracts.manageContractType')");
            $.ajaxModal('#taskCategoryModal', url);
        })
        function setAmount() {
            let no_amount = document.getElementById("check_amount").checked;
            if(no_amount == true){
                document.getElementById("amount").value = "0";
            }else{
                document.getElementById("amount").value = "";
            }
        
        }
        function setEndDate() {
            let no_amount = document.getElementById("no_enddate").checked;
            if(no_amount == true){
                document.getElementById("end_date").value = "";
            }else{
                document.getElementById("end_date").value = "{{ \Carbon\Carbon::today()->format($global->date_format) }}";
            }
        
        }
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


    $("#organisme-client").change(function (e) {
        //clientID
        if (e.target.checked) {
            $('.supplier').hide()
            $('.client').show()
            $('.supplier select').prop('disabled', 'disabled');
            $('.client select').prop('disabled', false);
        }
    })
    $("#organisme-supplier").change(function (e) {
        //clientID
        if (e.target.checked) {
            $('.supplier').show()
            $('.client').hide()
            $('.supplier select').prop('disabled', false);
            $('.client select').prop('disabled', 'disabled');
        }
    })

    $('.plus-form').click(function() {
            let target = $(event.target)[0];
            const field = $('#' + target.dataset.type)
            const url = '{{ route('admin.tla.create') }}/' + target.dataset.type;
            $('#modelHeading').html('...');
            $.ajaxModal('#addModal', url);
        })
        @if($upload)
            Dropzone.autoDiscover = false;
            //Dropzone class
            editDropzone = new Dropzone("div#file-upload-edit-dropzone", {
                url: "{{ route('admin.contract-files.multiple-upload') }}",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                paramName: "file",
                maxFilesize: 10,
                maxFiles: 10,
                acceptedFiles: "image/*,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/docx,application/pdf,text/plain,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                autoProcessQueue: false,
                uploadMultiple: true,
                addRemoveLinks: true,
                parallelUploads: 10,
                dictDefaultMessage: "@lang('modules.projects.dropFile')",
                init: function () {
                    editDropzone = this;
                    this.on("success", function (file, response) {
                        if(response.status == 'fail') {
                            $.showToastr(response.message, 'error');
                            return;
                        }
                    })
                }
            });

            editDropzone.on('sending', function (file, xhr, formData) {
                console.log(editDropzone.getAddedFiles().length, 'sending');
                var ids = $('#taskID').val();
                var task_request_id = $('#task_request_id').val();
                formData.append('contract_id', ids);
                //formData.append('task_request_id', task_request_id);
            });

            editDropzone.on('completemultiple', function () {
                var msgs = "@lang('messages.contractAdded')";
                $.showToastr(msgs, 'success');
                var url="{{route('admin.contracts.edit', ':id')}}"
                url = url.replace(':id', $('#task_request_id').val())
                window.location.href = url;
            });
        @endif


        $('#save-form').click(function () {
            // file: (document.getElementById("company_logo").files.length == 0) ? false : true,
            $.easyAjax({
                url: '{{route('admin.contracts.store')}}',
                container: '#createContract',
                type: "POST",
                redirect: true,
                data: $('#createContract').serialize(),
                success: function (response) {
                    var dropzone = 0;
                    @if($upload)
                        dropzone = editDropzone.getQueuedFiles().length;
                    @endif

                    if(dropzone > 0){
                        taskID = response.contract_id;
                        $('#taskID').val(response.contract_id);
                        editDropzone.processQueue();
                    }
                    else{
                        var msgs = "@lang('messages.contractAdded')";
                        $.showToastr(msgs, 'success');
                        var url = "{{ route('admin.contracts.edit',':id') }}";
                        url = url.replace(':id', response.contract_id);
                        window.location.href = url;
                    }
                }
            })
        });
    </script>
@endpush

