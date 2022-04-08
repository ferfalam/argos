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

    <x-tab-container title="app.menu.payments"> 
        <x-slot name="btns">
            <button class="btn btn-cs-blue addDocs m-t-10 m-b-10 " id="show-payment-modal" style="">
                <i class="fa fa-plus"></i> @lang('app.add') @lang('app.menu.payments')</button>
        </x-slot>
        <div class="table-responsive">
            <table class="table"> 
                <thead>
                    <tr>
                        <th>{{ __('app.project') }}</th>
                        <th>{{ __('app.invoice') . '#' }}</th>
                        <th>{{ __('modules.invoices.amount') }}</th>
                        <th>{{ __('modules.payments.paidOn') }}</th>
                        <th>Action</th>
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
                            {{ currency_formatter($payment->amount,'') .' €' }}
                        </td>

                        <td>
                            {{$payment->gateway }}
                        </td>

                        <td>
                            {{-- <a href="{{ route('admin.invoices.download', $invoice->id) }}" data-toggle="tooltip" data-original-title="View" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a> --}}
                            <a href="javascript:;" data-id="{{$payment->id}}" data-toggle="tooltip" data-original-title="Edit" class="btn btn-default btn-circle edit-invoice-modal"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:;" data-id="{{$payment->id}}" data-toggle="tooltip" data-original-title="Delete" class="btn btn-default btn-circle delete-invoice"><i class="fa fa-times"></i></a>
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

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-lg in" id="add-payment-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    <div class="modal fade bs-modal-lg in" id="add-payment-mode" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        $('ul.showClientTabs .clientPayments').addClass('tab-current');

        $('#show-payment-modal').click(function(){
            var url = '{{ route('admin.clients.payments.createPayment', $clientDetail->id)}}';
            $('#modelHeading').html('Add Payment');
            $.ajaxModal('#add-payment-modal',url);
        })

        $('.edit-invoice-modal').click(function(event){
            var url = "{{ route('admin.clients.payments.createPayment', [$clientDetail->id, ':id'])}}";
            var id = $(event.target).data().id;
            url = url.replace(':id', id);
            $('#modelHeading').html('Add Invoice');
            $.ajaxModal('#add-payment-modal',url);
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
