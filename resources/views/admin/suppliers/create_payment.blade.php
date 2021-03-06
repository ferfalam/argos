<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<style>
    .row{
        display: flex;
    }

    .d-none{
        display: none;
    }
</style>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title"><i class="fa fa-plus"></i>@lang('app.add') @lang('app.menu.payments') - @lang('app.clients') # {{ $client->id.' '.$client->company_name }}</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">

        <!-- BEGIN FORM-->
        {!! Form::open(['id'=>'storePayments','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">

            {!! Form::hidden('client_id', $client->id) !!}

            @if ($invoice->id)
                {!! Form::hidden('payment_id', $invoice->id) !!}  
            @endif
            {{-- {!! Form::hidden('company_name', $project->clientdetails->company_name ? $project->clientdetails->company_name : $project->clientdetails->name) !!} --}}
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="control-label">Programme</label>
                        <select class="form-control" name="project_id" id="currency_id">
                            <option value="none" >---</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" @if ($invoice->project_id == $project->id)
                                    selected
                                @endif>{{ $project->project_name  }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group" >
                        <label class="control-label">N° Facture</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon">
                                    <select class="form-control" name="invoice_id" id="payment_id">
                                        <option value="none" >---</option>
                                        @foreach($invoices as $in)
                                            <option value="{{ $in->id }}" @if ($invoice->invoice_id == $in->id)
                                                selected
                                            @endif>{{ $in->invoice_number  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group" >
                        <label class="control-label">@lang('modules.invoices.invoiceDate')</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon">
                                    @foreach ($invoices as $in)
                                        @if ($invoice->invoice_id == $in->id)
                                            <input type="text" class="form-control issue_date" name="issue_date" id="{{'invoice_date-'.$in->id}}" value="{{$in->issue_date ? Carbon\Carbon::parse($in->issue_date)->format($global->date_format) : Carbon\Carbon::today()->format($global->date_format) }}">
                                        @else
                                            <input type="text" class="form-control issue_date d-none" disabled="disabled" name="issue_date" id="{{'invoice_date-'.$in->id}}" value="{{$in->issue_date ? Carbon\Carbon::parse($in->issue_date)->format($global->date_format) : Carbon\Carbon::today()->format($global->date_format) }}">
                                        @endif
                                    @endforeach                                
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group" >
                        <label class="control-label">Date du Paiement</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon">
                                    <input type="text" class="form-control due_date" name="due_date" id="" value="{{$invoice->due_date ? Carbon\Carbon::parse($invoice->due_date)->format($global->date_format) : Carbon\Carbon::today()->format($global->date_format) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group" >
                        <label class="control-label">Montant du Paiement</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon">
                                    <input type="text" class="form-control" name="amount" id="" value="{{$invoice->amount}} ">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">

                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="control-label">Mode de Paiement</label>
                        <a class="btn btn-outlined-success" id="plus-payment-mode" style="">
                            <i class="fa fa-plus"></i></a>
                        <select class="form-control select2" name="gateway" id="gateway_id">
                            {{-- <option value="none" >---</option> --}}
                            @if ($types)
                                @foreach($types as $type)
                                    <option value="{{ $type->espace_name }}" @if ($invoice->gateway == $type->espace_name)
                                        selected
                                    @endif>{{ $type->espace_name  }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                </div>

            </div>
        </div>
        <div class="form-actions" style="margin-top: 70px">
            <div class="row">
                <div class="col-xs-12">
                    <div class="dropup">
                        <a href="javascript:;" class="save-form btn btn-success" data-type="save">
                            <i class="fa fa-save"></i> @lang('app.save')
                        </a>
                        {{-- <ul role="menu" class="dropdown-menu">
                            <li>
                                
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:;" class="save-form" data-type="draft">
                                    <i class="fa fa-file"></i> @lang('app.saveDraft')
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="save-form" data-type="send">
                                    <i class="fa fa-send"></i> @lang('app.saveSend')
                                </a>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script>

    $(".selectpicker").selectpicker({
        formatNoMatches: function () {
            return "{{ __('messages.noRecordFound') }}";
        }
    });

    $('#tax-settings').click(function () {
        var url = '{{ route('admin.taxes.create')}}';
        $('#modelHeading').html('Manage Project Category');
        $.ajaxModal('#taxModal', url);
    })

    jQuery('.issue_date, .due_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        weekStart:'{{ $global->week_start }}',
        format: '{{ $global->date_picker_format }}',
    });
    $('#invoice_number').on('keyup', function () {
        var invoiceNumber = $(this).val();
        var invoiceDigit = $('.noOfZero').data('zero');
        var invoiceZero = '';
        if(invoiceNumber.length < invoiceDigit){
            for ($i=0; $i<invoiceDigit-invoiceNumber.length; $i++){
                invoiceZero = invoiceZero+'0';
            }
        }

        // var invoice_no = invoicePrefix+'#'+invoiceZero;
        $('.noOfZero').text(invoiceZero);
    });

    $('.save-form').click(function(e){
        e.preventDefault();
        // var id = $("#category_id_update").val();
        var url = "{{route('admin.suppliers.payments.storePayment')}}";
        // url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            container: '#storePayments',
            type: "POST",
            data: $('#storePayments').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    window.location.reload()
                }
            }
        })
    });

    $('#add-item').click(function () {
        var i = $(document).find('.item_name').length;
        var item = '<div class="col-xs-12 item-row margin-top-5">'

            +'<div class="col-md-3">'
            +'<div class="row">'
            +'<div class="form-group">'
            +'<label class="control-label hidden-md hidden-lg">@lang('modules.invoices.item')</label>'
            +'<div class="input-group">'
            +'<div class="input-group-addon"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div>'
            +'<input type="text" class="form-control item_name" name="item_name[]" >'
            +'</div>'
            +'</div>'

            +'<div class="form-group">'
            +'<textarea name="item_summary[]" class="form-control" placeholder="@lang('app.description')" rows="2"></textarea>'
            +'</div>'

            +'</div>'

            +'</div>'
            +'<div class="col-md-1">'

            +'<div class="form-group">'
            +'<label class="control-label hidden-md hidden-lg">@lang('modules.invoices.hsnSacCode')</label>'
            +'<input type="text"  class="form-control" name="hsn_sac_code[]" >'
            +'</div>'
            +'</div>'
            +'<div class="col-md-1">'

            +'<div class="form-group">'
            +'<label class="control-label hidden-md hidden-lg">@lang('modules.invoices.qty')</label>'
            +'<input type="number" min="1" class="form-control quantity" value="1" name="quantity[]" >'
            +'</div>'


            +'</div>'

            +'<div class="col-md-2">'
            +'<div class="row">'
            +'<div class="form-group">'
            +'<label class="control-label hidden-md hidden-lg">@lang('modules.invoices.unitPrice')</label>'
            +'<input type="text" min="0" class="form-control cost_per_item" value="0" name="cost_per_item[]">'
            +'</div>'
            +'</div>'

            +'</div>'


            +'<div class="col-md-2">'

            +'<div class="form-group">'
            +'<label class="control-label hidden-md hidden-lg">@lang('modules.invoices.tax')</label>'
            +'<select id="multiselect'+i+'" name="taxes['+i+'][]"  multiple="multiple" class="selectpicker form-control type">'
                @foreach($taxes as $tax)
            +'<option data-rate="{{ $tax->rate_percent }}" value="{{ $tax->id }}">{{ $tax->tax_name.': '.$tax->rate_percent }}%</option>'
                @endforeach
            +'</select>'
            +'</div>'


            +'</div>'

            +'<div class="col-md-2 text-center">'
            +'<label class="control-label hidden-md hidden-lg">@lang('modules.invoices.amount')</label>'
            +'<p class="form-control-static"><span class="amount-html">0.00</span></p>'
            +'<input type="hidden" class="amount" name="amount[]">'
            +'</div>'

            +'<div class="col-md-1 text-right visible-md visible-lg">'
            +'<button type="button" class="btn remove-item btn-circle btn-danger"><i class="fa fa-remove"></i></button>'
            +'</div>'

            +'<div class="col-md-1 hidden-md hidden-lg">'
            +'<div class="row">'
            +'<button type="button" class="btn remove-item btn-danger"><i class="fa fa-remove"></i> @lang('app.remove')</button>'
            +'</div>'
            +'</div>'

            +'</div>';

        $(item).hide().appendTo("#sortable").fadeIn(500);
        $('#multiselect'+i).selectpicker();
        hsnSacColumn();
    });

    hsnSacColumn();
    function hsnSacColumn(){
        @if($invoiceSetting->hsn_sac_code_show)
        $('input[name="item_name[]"]').parent("div").parent('div').parent('div').parent('div').removeClass( "col-md-4");
        $('input[name="item_name[]"]').parent("div").parent('div').parent('div').parent('div').addClass( "col-md-3");
        $('input[name="hsn_sac_code[]"]').parent("div").parent('div').show();
        @else
        $('input[name="hsn_sac_code[]"]').parent("div").parent('div').hide();
        $('input[name="item_name[]"]').parent("div").parent('div').parent('div').parent('div').removeClass( "col-md-3");
        $('input[name="item_name[]"]').parent("div").parent('div').parent('div').parent('div').addClass( "col-md-4");
        @endif
    }

    $('#storePayments').on('click','.remove-item', function () {
        $(this).closest('.item-row').fadeOut(300, function() {
            $(this).remove();
            calculateTotal();
        });
    });

    $('#storePayments').on('keyup change','.quantity,.cost_per_item,.item_name, .discount_value', function () {
        var quantity = $(this).closest('.item-row').find('.quantity').val();

        var perItemCost = $(this).closest('.item-row').find('.cost_per_item').val();

        var amount = (quantity*perItemCost);

        $(this).closest('.item-row').find('.amount').val(decimalupto2(amount));
        $(this).closest('.item-row').find('.amount-html').html(decimalupto2(amount));

        calculateTotal();


    });

    $('#storePayments').on('change','.type, #discount_type', function () {
        var quantity = $(this).closest('.item-row').find('.quantity').val();

        var perItemCost = $(this).closest('.item-row').find('.cost_per_item').val();

        var amount = (quantity*perItemCost);

        $(this).closest('.item-row').find('.amount').val(decimalupto2(amount));
        $(this).closest('.item-row').find('.amount-html').html(decimalupto2(amount));

        calculateTotal();


    });

    function calculateTotal(){
        var subtotal = 0;
        var discount = 0;
        var tax = '';
        var taxList = new Object();
        var taxTotal = 0;
        $(".quantity").each(function (index, element) {
            var itemTax = [];
            var itemTaxName = [];
            $(this).closest('.item-row').find('select.type option:selected').each(function (index) {
                itemTax[index] = $(this).data('rate');
                itemTaxName[index] = $(this).text();
            });
            var itemTaxId = $(this).closest('.item-row').find('select.type').val();
            var amount = parseFloat($(this).closest('.item-row').find('.amount').val());

            if(isNaN(amount)){ amount = 0; }

            subtotal = parseFloat(subtotal)+parseFloat(amount);

            if(itemTaxId != ''){
                for(var i = 0; i<=itemTaxName.length; i++)
                {
                    if(typeof (taxList[itemTaxName[i]]) === 'undefined'){
                        taxList[itemTaxName[i]] = ((parseFloat(itemTax[i])/100)*parseFloat(amount));
                    }
                    else{
                        taxList[itemTaxName[i]] = parseFloat(taxList[itemTaxName[i]]) + ((parseFloat(itemTax[i])/100)*parseFloat(amount));
                    }
                }
            }
        });

        $.each( taxList, function( key, value ) {
            if(!isNaN(value)){
                tax = tax+'<div class="col-md-offset-8 col-md-2 text-right p-t-10">'
                    +key
                    +'</div>'
                    +'<p class="form-control-static col-xs-6 col-md-2" >'
                    +'<span class="tax-percent">'+decimalupto2(value)+'</span>'
                    +'</p>';
                taxTotal = taxTotal+decimalupto2(value);
            }
        });

        if(isNaN(subtotal)){  subtotal = 0; }

        $('.sub-total').html(decimalupto2(subtotal));
        $('.sub-total-field').val(decimalupto2(subtotal));

        var discountType = $('#discount_type').val();
        var discountValue = $('.discount_value').val();

        if(discountValue != ''){
            if(discountType == 'percent'){
                discount = ((parseFloat(subtotal)/100)*parseFloat(discountValue));
            }
            else{
                discount = parseFloat(discountValue);
            }

        }

//       show tax
        $('#invoice-taxes').html(tax);

//            calculate total
        var totalAfterDiscount = decimalupto2(subtotal-discount);

        totalAfterDiscount = (totalAfterDiscount < 0) ? 0 : totalAfterDiscount;

        var total = decimalupto2(totalAfterDiscount+taxTotal);

        $('.total').html(total);
        $('.total-field').val(total);

    }

    function decimalupto2(num) {
        var amt =  Math.round(num * 100) / 100;
        return parseFloat(amt.toFixed(2));
    }


    $('#plus-payment-mode').click(function(){
        var url = '{{ route('admin.payment-mode.create')}}';
        $('#modelHeading').html('Add Payment Mode');
        $.ajaxModal('#add-payment-mode',url);
    })

    $("#payment_id").on('change', function (e) {
        let val = $(this).val()
        const issue_date = $('#invoice_date-'+val)
        $('.issue_date').each(function () {
            if (!$(this).hasClass('d_none')) {
                $(this).addClass('d-none')
            }
        })
        $( ".issue_date" ).prop( "disabled", true )
        issue_date.removeClass('d-none')
        issue_date.prop( "disabled", false )
    })
</script>