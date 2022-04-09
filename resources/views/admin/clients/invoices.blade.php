@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>
</x-main-header>
@endsection


@section('content')
    <style>
        .row{
            display: flex;
        }
    </style>

    @include('admin.clients.client_header')
    @include('admin.clients.tabs')
    

    <x-tab-container title="app.menu.invoices">
        <x-slot name="btns">
            <button class="btn btn-cs-blue addDocs m-t-10 m-b-10 " id="show-invoice-modal" style="">
                <i class="fa fa-plus"></i> @lang('app.add') @lang('app.menu.invoices')</button>
        </x-slot>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.invoices.project')</th>
                    <th>N° @lang('app.menu.invoices')</th>
                    <th>@lang('app.date')</th>
                    <th>@lang('modules.invoices.amount') HT</th>
                    <th>@lang('modules.invoices.amount') TVA</th>
                    <th>@lang('modules.invoices.amount') TTC</th>
                    <th>@lang('app.status')</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                @forelse($invoices as $key=>$invoice)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $invoice->project_name}}</td>
                        <td>{{ $invoice->invoice_number}}</td>
                        <td>{{ $invoice->issue_date}}</td>
                        <td>{{ $invoice->sub_total}}</td>
                        <td>{{ $invoice->tva}}</td>
                        <td>{{ $invoice->total}}</td>
                        <td>{{ __('modules.invoices.'.$invoice->status)}}</td>
                        <td>
                            <a href="javascript:;" data-id="{{$invoice->id}}" data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-circle edit-invoice-modal"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:;" data-id="{{$invoice->id}}" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-circle delete-invoice"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">@lang('messages.noInvoiceFound')</td>
                    </tr>
                @endforelse
                </tbody>
                <tbody id="timer-list">
            </table>
        </div>
    </x-tab-container>

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-lg in" id="add-invoice-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
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
                    <button type="button" class="btn btn-success">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-lg in" id="add-sell-type" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
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
                    <button type="button" class="btn btn-success">Save changes</button>
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
        $('ul.showClientTabs .clientInvoices').addClass('tab-current');

        $('#show-invoice-modal').click(function(){
            var url = '{{ route('admin.clients.invoices.createInvoice', [$clientDetail->id])}}';
            $('#modelHeading').html('Add Invoice');
            $.ajaxModal('#add-invoice-modal',url);
        })
        $('.edit-invoice-modal').click(function(event){
            var url = "{{ route('admin.clients.invoices.createInvoice', [$clientDetail->id, ':id'])}}";
            var id = $(event.target).data().id;
            url = url.replace(':id', id);
            $('#modelHeading').html('Add Invoice');
            $.ajaxModal('#add-invoice-modal',url);
        })

        $('body').on('click', '.delete-invoice', function(e) {
        var id = $(this).data('id');
        var url = "{{ route('admin.delete-invoice',':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token, '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    window.location.reload()
                }
            }
        });
        e.preventDefault();
    });
    </script>
@endpush