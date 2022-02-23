@extends('layouts.super-admin')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 bg-title-left">
            @include('sections.ctrl_button')
            <h4 class="page-title">  @lang('app.company')
                {{-- <span class="text-info b-l p-l-10 m-l-5">{{ $totalCompanies }}</span> <span
                class="font-12 text-muted m-l-5"> @lang('modules.dashboard.totalCompanies')</span> --}}
            </h4>   
        </div>
        <!-- /.page title -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
    <link rel="stylesheet" href="//gitcdn.link/repo/wintercounter/Protip/master/protip.min.css">
    <style>
        .table-admin-images img{
            width: 30px;
            height: 29px
        }
    </style>
@endpush

{{--TODO ce fichier à été modifier (Suppression du filtre)--}}
{{--@section('filter-section')--}}
{{--<div class="row"  id="ticket-filters">--}}
{{--    <form action="" id="filter-form">--}}
{{--        <div class="col-xs-12">--}}
{{--            <div class="form-group">--}}
{{--                <label class="control-label">@lang('app.package')</label>--}}
{{--                <select class="form-control selectpicker" name="package" id="package" data-style="form-control">--}}
{{--                    <option value="all">@lang('app.all')</option>--}}
{{--                    @foreach( $packages as $package)--}}
{{--                        <option value="{{ $package->id }}">{{ ucwords($package->name) }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12">--}}
{{--            <div class="form-group">--}}
{{--                <label class="control-label">@lang('modules.invoices.type') @lang('app.package') </label>--}}
{{--                <select class="form-control selectpicker" name="type" id="type" data-style="form-control">--}}
{{--                    <option value="all">@lang('app.all')</option>--}}
{{--                    <option value="monthly">@lang('app.monthly')</option>--}}
{{--                    <option value="annual">@lang('app.annual')</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12">--}}
{{--            <div class="form-group">--}}
{{--                <label class="control-label col-xs-12">&nbsp;</label>--}}
{{--                <button type="button" id="apply-filters" class="btn btn-success col-md-6"><i class="fa fa-check"></i> @lang('app.apply')</button>--}}
{{--                <button type="button" id="reset-filters" class="btn btn-inverse col-md-6"><i class="fa fa-refresh"></i> @lang('app.reset')</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</div>--}}
{{--@endsection--}}
{{--TODO END)--}}
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="panel-4">
                <div class="panel-heading">
                    <h2>@lang('app.listOfCompanies')</h2>
                    <a href="{{route('super-admin.companies.create')}}" class="btn btn-cs-blue">@lang('app.Addsociete')</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="users-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('app.name')</th>
                                @if(module_enabled('Subdomain'))
                                    <th>Domain</th>
                                @else
                                    <th>@lang('app.administrator')</th>
                                @endif
                                <th>@lang('app.city')</th>
                                <th>@lang('app.country')</th>
                                <th>@lang('app.telephone')</th>
                                <th>@lang('app.action')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="packageUpdateModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <form class="ajax-form" id="update-company-form">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading">Change Package</span>
                    </div>
                    <div class="modal-body">
                        Loading...
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-check"></i> @lang('app.update')</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.back')</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- .row -->
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="offlineMethod" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="projectCategoryModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}
@endsection

@push('footer-script')
    <script src="//gitcdn.link/repo/wintercounter/Protip/master/protip.min.js"></script>
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $.protip();
            console.log('protip');
        });
        $(function() {
            var modal = $('#packageUpdateModal');
            tableLoad();
            {{--TODO ce fichier à été modifier (Suppression du filtre)--}}
            // $('#reset-filters').click(function () {
            //     $('#filter-form')[0].reset();
            //     $('#filter-form').find('select').selectpicker('render');
            //     tableLoad();
            // });
            // var table;
            // $('#apply-filters').click(function () {
            //     tableLoad();
            // });
            //
            //
            // $('.toggle-filter').click(function () {
            //     $('#ticket-filters').toggle('slide');
            // })

            {{--$('body').on('click', '.package-update-button', function () {--}}
            {{--    modal.find('.modal-body').html('Loading...');--}}
            {{--    const url = '{{ route('super-admin.companies.edit-package.get', ':companyId') }}' . replace(':companyId', $(this).data(--}}
            {{--        'company-id'--}}
            {{--    ));--}}
            {{--    $.easyAjax({--}}
            {{--        type: 'GET',--}}
            {{--        url: url,--}}
            {{--        blockUI: false,--}}
            {{--        messagePosition: "inline",--}}
            {{--        success: function (response) {--}}
            {{--            if (response.status === "success" && response.data) {--}}
            {{--                modal.find('.modal-body').html(response.data).closest('#packageUpdateModal').modal('show');--}}
            {{--                tableLoad();--}}
            {{--            } else {--}}
            {{--                modal.find('.modal-body').html('Loading...').closest('#packageUpdateModal').modal('show');--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
    {{--TODO END)--}}


$('#offlineMethod').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
})
});

tableLoad = () => {
//TODO packageName packageType ont été remplacer par all et all dans l'url de la request ajax
// var packageName = $('#package').val();
// var packageType = $('#type').val();

table = $('#users-table').dataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    stateSave: true,
    destroy: true,
    //TODO url
    ajax: '{!! route('super-admin.companies.data') !!}?package=all&type=all',
    language: {
        "url": "<?php echo __("app.datatable") ?>"
    },
    "fnDrawCallback": function( oSettings ) {
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'company_name', name: 'company_name' },
        @if(module_enabled('Subdomain'))
            { data: 'sub_domain', name: 'sub_domain' },
        @else
            { data: 'company_email', name: 'company_email' },
        @endif
        { data: 'package', name: 'package.name', 'sortable':false },
        { data: 'status', name: 'status' },
        { data: 'details', name: 'details', 'sortable':false },
        // { data: 'licence_expire_on', name: 'licence_expire_on' },
        // { data: 'last_login', name: 'last_login'},
        { data: 'action', name: 'action' }
    ]
});
}
$('body').on('click', '.sa-params', function(){
var id = $(this).data('user-id');
swal({
    title: "@lang('messages.sweetAlertTitle')",
    text: "@lang('messages.confirmation.recoverDeleteCompany')",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "@lang('messages.deleteConfirmation')",
    cancelButtonText: "@lang('messages.confirmNoArchive')",
    closeOnConfirm: true,
    closeOnCancel: true
}, function(isConfirm){
    if (isConfirm) {

        var url = "{{ route('super-admin.companies.destroy',':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token, '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
                    var total = $('#totalCompanies').text();
                    $('#totalCompanies').text(parseInt(total) - parseInt(1));
                    table._fnDraw();
                }
            }
        });
    }
});
});

