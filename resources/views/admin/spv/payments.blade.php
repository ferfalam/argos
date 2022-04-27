@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>
</x-main-header>
@endsection


@section('content')

    @include('admin.spv.spv_header')

    @include('admin.spv.tabs')

    <x-tab-container title="app.menu.payments"> 
        
        <div class="table-responsive">
            <table class="table"> 
                <thead>
                    <tr>
                        <th>{{ __('app.project') }}</th>
                        <th>{{ __('app.invoice') . '#' }}</th>
                        <th>{{ __('modules.invoices.amount') }}</th>
                        <th>{{ __('modules.payments.paidOn') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr >
                        <td>
                            @if (!is_null($payment->project))
                                <a href="{{ route('admin.projects.show', $payment->project_id) }}">{{ ucfirst($payment->project->project_name) }}</a>
                            @else
                                --
                            @endif
                        </td>
                        <td>
                            @if (!is_null($payment->invoice))
                                <a href="{{ route('admin.all-invoices.show', $payment->invoice_id) }}">{{ ucfirst($payment->invoice->invoice_number) }}</a>
                            @else
                                --
                            @endif     
                        </td>
                        <td>
                            {{ currency_formatter($payment->amount,'') .' ('.$payment->currency->currency_code . ')' }}
                        </td>

                        <td>
                            {{ $payment->paid_on->format($global->date_format . ' ' . $global->time_format) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
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
    </x-tab-container>

@endsection

@push('footer-script')
    <script>
        $('ul.showClientTabs .clientPayments').addClass('tab-current');
    </script>
@endpush
