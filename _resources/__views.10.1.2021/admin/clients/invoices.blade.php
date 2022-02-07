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
@endsection

@push('footer-script')
    <script>
        $('ul.showClientTabs .clientInvoices').addClass('tab-current');
    </script>
@endpush