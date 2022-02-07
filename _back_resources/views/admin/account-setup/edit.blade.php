@extends('layouts.app')

@section('page-title')
    <style>
        #sticky-note-toggle{display: none !important;}
    </style>
    <div class="row bg-title">
        <!-- .page title -->
        <h4 class="page-title">  {{ __($pageTitle) }}</h4>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 bg-title-right">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.clients.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('app.edit')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/image-picker/image-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/switchery/dist/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/steps-form/steps.css') }}">
    <style>
        
        .text-primary{
            font-size: 24px !important;
        }

        .welcome-heading{
            font-size: 20px !important;
            font-weight: 400 !important; 
            margin-top: 60px !important;
        }

        .action-button{
            float: none !important;
        }
    </style>
@endpush

@section('content')
<div class="panel panel-default">
    <div class="panel-body welcome-panel-body" id="updateClient">
      <div>
        <img src="{{asset('img/welcome-2.png')}}" alt="" class="welcome-img-1" />
      </div>

      <div>
        <h3 class="text-primary text-center text-uppercase">CONGRATULATION!!</h3>

        <h3 class="text-center text-uppercase welcome-heading">WELCOME ON YOUR COLLABORATIVE PLATFORM FOR PROJECT MANAGEMENT AND REMOTE MANAGEMENT</h3>

        <div class="text-center">
          <a href="{{ route('admin.account-setup.edit-form') }}" class="welcome-btn btn btn-primary-blue text-uppercase">Next</a>
        </div>
      </div>

      <div style="align-self: flex-end">
        <img src="{{asset('img/welcome-2-small.png')}}" alt="" class="welcome-img-2" />
      </div>

    </div>


</div>
@endsection

@push('footer-script')
    <script src="{{ asset('plugins/steps-form/steps.js') }}"></script>
    <script src="{{ asset('plugins/image-picker/image-picker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/switchery/dist/switchery.min.js') }}"></script>


    <script>
        $(".image-picker").imagepicker();
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());

        });
        $('#companySettings #save-form').click(function () {
            $.easyAjax({
                url: '{{route('admin.account-setup.update', $global->id)}}',
                container: '#companySettings',
                type: "POST",
                data: $('#companySettings').serialize(),
                file:true,
                success: function (response) {
                    console.log(response);
                    if(response.status == 'success'){
                        $('#companySettings').siblings('.next').trigger('click');
                    }
                }
            })
        });
        $('#invoiceSettings #save-form').click(function () {
            $.easyAjax({
                url: '{{route('admin.account-setup.update-invoice', $invoiceSetting->id)}}',
                container: '#invoiceSettings',
                type: "POST",
                data: $('#invoiceSettings').serialize()
            })
        });

        $('#invoice_prefix, #invoice_digit, #estimate_prefix, #estimate_digit, #credit_note_prefix, #credit_note_digit').on('keyup', function () {
            genrateInvoiceNumber();
        });

        genrateInvoiceNumber();

        function genrateInvoiceNumber() {
            var invoicePrefix = $('#invoice_prefix').val();
            var invoiceDigit = $('#invoice_digit').val();
            var invoiceZero = '';
            for ($i=0; $i<invoiceDigit-1; $i++){
                invoiceZero = invoiceZero+'0';
            }
            invoiceZero = invoiceZero+'1';
            var invoice_no = invoicePrefix+'#'+invoiceZero;
            $('#invoice_look_like').val(invoice_no);

            var estimatePrefix = $('#estimate_prefix').val();
            var estimateDigit = $('#estimate_digit').val();
            var estimateZero = '';
            for ($i=0; $i<estimateDigit-1; $i++){
                estimateZero = estimateZero+'0';
            }
            estimateZero = estimateZero+'1';
            var estimate_no = estimatePrefix+'#'+estimateZero;
            $('#estimate_look_like').val(estimate_no);

            var creditNotePrefix = $('#credit_note_prefix').val();
            var creditNoteDigit = $('#credit_note_digit').val();
            var creditNoteZero = '';
            for ($i=0; $i<creditNoteDigit-1; $i++){
                creditNoteZero = creditNoteZero+'0';
            }
            creditNoteZero = creditNoteZero+'1';
            var creditNote_no = creditNotePrefix+'#'+creditNoteZero;
            $('#credit_note_look_like').val(creditNote_no);
        }
    </script>
    <script>
        $(".date-picker").datepicker({
            todayHighlight: true,
            autoclose: true,
            format: '{{ $global->date_picker_format }}',
        });
    </script>
@endpush
