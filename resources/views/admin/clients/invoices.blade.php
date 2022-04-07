@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>
</x-main-header>
@endsection


@section('content')

    @include('admin.clients.client_header')
    @include('admin.clients.tabs')
    

    <x-tab-container title="app.menu.invoices">
        <x-slot name="btns">
            <button class="btn btn-cs-blue addDocs m-t-10 m-b-10 " id="show-invoice-modal" style="">
                <i class="fa fa-plus"></i> @lang('app.add') @lang('app.menu.invoices')</button>
        </x-slot>
        <ul class="list-group" id="invoices-list">
            @forelse($invoices as $invoice)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-7">
                            @lang('app.invoice') # {{ $invoice->invoice_number }}
                        </div>
                        <div class="col-md-2">
                            {{ currency_formatter($invoice->total ,$invoice->currency_symbol) }} 
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.invoices.download', $invoice->id) }}" data-toggle="tooltip" data-original-title="Download" class="btn btn-default btn-circle"><i class="fa fa-download"></i></a>
                            <span class="m-l-10">{{ $invoice->issue_date->format('d M, y') }}</span>
                        </div>
                    </div>
                </li>
                @if($loop->last)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-7 ">
                                <span class="pull-right">@lang('modules.invoices.totalUnpaidInvoice')</span>
                            </div>
                            <div class="col-md-2 text-danger">
                                {{ currency_formatter($invoices->sum('total')-$invoices->sum('paid_payment'),$invoice->currency_symbol) }} 
                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                    </li>
                @endif
            @empty
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-7">
                            @lang('modules.invoices.noInvoiceForClient')
                        </div>
                    </div>
                </li>
            @endforelse
        </ul>
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
            var url = '{{ route('admin.clients.invoices.createInvoice', $clientDetail->id)}}';
            $('#modelHeading').html('Add Invoice');
            $.ajaxModal('#add-invoice-modal',url);
        })
    </script>
@endpush