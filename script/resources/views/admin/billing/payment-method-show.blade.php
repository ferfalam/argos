<style>
    .stripe-button-el{
        display: none;
    }
    .displayNone {
        display: none;
    }
    .checkbox-inline, .radio-inline {
        vertical-align: top !important;
    }
    .payment-type {
        border: 1px solid #e1e1e1;
        padding: 20px;
        background-color: #f3f3f3;
        border-radius: 10px;

    }
    .box-height {
        height: 78px;
    }
    .button-center{
        display: flex;
        justify-content: center;
    }
    .paymentMethods{display: none; transition: 0.3s;}
    .paymentMethods.show{display: block;}

    .stripePaymentForm{display: none; transition: 0.3s;}
    .stripePaymentForm.show{display: block;}

    .authorizePaymentForm{display: none; transition: 0.3s;}
    .authorizePaymentForm.show{display: block;}

    div#card-element{
        width: 100%;
        color: #4a5568;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        padding-left: 0.75rem;
        padding-right: 0.75rem;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        line-height: 1.25;
        border-width: 1px;
        border-radius: 0.25rem;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-style: solid;
        border-color: #e2e8f0;
    }
    .paystack-form {
        display: inline-block;
        position: relative;
    }
    .payment-type {
        margin: 0 5px;
        width: 100%;
    }
    .payment-type button{
        margin: 5px 5px;
        float: none;
    }
    .d-webkit-inline-box {
        display: inline;
    }
