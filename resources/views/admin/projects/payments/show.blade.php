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
                    @lang('app.menu.payments')
                </x-slot>
            </x-main-header>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
        <section id="section-line-3" class="show m-t-20">
                <div class="row">
                    <div class="col-xs-12" id="invoices-list-panel">
                        <div class="table-responsive">
                            <table class="table"> 
                                <thead>
                                    <tr>
                                        <th>{{ __('app.menu.clients') }}</th>
                                        <th>N° {{ __('app.invoice') }}</th>
                                        <th>@lang('app.date') @lang('modules.module.invoices')</th>
                                        <th>@lang('app.date') @lang('modules.module.payments')</th>
                                        <th>@lang('modules.payments.amount')  @lang('modules.module.payments')</th>
                                        <th>@lang('modules.payments.paymentMode')</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($project->supplierpayments as $payment)
                                    <tr >
                                        <td>
                                            @if (!is_null($payment->supplier))
                                                {{ ucfirst($payment->supplier->company_name) }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if (!is_null($payment->invoice))
                                                {{ ucfirst($payment->invoice->invoice_number) }}
                                                {{-- <a href="{{ route('admin.all-invoices.show', $payment->invoice_id) }}"></a> --}}
                                            @else
                                                --
                                            @endif     
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($payment->issue_date)->format($global->date_format)}}
                                        </td>
                
                
                                        <td>
                                            {{ \Carbon\Carbon::parse($payment->due_date)->format($global->date_format) }}
                                        </td>
                
                                        <td>
                                            {{ currency_formatter($payment->amount,'') .' €' }}
                                        </td>
                
                                        <td>
                                            {{$payment->gateway }}
                                        </td>
                
                                        {{-- <td>
                                            <a href="{{ route('admin.invoices.download', $invoice->id) }}" data-toggle="tooltip" data-original-title="View" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:;" data-id="{{$payment->id}}" data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-circle edit-invoice-modal"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:;" data-id="{{$payment->id}}" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-circle delete-invoice"><i class="fa fa-times"></i></a>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center">
                                                <div class="empty-space" style="height: 200px;">
                                                    <div class="empty-space-inner">
                                                        <div class="icon" style="font-size:30px"><i class="icon-doc"></i></div>
                                                        <div class="title m-b-15">@lang('messages.noPaymentFound')</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- .row -->

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
