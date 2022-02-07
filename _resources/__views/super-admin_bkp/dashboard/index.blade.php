@extends('layouts.super-admin')

@section('page-title')
    <x-main-header>
        <div class="">
            <h1 class="heading-1">Welcome {{\Illuminate\Support\Facades\Auth::user()->name}} !</h1>
            <p class="color-danger">{{__($pageTitle)}}</p>
        </div>
    </x-main-header>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/calendar/dist/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/morrisjs/morris.css') }}">
    <!--Owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/owl.carousel/owl.carousel.min.css') }}">
    <!--Owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/owl.carousel/owl.theme.default.css') }}">
    <!--Owl carousel CSS -->

    <style>
        .col-in {
            padding: 0 20px !important;

        }

        .fc-event {
            font-size: 10px !important;
        }

        .filter-section-close{
            display: none;
        }
    </style>
@endpush

@section('content')
    <x-panel-container>
        <x-stat-card img="card-1.png" url="{{url('super-admin/companies')}}"  count="{{$totalCompanies}}" title="modules.dashboard.totalCompanies"></x-stat-card>
        <x-stat-card img="card-2.png" url=""  count="{{$activeCompanies}}" title="modules.dashboard.activeCompanies"></x-stat-card>
        <x-stat-card img="card-3.png" url=""  count="{{$expiredCompanies}}" title="modules.dashboard.licenseExpired"></x-stat-card>
        <x-stat-card img="card-4.png" url=""  count="{{$inactiveCompanies}}" title="modules.dashboard.inactiveCompanies"></x-stat-card>
        <x-stat-card img="card-5.png" url=""  count="{{count($allInvoices)}}" title="Invoices"></x-stat-card>
    </x-panel-container>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel">
                <div class="panel-heading">@lang('modules.superadmin.recentRegisteredCompanies')</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">@lang('app.name')</th>
                                <th class="text-center">@lang('app.email')</th>
                                <th class="text-center">@lang('app.menu.packages')</th>
                                <th class="text-center">Expire @lang('app.date')</th>
                                <th class="text-center">Created @lang('app.date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($recentRegisteredCompanies as $key => $recent)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }} </td>
                                    <td class="text-center"><a
                                                href="{{url('super-admin/companies').'?id='.$recent->id}}">{{ $recent->company_name }}</a> </td>
                                    <td class="text-center">{{ $recent->company_email }} </td>
                                    <td class="text-center">{{ ucwords($recent->package->name) }}
                                        ({{ ucwords($recent->package_type) }})
                                    </td>
                                    <td class="text-center">{{ $recent->licence_expire_on?$recent->licence_expire_on->format('M j, Y'):'' }} </td>
                                    <td class="text-center">{{ $recent->created_at->format('M j, Y') }} </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">@lang('messages.noRecordFound')</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
{{-- 
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">@lang('modules.superadmin.recentSubscriptions')</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">@lang('modules.client.companyName')</th>
                            <th class="text-center">@lang('app.menu.packages')</th>
                            <th class="text-center">@lang('app.date')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recentSubscriptions as $key => $recent)
                            <tr>
                                <td class="text-center">{{ $key + 1 }} </td>
                                <td class="text-center">{{ $recent->company_name }} </td>
                                <td class="text-center">{{ ucwords($recent->name) }}
                                    ({{ ucwords($recent->package_type) }})
                                </td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($recent->paid_on)->format('M j, Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">@lang('messages.noRecordFound')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">@lang('modules.superadmin.recentLicenseExpiredCompanies')</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">@lang('modules.client.companyName')</th>
                            <th class="text-center">@lang('app.menu.packages')</th>
                            <th class="text-center">@lang('app.date')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recentExpired as $key => $recent)
                            <tr>
                                <td class="text-center">{{ $key + 1 }} </td>
                                <td class="text-center">{{ $recent->company_name }} </td>
                                <td class="text-center">{{ ucwords($recent->package->name) }}
                                    ({{ ucwords($recent->package_type) }})
                                </td>
                                <td class="text-center">{{ $recent->updated_at->format('M j, Y') }} </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">@lang('messages.noRecordFound')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="modal fade bs-modal-md in" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModal"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Do you like worksuite? Help us Grow :)</h4>

                </div>
                <div class="modal-body">
                    <div class="note note-info font-14 m-l-5">

                        We hope you love it. If you do, would you mind taking 10 seconds to leave me a short review on
                        codecanyon?
                        <br>
                        This helps us to continue providing great products, and helps potential buyers to make confident
                        decisions.
                        <hr>
                        Thank you in advance for your review and for being a preferred customer.

                        <hr>

                        <p class="text-center">
                            <a href="{{\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()}}"> <img
                                        src="{{asset('img/review-worksuite.png')}}" alt=""></a>
                            <button type="button" class="btn btn-link" data-dismiss="modal"
                                    onclick="hideReviewModal('closed_permanently_button_pressed')">Hide Pop up
                                permanently
                            </button>
                            <button type="button" class="btn btn-link" data-dismiss="modal"
                                    onclick="hideReviewModal('already_reviewed_button_pressed')">Already Reviewed
                            </button>
                        </p>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()}}" target="_blank" type="button"
                       class="btn btn-success">Give Review</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('footer-script')

    <script src="{{ asset('plugins/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/morrisjs/morris.js') }}"></script>

    <script src="{{ asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>

    <!-- jQuery for carousel -->
    <script src="{{ asset('plugins/bower_components/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/owl.carousel/owl.custom.js') }}"></script>

    <!--weather icon -->
    <script src="{{ asset('plugins/bower_components/skycons/skycons.js') }}"></script>

    <script src="{{ asset('plugins/bower_components/calendar/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>

    <script>
        $(document).ready(function () {
            var chartData = {!!  $chartData !!};

            Morris.Area({
                element: 'morris-area-chart',
                data: chartData,
                lineColors: ['#01c0c8'],
                xkey: ['month'],
                ykeys: ['amount'],
                labels: ['Earning'],
                pointSize: 0,
                lineWidth: 0,
                resize: true,
                fillOpacity: 0.8,
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                hideHover: 'auto',
                parseTime: false
            });

            $('.vcarousel').carousel({
                interval: 3000
            })
        });

        function hidePopUp() {
            $.easyAjax({
                url: '{{route('super-admin.dashboard.stripe-pop-up-close')}}',
                type: "GET",
            })
        }

        $(".counter").counterUp({
            delay: 100,
            time: 1200
        });

    </script>
    <script>
        @if(\Froiden\Envato\Functions\EnvatoUpdate::showReview())
        $(document).ready(function () {
            $('#reviewModal').modal('show');
        })

        function hideReviewModal(type) {
            var url = "{{ route('hide-review-modal',':type') }}";
            url = url.replace(':type', type);

            $.easyAjax({
                url: url,
                type: "GET",
                container: "#reviewModal",
            });
        }
        @endif
    </script>
@endpush