</style>
<div id="event-detail">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-cash"></i>
            @if($free)
                @lang('modules.payments.choosePlan')
            @else
                @lang('modules.payments.choosePaymentMethod')
            @endif
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            @if(!$free)
                <div class="row paymentMethods show">
                    <div class="col-12 col-sm-12 mt-40 text-center">
                        <div class="form-group">
                            <div class="radio-list">
                                @if($stripeSettings->show_pay)
                                    <label class="radio-inline p-0">
                                        <div class="radio radio-info">
                                            <input checked onchange="showButton('online')" type="radio" name="method" id="radio13" value="high">
                                            <label for="radio13">@lang('modules.client.online')</label>
                                        </div>
                                    </label>
                                @endif
                                @if($methods->count() > 0)
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" @if(!$stripeSettings->show_pay) checked @endif onchange="showButton('offline')" name="method" id="radio15">
                                            <label for="radio15">@lang('modules.client.offline')</label>
                                        </div>
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 mt-40 text-center" id="onlineBox">
                        @if(($stripeSettings->show_pay))
                            <div class="form-group payment-type align-items-center justify-content-center d-flex">


                                @if($stripeSettings->paystack_client_id != null && $stripeSettings->paystack_secret != null  && $stripeSettings->paystack_status == 'active')
                                    <form id="paystack-form" action="{{ route('admin.payments.paystack') }}" class="paystack-form d-webkit-inline-box" method="POST">
                                        <input type="hidden" id="name" name="name" value="{{ $user->name }}">
                                        <input type="hidden" id="paystackEmail" name="paystackEmail" value="{{ $user->email }}">
                                        <input type="hidden" name="plan_id" value="{{ $package->id }}">
                                        <input type="hidden" name="type" value="{{ $type }}">
                                        {{ csrf_field() }}
                                        <button type="submit" id="card-button" class="btn btn-success">
                                            <img height="15px" id="company-logo-img" src="https://s3-eu-west-1.amazonaws.com/pstk-integration-logos/paystack.jpg"> @lang('modules.invoices.payPaystack')
                                        </button>
                                    </form>
                                @endif
                                    @if($stripeSettings->moncommercesitenumber != null && $stripeSettings->moncommercehmackey != null  && $stripeSettings->mon_commerce_status == 'active')
                                        @php
                                            $pbx_site = $stripeSettings->moncommercesitenumber;
                                            $pbx_rang = $stripeSettings->moncommercerownumber;
                                            $pbx_identifiant = $stripeSettings->moncommercesiteidentifier;
                                            $pbx_total = $package->{$type.'_price'};
                                            // Removal of the points or commas in the amount
                                            $pbx_total = str_replace(",", "", $pbx_total);
                                            $pbx_total = str_replace(".", "", $pbx_total);
                                            $pbx_cmd = '1'; // test variable cmd_test1
                                            $pbx_porteur = $user->email; // test variable test@test.fr
                                            // Configure the back office site return url (IPN payment notification):
                                            $pbx_repondre_a = route('admin.payments.moncommerce.callback');
                                            // Parameterization of the data returned via the IPN:
                                            $pbx_retour = 'Mt: M; Ref: R; Auto: A; Error: E';
                                            // Configure client browser redirection urls after payment:
                                            $pbx_effectue = route('admin.payments.moncommerce.callback', ['type' => 'success']);
                                            $pbx_annule = route('admin.payments.moncommerce.callback', ['type' => 'error']);
                                            $pbx_refuse = route('admin.payments.moncommerce.callback', ['type' => 'error']);
                                            // We retrieve the date in ISO-8601 format:
                                            $dateTime = date ("c");
                                            // Number of product sent to PBX_SHOPPINGCART:
                                            $pbx_nb_produit = 'number of products in the basket'; // test variable 5
                                            // Construction of PBX_SHOPPINGCART:
                                            $pbx_shoppingcart = "<?xml version=\"1.0\" encoding=\"utf-8\"?><shoppingcart><total><totalQuantity>".$pbx_nb_produit."</totalQuantity></total></shoppingcart>";
                                            // Values ​​sent to PBX_BILLING:
                                            $pbx_prenom_fact = $user->name; // Jean-Marie test variable
                                            $pbx_nom_fact = $user->name; // Thomson test variable
                                            $pbx_adresse1_fact = ''; // test variable 1 rue de Paris
                                            $pbx_adresse2_fact = ''; // test variable <empty>
                                            $pbx_zipcode_fact = ''; // test variable 75001
                                            $pbx_city_fact = ''; // Paris test variable
                                            $pbx_country_fact = ''; // test variable 250 (for France)
                                            // Construction of PBX_BILLING:
                                            $pbx_billing = "<?xml version=\"1.0\" encoding=\"utf-8\"?><Billing><Address><FirstName>".$pbx_prenom_fact."</FirstName>".
                                                            "<LastName>".$pbx_nom_fact."</LastName><Address1>".$pbx_adresse1_fact."</Address1>".
                                                            "<Address2>".$pbx_adresse2_fact."</Address2><ZipCode>".$pbx_zipcode_fact."</ZipCode>".
                                                            "<City>".$pbx_city_fact."</City><CountryCode>".$pbx_country_fact."</CountryCode>".
                                                            "</Address></Billing>";
                                            $urletrans = $stripeSettings->moncommerce_environment=='sandbox'?'https://recette-tpeweb.e-transactions.fr/php/':'https://tpeweb.e-transactions.fr/php/';
                                            $hmackey = $stripeSettings->moncommercehmackey;
                                            // We create the hash chain without URLencoding
                                            $msg = "PBX_SITE=".$pbx_site.
                                            "&PBX_RANG=".$pbx_rang.
                                            "&PBX_IDENTIFIANT=".$pbx_identifiant.
                                            "&PBX_TOTAL=".$pbx_total.
                                            "&PBX_DEVISE=978".
                                            "&PBX_CMD=".$pbx_cmd.
                                            "&PBX_PORTEUR=".$pbx_porteur.
                                            "&PBX_REPONDRE_A=".$pbx_repondre_a.
                                            "&PBX_RETOUR=".$pbx_retour.
                                            "&PBX_EFFECTUE=".$pbx_effectue.
                                            "&PBX_ANNULE=".$pbx_annule.
                                            "&PBX_REFUSE=".$pbx_refuse.
                                            "&PBX_HASH=SHA512".
                                            "&PBX_TIME=".$dateTime.
                                            "&PBX_SHOPPINGCART=".$pbx_shoppingcart.
                                            "&PBX_BILLING=".$pbx_billing;
                                            $binKey = pack("H*", $hmackey);
                                            // We calculate the fingerprint (enter in the parameter PBX_HMAC) using the hash_hmac function and //
                                            // the binary key
                                            // We send the hash algorithm that was used via the PBX_HASH variable (SHA512 in this case)
                                            // To display the list of algorithms available in your environment, uncomment the line //
                                            // next
                                            // print_r (hash_algos ());
                                            $hmac = strtoupper(hash_hmac('sha512', $msg, $binKey));
                                            // The string will be sent in uppercase, hence the use of strtoupper ()
                                            // We create the send form
                                            // WARNING: the order of the fields in the form is extremely important, it must
                                            // exactly match the order of the fields in the ax chain.
                                            session([
                                                'package_id' => $package->id,
                                                'package_type' => $type,
                                                'package_amount' => $pbx_total,
                                            ]);
                                        @endphp
                                        {{-- <form id="paystack-form" action="{{ route('admin.payments.paystack') }}" class="paystack-form d-webkit-inline-box" method="POST">
                                            <input type="hidden" id="name" name="name" value="{{ $user->name }}">
                                            <input type="hidden" id="paystackEmail" name="paystackEmail" value="{{ $user->email }}">
                                            <input type="hidden" name="plan_id" value="{{ $package->id }}">
                                            <input type="hidden" name="type" value="{{ $type }}">
                                            {{ csrf_field() }}
                                            <button type="submit" id="card-button" class="btn btn-success">
                                                <img height="15px" id="company-logo-img" src="https://s3-eu-west-1.amazonaws.com/pstk-integration-logos/paystack.jpg"> @lang('modules.invoices.payPaystack')
                                            </button>
                                        </form> --}}
                                        <form method="POST" action="<?php echo $urletrans; ?>">
                                            <input type="hidden" name="PBX_SITE" value="<?php echo $pbx_site; ?>">
                                            <input type="hidden" name="PBX_RANG" value="<?php echo $pbx_rang; ?>">
                                            <input type="hidden" name="PBX_IDENTIFIANT" value="<?php echo $pbx_identifiant; ?>">
                                            <input type="hidden" name="PBX_TOTAL" value="<?php echo $pbx_total; ?>">
                                            <input type="hidden" name="PBX_DEVISE" value="978">
                                            <input type="hidden" name="PBX_CMD" value="<?php echo $pbx_cmd; ?>">
                                            <input type="hidden" name="PBX_PORTEUR" value="<?php echo $pbx_porteur; ?>">
                                            <input type="hidden" name="PBX_REPONDRE_A" value="<?php echo $pbx_repondre_a; ?>">
                                            <input type="hidden" name="PBX_RETOUR" value="<?php echo $pbx_retour; ?>">
                                            <input type="hidden" name="PBX_EFFECTUE" value="<?php echo $pbx_effectue; ?>">
                                            <input type="hidden" name="PBX_ANNULE" value="<?php echo $pbx_annule; ?>">
                                            <input type="hidden" name="PBX_REFUSE" value="<?php echo $pbx_refuse; ?>">
                                            <input type="hidden" name="PBX_HASH" value="SHA512">
                                            <input type="hidden" name="PBX_TIME" value="<?php echo $dateTime; ?>">
                                            <input type="hidden" name="PBX_SHOPPINGCART" value="<?php echo htmlspecialchars($pbx_shoppingcart); ?>">
                                            <input type="hidden" name="PBX_BILLING" value="<?php echo htmlspecialchars($pbx_billing); ?>">
                                            <input type="hidden" name="PBX_HMAC" value="<?php echo $hmac; ?>">
                                            {{-- <input type="submit" value="Envoyer"> --}}
                                            <button type="submit" id="card-button" class="btn btn-success">
                                                <img height="15px" id="company-logo-img" src="{{asset('img/moncommerce.png')}}"> @lang('modules.invoices.paymoncommerce')
                                            </button>
                                        </form>
                                    @endif
                                @if($stripeSettings->paypal_client_id != null && $stripeSettings->paypal_secret != null && $stripeSettings->paypal_status == 'active')
                                    <button type="submit" class="btn btn-warning waves-effect waves-light paypalPayment" data-toggle="tooltip" data-placement="top" title="Choose Plan">
                                        <i class="icon-anchor display-small"></i><span>
                                        <i class="fa fa-paypal"></i> @lang('modules.invoices.payPaypal')</span>
                                    </button>
                                @endif
                                @if($stripeSettings->razorpay_key != null && $stripeSettings->razorpay_secret != null  && $stripeSettings->razorpay_status == 'active')
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-l-10" onclick="razorpaySubscription();" data-toggle="tooltip" data-placement="top" title="Choose Plan">
                                        <i class="icon-anchor display-small"></i><span>
                                            <i class="fa fa-credit-card-alt"></i> RazorPay </span>
                                    </button>
                                @endif
                                @if($stripeSettings->api_key != null && $stripeSettings->api_secret != null  && $stripeSettings->stripe_status == 'active')
                                    <button type="submit" class="btn btn-linkedin waves-effect waves-light stripePay" data-toggle="tooltip" data-placement="top" title="Choose Plan">
                                        <i class="icon-anchor display-small"></i><span>
                                        <i class="fa fa-cc-stripe"></i> @lang('modules.invoices.payStripe')</span>
                                    </button>
                                @endif

                                @if($stripeSettings->authorize_api_login_id != null && $stripeSettings->authorize_transaction_key != null  && $stripeSettings->authorize_status == 'active')
                                        <button type="submit" class="btn btn-linkedin waves-effect waves-light authroizePay" data-toggle="modal" data-target="#authorizeModal">
                                            <img height="15px" id="company-logo-img" src="{{ asset('img/authorize.jpg') }}"> Pay Via Authorize.net</button>
                                @endif

                                @if($stripeSettings->mollie_api_key != null && $stripeSettings->mollie_status == 'active')
                                    <form id="paystack-form" action="{{ route('admin.payments.mollie') }}" class="mollie-form d-webkit-inline-box" method="POST">
                                        <input type="hidden" id="name" name="name" value="{{ $user->name }}">
                                        <input type="hidden" id="mollieEmail" name="mollieEmail" value="{{ $user->email }}">
                                        <input type="hidden" name="plan_id" value="{{ $package->id }}">
                                        <input type="hidden" name="type" value="{{ $type }}">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light molliePay" data-toggle="tooltip" data-placement="top" title="@lang('modules.invoices.mollie')">
                                            <i class="icon-anchor display-small"></i><span>
                                         @lang('modules.invoices.mollie')</span>
                                        </button>
                                    </form>

                                @endif
                                @if($stripeSettings->payfast_key != null && $stripeSettings->payfast_secret != null && $stripeSettings->payfast_status == 'active') 
                                {!!  $payFastHtml !!}
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-sm-12 mt-40 text-center">
                        @if($methods->count() > 0)
                            <div class="form-group @if(($stripeSettings->show_pay)) displayNone @endif payment-type" id="offlineBox">
                                <div class="radio-list">
                                    @forelse($methods as $key => $method)
                                        <label class="radio-inline @if($key == 0) p-0 @endif">
                                            <div class="radio radio-info" >
                                                <input @if($key == 0) checked @endif onchange="showDetail('{{ $method->id }}')" type="radio" name="offlineMethod" id="offline{{$key}}"
                                                       value="{{ $method->id }}">
                                                <label for="offline{{$key}}" class="text-info" >
                                                    {{ ucfirst($method->name) }} </label>
                                            </div>
                                            <div class="" id="method-desc-{{ $method->id }}">
                                                {!! $method->description !!}
                                            </div>
                                        </label>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="row">
                                    <div class="col-md-12 " id="methodDetail">
                                    </div>

                                    @if(count($methods) > 0)
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-info save-offline" onclick="selectOffline('{{ $package->id }}')">@lang('app.select')</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row stripePaymentForm">
                    @if($stripeSettings->api_key != null && $stripeSettings->api_secret != null  && $stripeSettings->stripe_status == 'active')
                        <div class="m-l-10">
                            <form id="stripe-form" action="{{ route('admin.payments.stripe') }}" method="POST">
                                <input type="hidden" id="name" name="name" value="{{ $user->name }}">
                                <input type="hidden" id="stripeEmail" name="stripeEmail" value="{{ $user->email }}">
                                <input type="hidden" name="plan_id" value="{{ $package->id }}">
                                <input type="hidden" name="type" value="{{ $type }}">
                                {{ csrf_field() }}
                                <div class="row" style="margin-bottom:20px;">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.name')</label>
                                            <input type="text" required name="clientName" id="clientName" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.line1')</label>
                                            <input type="text" required name="line1" id="line1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.city')</label>
                                            <input type="text" required name="city" id="city" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.state')</label>
                                            <input type="text" required name="state" id="state" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.country')</label>
                                            <select class="select2 form-control"  id="country" name="country">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->iso }}">{{ $country->nicename }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <small>* @lang('messages.payementMessage') <a href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2" target="_blank">@lang('messages.alphabetCode')</a></small>
                                    </div>
                                </div>
                                <div class="flex flex-wrap mb-6">
                                    <label for="card-element" class="block text-gray-700 text-sm font-bold mb-2">
                                        Card Info
                                    </label>
                                    <div id="card-element" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></div>
                                    <div id="card-errors" class="text-red-400 text-bold mt-2 text-sm font-medium"></div>
                                </div>

                                <!-- Stripe Elements Placeholder -->
                                <div class="flex flex-wrap mt-6" style="margin-top: 15px; text-align: center">
                                    <button type="submit" id="card-button" data-secret="{{ $intent->client_secret }}"  class="btn btn-success inline-block align-middle text-center select-none border font-bold whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">
                                        <i class="fa fa-cc-stripe"></i> {{ __('Pay') }}
                                    </button>
                                </div>
                            </form>

                        </div>
                    @endif
                </div>
                <div class="row authorizePaymentForm">
                <div id="alert"></div>
                @php
                    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
                @endphp
                @if($stripeSettings->authorize_api_login_id != null && $stripeSettings->authorize_transaction_key != null  && $stripeSettings->authorize_status == 'active')
                    <div class="m-l-10">
                        <form id="authorize-form">

                            <input type="hidden" id="name" name="name" value="{{ $user->name }}">
                            <input type="hidden" id="email" name="email" value="{{ $user->email }}">
                            <input type="hidden" name="plan_id" value="{{ $package->id }}">
                            <input type="hidden" name="type" value="{{ $type }}">
                            {{ csrf_field() }}
                            <div class="row" style="margin-bottom:20px;">
                                <div class="col-xs-12">
                                    <div class="form-group owner">
                                        <label for="owner">Card Holder Name</label>
                                        <input type="text" class="form-control" id="owner" name="owner" value="{{ user()->name ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cardNumber">Card Number</label>
                                        <input type="text" class="form-control" id="card_number" name="card_number" value="">
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cvv">CVV</label>
                                        <input type="number" class="form-control" id="cvv" name="cvv" value="">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-8" id="expiration-date">
                                    <label>Expiration Date</label><br/>
                                    <select class="form-control" id="expiration_month" name="expiration_month" style="float: left; width: 100px; margin-right: 10px;">
                                        @foreach($months as $k=>$v)
                                            <option value="{{ $k }}" {{ old('expiration_month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control" id="expiration_year" name="expiration_year"  style="float: left; width: 100px;">
                                        @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-4" id="credit_cards" style="margin-top: 22px;">
                                    <img src="{{ asset('img/visa.jpg') }}" id="visa" height="30px">
                                    <img src="{{ asset('img/mastercard.jpg') }}" id="mastercard" height="30px">
                                    <img src="{{ asset('img/amex.jpg') }}" id="amex" height="30px">
                                </div>
                            </div>
                            <!-- Stripe Elements Placeholder -->
                            <div class="flex flex-wrap mt-6" style="margin-top: 15px; text-align: center">
                                <button type="button" id="authorize-button" class="btn btn-success inline-block align-middle text-center select-none border font-bold whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">
                                    <img height="15px" id="company-logo-img" src="{{ asset('img/authorize.jpg') }}"> {{ __('Pay') }}
                                </button>
                            </div>
                        </form>

                    </div>
                @endif
            </div>
            @else
                <div class="row">
                    <div class="col-xs-12">
                        @lang('messages.choseFreePlan')
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        @if($free)
            <button type="button" class="btn btn-success waves-effect" onclick="selectFreePlan();" data-dismiss="modal">Confirm</button>
        @endif
        <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
    </div>
</div>
<script>
    function selectFreePlan() {
        var plan_id = '{{ $package->id }}';
        $.easyAjax({
            url: '{{ route('admin.billing.free-plan') }}',
            type: "POST",
            redirect: true,
            data: {
                'package_id': plan_id,
                'type':'{{ $type }}',
                '_token':'{{ csrf_token() }}'
            }
        })
    }
</script>
@if(!$free)

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script src="{{ asset('pricing/js/index.js') }}"></script>

<script>
    $('#authorize-button').click(function() {
        $.easyAjax({
            url: '{{ route('admin.payments.authorize') }}',
            type: "POST",
            data: $('#authorize-form').serialize(),
            container:$('.authorizePaymentForm'),
            messagePosition:"inline",
            success: function (response) {
                if(response.status == 'success') {
                    $('#authorize-form').remove();
                    setInterval(checkWebhook, 20000)
                }
            }

        })
    })

    function checkWebhook() {
        $.easyAjax({
            url: '{{ route('admin.check-authorize-subscription') }}',
            type: "POST",
            data: {package_id:'{{ $package->id }}', type:'{{ $type }}', '_token':'{{ csrf_token() }}'},
            container:$('#authorizePaymentForm'),
            success: function (response) {
                if(response.status == 'success' && response.webhook) {
                    window.location.reload();
                }
            }

        })
    }
</script>
@if($stripeSettings->stripe_status == 'active')
<script>

    const stripe = Stripe('{{ config("cashier.key") }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('name');
    const cardButton = document.getElementById('card-button');
    //        const clientSecret = cardButton.dataset.secret;
    const clientSecret = cardButton.dataset.secret;
    console.log(clientSecret);
    let validCard = false;
    const cardError = document.getElementById('card-errors');

    cardElement.addEventListener('change', function(event) {

        if (event.error) {
            validCard = false;
            cardError.textContent = event.error.message;
        } else {
            validCard = true;
            cardError.textContent = '';
        }
    });
    var form = document.getElementById('stripe-form');

    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        var line1 = $('#line1').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var country = $('#country').val();
        cardButton.disabled = true;
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value,
                        address: {
                            line1: line1,
                            city: city,
                            state: state,
                            country: country
                        }
                    }
                }
            }
        );

        if (error) {
            cardButton.disabled = false;
            console.log('error'+error);
            $('#card-errors').text(error.message);
            // Display "error.message" to the user...
        } else {
            console.log(['setupIntent', setupIntent]);
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', setupIntent.payment_method);
            form.appendChild(hiddenInput);
            form.submit();
            // The card has been verified successfully...
        }
    });

