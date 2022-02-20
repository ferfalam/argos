@extends('layouts.super-admin')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            @include('sections.ctrl_button')
            <h4 class="page-title" style="min-width: max-content" style="font-weight: bold"> {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
@endpush

@section('content')

    <div class="row">

        <div class="col-xs-12">
            <div class="panel-4">
                <div class="panel-heading">
                    <h2 style=" ">@lang('app.listofsuperadmin')</h2>
                    <a href="{{ route('super-admin.super-admin.create') }}"
                        class="btn btn-cs-blue">@lang('app.addsuperadmin')</a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table
                            class="table table-bordered table-hover toggle-circle default footable-loaded footable bold-head"
                            id="users-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('app.lastnamefirstname')</th>
                                    <th>@lang('app.email')</th>
                                    <th>@lang('app.telephone')</th>
                                    <th>@lang('app.profil')</th>
                                    <th>@lang('app.action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/respoovensive.bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/a0d393d9e6.js"></script>
    <script>
        $(function() {
            var table = $('#users-table').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: '{!! route('super-admin.super-admin.data') !!}',
                language: {
                    "url": "<?php echo __('app.datatable'); ?>"
                },
                "fnDrawCallback": function(oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'profile',
                        name: 'profile'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });


            $('body').on('click', '.sa-params', function() {
                var id = $(this).data('user-id');
                swal({
                    title: "@lang('messages.sweetAlertTitle')",
                    text: "@lang('messages.confirmation.recoverSuperAdmin')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "@lang('messages.deleteConfirmation')",
                    cancelButtonText: "@lang('messages.confirmNoArchive')",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {

                        var url = "{{ route('super-admin.super-admin.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        var token = "{{ csrf_token() }}";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {
                                '_token': token,
                                '_method': 'DELETE'
                            },
                            success: function(response) {
                                if (response.status == "success") {
                                    $.unblockUI();
                                    var total = $('#totalSuperAdmin').text();
                                    $('#totalSuperAdmin').text(parseInt(total) -
                                        parseInt(1));
                                    table._fnDraw();
                                }
                            }
                        });
                    }
                });
            });



        });
    </script>
@endpush
