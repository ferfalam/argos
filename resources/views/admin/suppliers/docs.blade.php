@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>
</x-main-header>
@endsection


@section('content')

    @include('admin.suppliers.supplier_header')

    @include('admin.suppliers.tabs')

    <x-tab-container title="app.menu.documents">
        <x-slot name="btns">
            <button class="btn btn-cs-blue addDocs m-t-10 m-b-10 " style="" onclick="showAdd()">
                <i class="fa fa-plus"></i> @lang('app.add')</button>
        </x-slot>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="70%">@lang('app.name')</th>
                        <th>@lang('app.action')</th>
                    </tr>
                </thead>
                <tbody id="employeeDocsList">
                    @forelse($supplierDocs as $key=>$supplierDoc)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td width="70%">{{ ucwords($supplierDoc->name) }}</td>
                            <td>
                                <a href="{{ route('admin.suppliers-docs.download', $supplierDoc->id) }}"
                                data-toggle="tooltip" data-original-title="Download"
                                class="btn btn-default btn-circle"><i
                                            class="fa fa-download"></i></a>
                                <a target="_blank" href="{{ $supplierDoc->file_url }}"
                                data-toggle="tooltip" data-original-title="View"
                                class="btn btn-info btn-circle"><i
                                            class="fa fa-search"></i></a>
                                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-file-id="{{ $supplierDoc->id }}"
                                data-pk="list" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center p-30">@lang('messages.noDocsFound')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-tab-container>
        
    <!-- .row -->
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="edit-column-form" role="dialog" aria-labelledby="myModalLabel"
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
    <script>
        function showAdd() {
            var url = "{{ route('admin.suppliers-docs.quick-create', [$supplierDetail->id]) }}";
            $.ajaxModal('#edit-column-form', url);
        }

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

                    var url = "{{ route('admin.suppliers-docs.destroy',':id') }}";
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
                                $('#employeeDocsList').html(response.html);
                            }
                        }
                    });
                }
            });
        });

        $('ul.showClientTabs .clientDocs').addClass('tab-current');
    </script>
@endpush