</script>
@endif
<script>
    $('.stripePay').click(function(e){
        e.preventDefault();
        $('.paymentMethods').removeClass('show');
        $('.stripePaymentForm').addClass('show');
        $('.modal-title').text('Enter Your Card Details');
    });

    $('.authroizePay').click(function(e){
        e.preventDefault();
        $('.paymentMethods').removeClass('show');
        $('.authorizePaymentForm').addClass('show');
        $('.modal-title').text('Enter Your Card Details');
    });

    // Payment mode
    function showButton(type){

        if(type == 'online'){
            $('#offlineBox').addClass('displayNone');
            $('#onlineBox').removeClass('displayNone')();
        }else{
            $('#offlineBox').removeClass('displayNone');
            $('#onlineBox').addClass('displayNone')();
        }
    }
    // redirect on paypal payment page
    $('body').on('click', '.paypalPayment', function(){
        $.easyBlockUI('#package-select-form', 'Redirecting Please Wait...');
        var url = "{{ route('admin.paypal', [$package->id, $type]) }}";
        window.location.href = url;
    });


    function selectOffline(package_id) {
        let offlineId = $("input[name=offlineMethod]").val();
        $.ajaxModal('#package-offline', '{{ route('admin.billing.offline-payment')}}'+'?package_id='+package_id+'&offlineId='+offlineId+'&type='+'{{ $type }}');
        {{--$.easyAjax({--}}
        {{--    url: '{{ route('admin.billing.offline-payment') }}',--}}
        {{--    type: "POST",--}}
        {{--    redirect: true,--}}
        {{--    data: {--}}
        {{--        package_id: package_id,--}}
        {{--        "offlineId": offlineId--}}
        {{--    }--}}
        {{--})--}}
    }
    {{--$('.save-offline').click(function() {--}}
    {{--    let offlineId = $("input[name=offlineMethod]").val();--}}

    {{--    $.easyAjax({--}}
    {{--        url: '{{ route('client.invoices.store') }}',--}}
    {{--        type: "POST",--}}
    {{--        redirect: true,--}}
    {{--        data: {invoiceId: "{{ $invoice->id }}", "_token" : "{{ csrf_token() }}", "offlineId": offlineId}--}}
    {{--    })--}}

    {{--})--}}

    @if($stripeSettings->razorpay_key != null && $stripeSettings->razorpay_secret != null  && $stripeSettings->razorpay_status == 'active')

    //Confirmation after transaction
    function razorpaySubscription() {
        var plan_id = '{{ $package->id }}';
        var type = '{{ $type }}';
        $.easyAjax({
            type:'POST',
            url:'{{route('admin.billing.razorpay-subscription')}}',
            data: {plan_id: plan_id,type: type,_token:'{{csrf_token()}}'},
            success:function(response){
                razorpayPaymentCheckout(response.subscriprion)
           }
        })
    }


    function razorpayPaymentCheckout(subscriptionID) {
        var options = {
            "key": "{{ $stripeSettings->razorpay_key }}",
            "subscription_id":subscriptionID,
            "name": "{{$companyName}}",
            "description": "{{ $package->description }}",
            "image": "{{ $logo }}",
            "handler": function (response){
                confirmRazorpayPayment(response);
            },
            "notes": {
                "package_id": '{{ $package->id }}',
                "package_type": '{{ $type }}',
                "company_id": '{{ $company->id }}'
            },
        };

        var rzp1 = new Razorpay(options);
        rzp1.open();
    }

    //Confirmation after transaction
    function confirmRazorpayPayment(response) {
        var plan_id = '{{ $package->id }}';
        var type = '{{ $type }}';
         var payment_id = response.razorpay_payment_id;
         var subscription_id = response.razorpay_subscription_id;
         var razorpay_signature = response.razorpay_signature;
//         console.log([plan_id, type, payment_id, subscription_id, razorpay_signature]);
        $.easyAjax({
            type:'POST',
            url:'{{route('admin.billing.razorpay-payment')}}',
            data: {paymentId: payment_id,plan_id: plan_id,subscription_id: subscription_id,type: type,razorpay_signature: razorpay_signature,_token:'{{csrf_token()}}'},
            redirect:true,
        })
    }
</script>
    @endif
@else

@endif


