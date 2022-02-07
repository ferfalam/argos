@extends('layouts.app')

@section('page-title')
    <x-main-header>
        <x-slot name="title">
            {{ __($pageTitle) }}
        </x-slot>
        <x-slot name="btns">
            @if($company->package->name != 'Gratuit (15 jours)')
                <button type="button" class="btn btn-cs-blue unsubscription" data-type="stripe" title="Unsubscribe Plan"><span class="display-big" >Cancel Account</span></button>
            @else
                <span class="display-big" >Cancel On {{date('Y-m-d',strtotime($company->licence_expire_on))}}</span>
            @endif
                <a href="{{ route('admin.billing.packages') }}" class="btn btn-cs-green">@lang('modules.billing.changePlan')</a>
        </x-slot>
    </x-main-header>
@endsection

@push('head-script')
    <style>
        .f-15 {
            font-size: 15px !important;
            font-weight: 400;
        }

        .row{
            font-weight: 400;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
@endpush


@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                <?php Session::forget('message');?>
            @endif
            @if ($success == 'true')
                <div class="alert alert-success">{{ $message }}</div>
            @endif
            @if ($success == 'false')
                <div class="alert alert-danger">{{ $message }}</div>

            @endif
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    @lang('modules.billing.yourCurrentPlan') ({{  $company->package->name }})
                    @if(!is_null($firstInvoice) && $stripeSettings->api_key != null && $stripeSettings->api_secret != null && $firstInvoice->method == 'Stripe')
                        @if(!is_null($subscription) && $subscription->ends_at == null)
                            <button type="button" class="small-danger-btn waves-effect waves-light unsubscription"
                                    data-type="stripe" title="Unsubscribe Plan"><i
                                        class="fa fa-ban display-small"></i> <span
                                        class="display-big">@lang('modules.billing.unsubscribe')</span></button>
                        @endif
                    @elseif(!is_null($firstInvoice) && $stripeSettings->paypal_client_id != null && $stripeSettings->paypal_secret != null && $firstInvoice->method == 'Paypal')
                        @if(!is_null($paypalInvoice) && $paypalInvoice->end_on == null  && $paypalInvoice->status == 'paid')
                            <button type="button" class="small-danger-btn waves-effect waves-light unsubscription"
                                    data-type="paypal" title="Unsubscribe Plan"><i
                                        class="fa fa-ban display-small"></i> <span
                                        class="display-big">@lang('modules.billing.unsubscribe')</span></button>
                        @endif
                    @elseif(!is_null($firstInvoice) && $stripeSettings->razorpay_key != null && $stripeSettings->razorpay_secret != null && $firstInvoice->method == 'Razorpay')
                        @if(!is_null($razorPaySubscription) && $razorPaySubscription->ends_at == null)
                            <button type="button" class="small-danger-btn waves-effect waves-light unsubscription"
                                    data-type="razorpay" title="Unsubscribe Plan"><i
                                        class="fa fa-ban display-small"></i> <span
                                        class="display-big">@lang('modules.billing.unsubscribe')</span></button>
                        @endif

                    @elseif(!is_null($firstInvoice) && $stripeSettings->paystack_client_id != null && $stripeSettings->paystack_secret != null && $firstInvoice->method == 'Paystack')
                        @if(!is_null($payStackSubscription) && $payStackSubscription->ends_at == null)
                            <button type="button" class="small-danger-btn waves-effect waves-light unsubscription"
                                    data-type="paystack" title="Unsubscribe Plan"><i
                                        class="fa fa-ban display-small"></i> <span
                                        class="display-big">@lang('modules.billing.unsubscribe')</span></button>
                        @endif

                    @elseif(!is_null($firstInvoice) && $stripeSettings->mollie_api_key != null && $firstInvoice->method == 'Mollie')
                        @if(!is_null($mollieSubscription)  && $mollieSubscription->ends_at == null)
                            <button type="button" class="small-danger-btn waves-effect waves-light unsubscription"
                                    data-type="mollie" title="Unsubscribe Plan"><i
                                        class="fa fa-ban display-small"></i> <span
                                        class="display-big">@lang('modules.billing.unsubscribe')</span></button>
                        @endif

                    @elseif(!is_null($firstInvoice) && $stripeSettings->authorize_api_login_id != null && $firstInvoice->method == 'Authorize')
                        @if(!is_null($authorizeSubscription)  && $authorizeSubscription->ends_at == null)
                            <button type="button" class="small-danger-btn waves-effect waves-light unsubscription"
                                    data-type="authorize" title="Unsubscribe Plan"><i
                                        class="fa fa-ban display-small"></i> <span
                                        class="display-big">@lang('modules.billing.unsubscribe')</span></button>
                        @endif
                    @elseif(!is_null($firstInvoice) && $stripeSettings->moncommercesitenumber != null && $firstInvoice->method == 'Authorize')
                        @if(!is_null($authorizeSubscription)  && $authorizeSubscription->ends_at == null)
                            <button type="button" class="small-danger-btn waves-effect waves-light unsubscription"
                                    data-type="authorize" title="Unsubscribe Plan"><i
                                        class="fa fa-ban display-small"></i> <span
                                        class="display-big">@lang('modules.billing.unsubscribe')</span></button>
                        @endif
                    @elseif(!is_null($firstInvoice) && $stripeSettings->payfast_key != null && $firstInvoice->method == 'PayFast')
                        @if(!is_null($payfastSubscription)  && $payfastSubscription->ends_at == null)
                            <button type="button" class="small-danger-btn waves-effect waves-light unsubscription"
                                    data-type="payfast" title="Unsubscribe Plan"><i
                                        class="fa fa-ban display-small"></i> <span
                                        class="display-big">@lang('modules.billing.unsubscribe')</span></button>
                        @endif
                    @else

                    @endif


                    @if ($firstInvoice && $firstInvoice->method!='Offline')
                        <div class="pull-right " style="margin-top: -7px;margin-right: 10px;">
                            <button type="button" class="btn btn-info waves-effect waves-light"
                                    data-toggle="modal" data-target="#amount-select-form" >
                                <span
                                        class="display-big">Online Payment</span></button>
                        </div>
                    @endif
                </div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                @lang('app.annual') @lang('app.price')
                            </div>
                            <div class="col-sm-3">
                                {{ currency_formatter($company->package->annual_price, $company->package->currency->currency_symbol ?? '') }}
                            </div>
                        </div>
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                @lang('app.monthly') @lang('app.price')
                            </div>
                            <div class="col-sm-3">
                                {{ currency_formatter($company->package->monthly_price, $company->package->currency->currency_symbol ?? '') }}
                            </div>
                        </div>
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                @lang('app.max') @lang('app.menu.employees')
                            </div>
                            <div class="col-sm-3">
                                {{ $company->package->max_employees }}
                            </div>
                        </div>
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                @lang('app.active') @lang('app.menu.employees')
                            </div>
                            <div class="col-sm-3">
                                {{ $company->employees->count() }}
                            </div>
                        </div>
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                @lang('app.maxStorageSize')
                            </div>
                            <div class="col-sm-3">
                                @if($company->package->max_storage_size == -1)
                                    Unlimited
                                @else
                                    {{ $company->package->max_storage_size }}
                                    ({{ strtoupper($company->package->storage_unit) }})
                                @endif
                            </div>
                        </div>
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                @lang('app.usedStorage')
                            </div>
                            <div class="col-sm-3">
                                @if($company->package->storage_unit == 'mb')
                                    {{ $company->file_storage->count() > 0 ? round($company->file_storage->sum('size')/(1000*1024), 4). ' MB' : 'Not used' }}
                                @else
                                    {{ $company->file_storage->count() > 0 ? round($company->file_storage->sum('size')/(1000*1024*1024), 4). ' MB' : 'Not Used' }}
                                @endif
                            </div>
                        </div>
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                @lang('modules.billing.nextPaymentDate')
                            </div>
                            <div class="col-sm-3">
                                {{ $nextPaymentDate }}
                            </div>
                        </div>
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                @lang('modules.billing.previousPaymentDate')
                            </div>
                            <div class="col-sm-3">
                                {{ $previousPaymentDate }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                Payment Situation
                            </div>
                            <div class="col-sm-3">
                                @php
                                    $company = company_setting();
                                    $expireOn = $company->licence_expire_on;
                                    $currentDate = \Carbon\Carbon::now();
                                    $package = \App\Package::where('id', $company->package_id)->first();
                                @endphp
                                @if ((!is_null($expireOn) && $expireOn->lessThan($currentDate)) || ($company->status == 'license_expired' && $package->default != 'yes'))
                                    <span class="text-danger">Unpaid</span>
                                @else
                                    <span class="text-success">Paid</span>
                                @endif
                            </div>
                        </div>
                        <div class="row f-15 m-b-10">
                            <div class="col-sm-9">
                                Payment Method
                            </div>
                            <div class="col-sm-3">
                                @if ($firstInvoice && $firstInvoice->method!='Offline')
                                    Online
                                @else
                                    Bank Debit
                                @endif
                            </div>
                        </div>
                        @if ($firstInvoice && $firstInvoice->method=='Offline')
                            @php
                            $offline_in = \App\OfflineInvoice::find($firstInvoice->id);
                            @endphp
                            <div class="row f-15 m-b-10">
                                <div class="col-sm-3">
                                    <span class="text-info">IBAN:</span> {{$offline_in->iban}}
                                </div>
                                <div class="col-sm-3">
                                    <span class="text-info">BIC:</span> {{$offline_in->bic}}
                                </div>
                                <div class="col-sm-3">
                                    <span class="text-info">BANK:</span> {{$offline_in->bank}}
                                </div>
                                <div class="col-sm-3">
                                    <span class="text-info">AGENCY:</span> {{$offline_in->agency}}
                                </div>
                            </div>
                            {{--                                <div class="row f-15 m-b-10">--}}
                            {{--                                    <div class="col-sm-3">--}}
                            {{--                                        Debit Autorisation Doc &nbsp; <a style="color: red" href="{{$offline_in->offline_plan_change_request->file}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <x-main-header>
                <x-slot name="title">
                    @lang('app.menu.invoices')
                </x-slot>
            </x-main-header>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 m-t-20">
            <div class="table-responsive">
                <table class="table color-table inverse-table" id="users-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('app.menu.packages')</th>
                        <th>@lang('app.amount') ({{$global->currency? $global->currency->currency_symbol:'' }})</th>
                        <th>@lang('app.date')</th>
                        <th>@lang('modules.billing.nextPaymentDate')</th>
                        <th>@lang('modules.payments.paymentGateway')</th>
                        <th>@lang('app.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="package-select-form" role="dialog" aria-labelledby="myModalLabel"
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
    @php
    $amount = $company->package->monthly_price;
    if ($company->employees->count()>0) {
        $amount = $company->package->monthly_price*$company->employees->count()>0;
    }
    @endphp
    {{--Payment Modal--}}
    <div class="modal fade bs-modal-md in" id="amount-select-form" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="Payment-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    <table class="table color-table inverse-table">
                        <thead>
                        <tr>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Employees</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{  $company->package->name }}</td>
                            <td>{{$company->package->monthly_price}}</td>
                            <td>{{$company->employees->count()}}</td>
                            <td>{{$amount}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue selectPackage">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Payment Modal Ends--}}
@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script>
        @if(\Session::has('message'))
        toastr.success("{{  \Session::get('message') }}");
        @endif

        @if($message)
        window.history.pushState('billing', 'Title', "{{ route('admin.billing') }}");
        @php $message = ''; @endphp
        @endif
        // Show Create Holiday Modal
        $('body').on('click', '.selectPackage', function () {
            $('#amount-select-form').modal('hide');
            var id = '{{$company->package->id}}';
            var type = 'monthly';
            var url = "{{ route('admin.billing.select-package',':id') }}?type=" + type+'&amount={{$amount}}';
            url = url.replace(':id', id);
            $.ajaxModal('#package-select-form', url);
        });
        $(function () {
            var table = $('#users-table').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                "ordering": false,
                ajax: '{!! route('admin.billing.data') !!}',
                language: {
                    "url": "<?php echo __("app.datatable") ?>"
                },
                "fnDrawCallback": function (oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [
                    {data: 'id', name: 'id', bSort: false},
                    {data: 'name', name: 'name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'paid_on', name: 'paid_on'},
                    {data: 'next_pay_date', name: 'next_pay_date'},
                    {data: 'method', name: 'method'},
                    {data: 'action', name: 'action'}
                ]
            });
        });

        $('body').on('click', '.unsubscription', function () {
            var type = $(this).data('type');
            swal({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.confirmation.unsubscribe')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('messages.confirmUnsubscribe')",
                cancelButtonText: "@lang('messages.confirmNoArchive')",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {

                    var url = "{{ url('cancelAccount') }}";
                    window.location.href = url;
{{--                    var token = "{{ csrf_token() }}";--}}
{{--                    $.easyAjax({--}}
{{--                        type: 'GET',--}}
{{--                        url: url,--}}
{{--                        data: {'_token': token, '_method': 'POST', 'type': type},--}}
{{--                        success: function (response) {--}}
{{--                            if (response.status == "success") {--}}
{{--                                $.unblockUI();--}}
{{--//                                    swal("Deleted!", response.message, "success");--}}
{{--                                table._fnDraw();--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
                }
            });
        });

    </script>
@endpush