@if(module_enabled('Subdomain'))
$('body').on('click', '.domain-params', function(){
var company_id = $(this).data('company-id');
var company_url = $(this).data('company-url');
swal({
    title: "Are you sure?",
    text: `You want to notify company admins about company Login URL <br> Company URL: <a href="${company_url}"><b>${company_url}</b></a>`,
    html:true,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, Notify it!",
    cancelButtonText: "No, cancel please!",
    closeOnConfirm: true,
    closeOnCancel: true
}, function(isConfirm){
    if (isConfirm) {

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: "{{route('notify.domain')}}",
            data: {'_token': token, 'company_id': company_id},
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
                    table._fnDraw();
                }
            }
        });
    }
});
});
@endif

$('body').on('click', '.verify-user', function(){
var userId = $(this).data('user-id');
swal({
    title: "Are you sure?",
    text: `User will be able to login if you will verify.`,
    html:true,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, Verify!",
    cancelButtonText: "No, cancel please!",
    closeOnConfirm: true,
    closeOnCancel: true
}, function(isConfirm){
    if (isConfirm) {

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: "{{route('super-admin.companies.verifyUser')}}",
            data: {'_token': token, 'user_id': userId},
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
                    table._fnDraw();
                }
            }
        });
    }
});
});


$('#addDefaultLanguage').click( function () {
var url = '{{ route('super-admin.companies.default-language')}}';
$('#modelHeading').html('New Company Default language');
$.ajaxModal('#projectCategoryModal', url);
})

$('body').on('click', '.view-company', function () {
$(".right-sidebar").slideDown(50).addClass("shw-rside");

var id = $(this).data('company-id');
var url = "{{ route('super-admin.companies.show',':id') }}";
url = url.replace(':id', id);

$.easyAjax({
    type: 'GET',
    url: url,
    success: function (response) {
        if (response.status == "success") {
            $('#right-sidebar-content').html(response.view);
        }
    }
});
})

$('body').on('click', '#login-as-company', function () {
var id = $(this).data('company-id');
var url = "{{ route('super-admin.companies.loginAsCompany',':id') }}";
url = url.replace(':id', id);

swal({
    title: "@lang('messages.sweetAlertTitle')",
    text: "@lang('messages.loginInfo')",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#28A745",
    confirmButtonText: "@lang('app.login')",
    cancelButtonText: "@lang('app.cancel')",
    closeOnConfirm: true,
    closeOnCancel: true
}, function(isConfirm){
    if (isConfirm) {
        $.easyAjax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status == 'success') {
                    location.href = "{{ route('admin.dashboard') }}"
                }
            }
        });
    }
});
})
var getUrlParameter = function getUrlParameter(sParam) {
var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');

    if (sParameterName[0] === sParam) {
        return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
    }
}
return false;
};
var id = getUrlParameter('id');
console.log(id);
if (id){
$(".right-sidebar").slideDown(50).addClass("shw-rside");
var url = "{{url('super-admin/companies')}}/:id";
url = url.replace(':id', id);

$.easyAjax({
    type: 'GET',
    url: url,
    success: function (response) {
        if (response.status == "success") {
            $('#right-sidebar-content').html(response.view);
        }
    }
});
}
</script>
@endpush