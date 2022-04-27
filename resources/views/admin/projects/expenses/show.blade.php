@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title">  {{ __($pageTitle) }} #{{ $project->id }} - <span
                        class="font-bold">{{ ucwords($project->project_name) }}</span></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 text-right bg-title-right">
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-success btn-outline" ><i class="icon-note"></i> @lang('app.edit')</a>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.projects.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('app.menu.invoices')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('admin.projects.show_project_menu')
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <x-main-header>
                <x-slot name="title">
                    @lang('app.menu.expenses')
                </x-slot>
            </x-main-header>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <section id="section-line-3" class="show m-t-20">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('app.menu.suppliers')</th>
                            <th>N° @lang('app.menu.invoices')</th>
                            <th>@lang('app.date')</th>
                            <th>@lang('modules.invoices.amount') HT</th>
                            <th>@lang('modules.invoices.amount') TVA</th>
                            <th>@lang('modules.invoices.amount') TTC</th>
                            <th>@lang('modules.suppliers.balance')</th>
                            <th>@lang('app.status')</th>
                            {{-- <th>@lang('app.action')</th> --}}
                        </tr>
                        </thead>
                        @forelse($project->supplierInvoices as $key=>$invoice)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $invoice->supplierdetails->company_name}}</td>
                                <td>{{ $invoice->invoice_number}}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->issue_date)->format($global->date_format)}}</td>
                                <td>{{ $invoice->sub_total}}</td>
                                <td>{{ $invoice->tva}}</td>
                                <td>{{ $invoice->total}}</td>
                                <td>{{ $invoice->payment ? $invoice->total - $invoice->payment->sum('amount') : $invoice->total}}</td>
                                <td>{{ __('modules.invoices.'.$invoice->status)}}</td>
                                {{-- <td>
                                    <a href="javascript:;" data-id="{{$invoice->id}}" data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-circle edit-invoice-modal"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:;" data-id="{{$invoice->id}}" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-circle delete-invoice"><i class="fa fa-times"></i></a>
                                </td> --}}
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
</section>
        </div>
    </div>

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

@endsection
