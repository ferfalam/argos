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

        .panel-container .panel{
            height: 100%;
            display: flex;
        }

        .panel-container .panel .panel-body{
            width: 100%;
        }

        #myChart rect{
            border-top-left-radius: 200px !important;
            border-top-right-radius: 200px !important;
            stroke : #000000;
            stroke-width: 2px;
            rx: 10;
            ry : 10;
        }

        .dashboard-panel-table th{
            font-size: 13px;
            font-weight: 400;
            color: #A1A5B7;
        }
        
        .dashboard-panel-table tr .main-drop .user-img{
            display: flex;
            align-items: center;
            font-size: 14px;
            line-height: 21px;
            color: #181C32;
            gap: 10px;
        }

        .dashboard-panel-table tbody tr td{
            font-size: 14px;
            line-height: 21px;
            color: #181C32;
        }

        .dashboard-panel-table tbody tr .text-sm{
            font-size: 10px;
            line-height: 1;
            color: #A1A5B7;
        }

        .dashboard-panel-table tbody tr td .btn{
            background: #F5F8FA !important;
            border-radius: 6.175px !important;
        }

        .dashboard-panel-table tbody tr td{
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
@endpush

@section('content')
    <x-panel-container>
        <x-stat-card img="card-1.png" url="{{url('super-admin/companies')}}"  count="{{$totalCompanies}}" title="Collaborateurs"></x-stat-card>
        <x-stat-card img="card-2.png" url=""  count="{{$activeCompanies}}" title="Recherche en cours"></x-stat-card>
        <x-stat-card img="card-3.png" url=""  count="{{$expiredCompanies}}" title="Développement en cours"></x-stat-card>
        <x-stat-card img="card-4.png" url=""  count="{{$inactiveCompanies}}" title="Tâches en cours"></x-stat-card>
        <x-stat-card img="card-5.png" url=""  count="{{count($allInvoices)}}" title="Total Contacts"></x-stat-card>
    </x-panel-container>

    <div class="row d-flex">
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
                                <th class="text-center">@lang('app.administrator')</th>
                                <th class="text-center">@lang('app.city')</th>
                                <th class="text-center">@lang('app.country')</th>
                                <th class="text-center">@lang('app.telephone')</th>
                                <th class="text-center">@lang('app.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($recentRegisteredCompanies as $key => $recent)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }} </td>
                                    <td class="text-center"><a href="{{route('super-admin.companies.edit', [$recent->id])}}">{{ $recent->company_name }}</a> </td>
                                    <td class="text-center">
                                        <div class="table-admin-images">
                                            <img src="{{asset('img/user-1.png')}}" alt="">
                                            <img src="{{asset('img/user-2.png')}}" alt="">
                                            <img src="{{asset('img/user-3.png')}}" alt="">
                                            <img src="{{asset('img/user-4.png')}}" alt="">
                                        </div>
                                    </td>
                                    <td class="text-center">Ville</td>
                                    <td class="text-center">
                                        <span class="flag-icon flag-icon-fr "></span>
                                    </td>
                                    <td class="text-center">{{ $recent->company_phone }} </td>
                                    <td class="text-center">
                                        <div class="dropup text-center">
                                            <span class="dropdown-toggle text-center" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <ion-icon name="ellipsis-vertical"></ion-icon>
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                              <li><a href="#">Action</a></li>
                                              <li><a href="#">Another action</a></li>
                                            </ul>
                                        </div>
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
    </div>

    <div class="row d-flex" style="margin-top: 20px">
        <div class="col-sm-12 col-md-6">
            <div class="panel">
                <div class="panel-heading text-uppercase">
                    à Définir
                </div>
                <div class="panel-body">
                    <div id="myChart" width="400" height="400"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="panel">
                <div class="panel-heading text-uppercase">
                    à Définir
                </div>
                <div class="panel-body">
                    <table class="dashboard-panel-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nom</th>
                                <th>Poste/Société</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td class="main-drop">
                                    <div class="user-img">
                                        <img src="{{ $user->image_url }}" alt="">
                                        <p>Cédric Sevran</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">Ingénieur</p>
                                    <p class="text-sm">E33 Lisbonne</p>
                                </td>
                                <td>
                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6666 5.5H4.33325C2.66659 5.5 1.33325 4.5 1.33325 3.25C1.33325 2 2.66659 1 4.33325 1H11.6666C13.3333 1 14.6666 2 14.6666 3.25C14.6666 4.5 13.3333 5.5 11.6666 5.5ZM9.99992 3.25C9.99992 3.95 10.7333 4.5 11.6666 4.5C12.5999 4.5 13.3333 3.95 13.3333 3.25C13.3333 2.55 12.5999 2 11.6666 2C10.7333 2 9.99992 2.55 9.99992 3.25Z" fill="black"/>
                                            <path opacity="0.3" d="M11.6666 11H4.33325C2.66659 11 1.33325 10 1.33325 8.75C1.33325 7.5 2.66659 6.5 4.33325 6.5H11.6666C13.3333 6.5 14.6666 7.5 14.6666 8.75C14.6666 10 13.3333 11 11.6666 11ZM2.66659 8.75C2.66659 9.45 3.39992 10 4.33325 10C5.26659 10 5.99992 9.45 5.99992 8.75C5.99992 8.05 5.26659 7.5 4.33325 7.5C3.39992 7.5 2.66659 8.05 2.66659 8.75Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M14.2667 4.17651L12.8274 5.2555L8.99006 2.3775L10.4287 1.29797C10.6833 1.10711 11.0285 0.999939 11.3884 0.999939C11.7483 0.999939 12.0935 1.10711 12.3481 1.29797L14.2667 2.737C14.5212 2.9279 14.6642 3.18677 14.6642 3.45672C14.6642 3.72667 14.5212 3.98561 14.2667 4.17651ZM2.45806 10.966L6.59139 9.9325L2.75406 7.0545L1.37605 10.1545C1.32549 10.2677 1.31808 10.3894 1.35465 10.5056C1.39122 10.6218 1.47033 10.7281 1.58305 10.8124C1.69579 10.8967 1.83767 10.9557 1.99273 10.9829C2.14778 11.01 2.30986 11.0042 2.46072 10.966H2.45806Z" fill="black"/>
                                            <path d="M3.71593 10.65L2.46126 10.964C2.31053 11.0016 2.14882 11.007 1.99422 10.9797C1.83962 10.9523 1.69822 10.8932 1.58586 10.8089C1.4735 10.7247 1.39461 10.6187 1.358 10.5028C1.32139 10.3868 1.32852 10.2656 1.37859 10.1525L1.79726 9.211L3.71593 10.65ZM2.75659 7.0525L6.59393 9.9305L12.8299 5.2535L8.99259 2.37549L2.75659 7.0525Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33325 4.5C3.33325 4.22386 3.63173 4 3.99992 4H11.9999C12.3681 4 12.6666 4.22386 12.6666 4.5V9C12.6666 9.82845 11.7712 10.5 10.6666 10.5H5.33325C4.22869 10.5 3.33325 9.82845 3.33325 9V4.5Z" fill="black"/>
                                            <path opacity="0.5" d="M3.33325 2.5C3.33325 2.22386 3.63173 2 3.99992 2H11.9999C12.3681 2 12.6666 2.22386 12.6666 2.5C12.6666 2.77614 12.3681 3 11.9999 3H3.99992C3.63173 3 3.33325 2.77614 3.33325 2.5Z" fill="black"/>
                                            <path opacity="0.5" d="M6 2C6 1.72386 6.29848 1.5 6.66667 1.5H9.33333C9.70153 1.5 10 1.72386 10 2H6Z" fill="black"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td class="main-drop">
                                    <div class="user-img">
                                        <img src="{{ $user->image_url }}" alt="">
                                        <p>Cédric Sevran</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">Designer</p>
                                    <p class="text-sm">E33 Lisbonne</p>
                                </td>
                                <td>
                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6666 5.5H4.33325C2.66659 5.5 1.33325 4.5 1.33325 3.25C1.33325 2 2.66659 1 4.33325 1H11.6666C13.3333 1 14.6666 2 14.6666 3.25C14.6666 4.5 13.3333 5.5 11.6666 5.5ZM9.99992 3.25C9.99992 3.95 10.7333 4.5 11.6666 4.5C12.5999 4.5 13.3333 3.95 13.3333 3.25C13.3333 2.55 12.5999 2 11.6666 2C10.7333 2 9.99992 2.55 9.99992 3.25Z" fill="black"/>
                                            <path opacity="0.3" d="M11.6666 11H4.33325C2.66659 11 1.33325 10 1.33325 8.75C1.33325 7.5 2.66659 6.5 4.33325 6.5H11.6666C13.3333 6.5 14.6666 7.5 14.6666 8.75C14.6666 10 13.3333 11 11.6666 11ZM2.66659 8.75C2.66659 9.45 3.39992 10 4.33325 10C5.26659 10 5.99992 9.45 5.99992 8.75C5.99992 8.05 5.26659 7.5 4.33325 7.5C3.39992 7.5 2.66659 8.05 2.66659 8.75Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M14.2667 4.17651L12.8274 5.2555L8.99006 2.3775L10.4287 1.29797C10.6833 1.10711 11.0285 0.999939 11.3884 0.999939C11.7483 0.999939 12.0935 1.10711 12.3481 1.29797L14.2667 2.737C14.5212 2.9279 14.6642 3.18677 14.6642 3.45672C14.6642 3.72667 14.5212 3.98561 14.2667 4.17651ZM2.45806 10.966L6.59139 9.9325L2.75406 7.0545L1.37605 10.1545C1.32549 10.2677 1.31808 10.3894 1.35465 10.5056C1.39122 10.6218 1.47033 10.7281 1.58305 10.8124C1.69579 10.8967 1.83767 10.9557 1.99273 10.9829C2.14778 11.01 2.30986 11.0042 2.46072 10.966H2.45806Z" fill="black"/>
                                            <path d="M3.71593 10.65L2.46126 10.964C2.31053 11.0016 2.14882 11.007 1.99422 10.9797C1.83962 10.9523 1.69822 10.8932 1.58586 10.8089C1.4735 10.7247 1.39461 10.6187 1.358 10.5028C1.32139 10.3868 1.32852 10.2656 1.37859 10.1525L1.79726 9.211L3.71593 10.65ZM2.75659 7.0525L6.59393 9.9305L12.8299 5.2535L8.99259 2.37549L2.75659 7.0525Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33325 4.5C3.33325 4.22386 3.63173 4 3.99992 4H11.9999C12.3681 4 12.6666 4.22386 12.6666 4.5V9C12.6666 9.82845 11.7712 10.5 10.6666 10.5H5.33325C4.22869 10.5 3.33325 9.82845 3.33325 9V4.5Z" fill="black"/>
                                            <path opacity="0.5" d="M3.33325 2.5C3.33325 2.22386 3.63173 2 3.99992 2H11.9999C12.3681 2 12.6666 2.22386 12.6666 2.5C12.6666 2.77614 12.3681 3 11.9999 3H3.99992C3.63173 3 3.33325 2.77614 3.33325 2.5Z" fill="black"/>
                                            <path opacity="0.5" d="M6 2C6 1.72386 6.29848 1.5 6.66667 1.5H9.33333C9.70153 1.5 10 1.72386 10 2H6Z" fill="black"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td class="main-drop">
                                    <div class="user-img">
                                        <img src="{{ $user->image_url }}" alt="">
                                        <p>Cédric Sevran</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">Business Developper</p>
                                    <p class="text-sm">E33 Singapore</p>
                                </td>
                                <td>
                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6666 5.5H4.33325C2.66659 5.5 1.33325 4.5 1.33325 3.25C1.33325 2 2.66659 1 4.33325 1H11.6666C13.3333 1 14.6666 2 14.6666 3.25C14.6666 4.5 13.3333 5.5 11.6666 5.5ZM9.99992 3.25C9.99992 3.95 10.7333 4.5 11.6666 4.5C12.5999 4.5 13.3333 3.95 13.3333 3.25C13.3333 2.55 12.5999 2 11.6666 2C10.7333 2 9.99992 2.55 9.99992 3.25Z" fill="black"/>
                                            <path opacity="0.3" d="M11.6666 11H4.33325C2.66659 11 1.33325 10 1.33325 8.75C1.33325 7.5 2.66659 6.5 4.33325 6.5H11.6666C13.3333 6.5 14.6666 7.5 14.6666 8.75C14.6666 10 13.3333 11 11.6666 11ZM2.66659 8.75C2.66659 9.45 3.39992 10 4.33325 10C5.26659 10 5.99992 9.45 5.99992 8.75C5.99992 8.05 5.26659 7.5 4.33325 7.5C3.39992 7.5 2.66659 8.05 2.66659 8.75Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M14.2667 4.17651L12.8274 5.2555L8.99006 2.3775L10.4287 1.29797C10.6833 1.10711 11.0285 0.999939 11.3884 0.999939C11.7483 0.999939 12.0935 1.10711 12.3481 1.29797L14.2667 2.737C14.5212 2.9279 14.6642 3.18677 14.6642 3.45672C14.6642 3.72667 14.5212 3.98561 14.2667 4.17651ZM2.45806 10.966L6.59139 9.9325L2.75406 7.0545L1.37605 10.1545C1.32549 10.2677 1.31808 10.3894 1.35465 10.5056C1.39122 10.6218 1.47033 10.7281 1.58305 10.8124C1.69579 10.8967 1.83767 10.9557 1.99273 10.9829C2.14778 11.01 2.30986 11.0042 2.46072 10.966H2.45806Z" fill="black"/>
                                            <path d="M3.71593 10.65L2.46126 10.964C2.31053 11.0016 2.14882 11.007 1.99422 10.9797C1.83962 10.9523 1.69822 10.8932 1.58586 10.8089C1.4735 10.7247 1.39461 10.6187 1.358 10.5028C1.32139 10.3868 1.32852 10.2656 1.37859 10.1525L1.79726 9.211L3.71593 10.65ZM2.75659 7.0525L6.59393 9.9305L12.8299 5.2535L8.99259 2.37549L2.75659 7.0525Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <button class="btn">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33325 4.5C3.33325 4.22386 3.63173 4 3.99992 4H11.9999C12.3681 4 12.6666 4.22386 12.6666 4.5V9C12.6666 9.82845 11.7712 10.5 10.6666 10.5H5.33325C4.22869 10.5 3.33325 9.82845 3.33325 9V4.5Z" fill="black"/>
                                            <path opacity="0.5" d="M3.33325 2.5C3.33325 2.22386 3.63173 2 3.99992 2H11.9999C12.3681 2 12.6666 2.22386 12.6666 2.5C12.6666 2.77614 12.3681 3 11.9999 3H3.99992C3.63173 3 3.33325 2.77614 3.33325 2.5Z" fill="black"/>
                                            <path opacity="0.5" d="M6 2C6 1.72386 6.29848 1.5 6.66667 1.5H9.33333C9.70153 1.5 10 1.72386 10 2H6Z" fill="black"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>

                            

                        </tbody>
                    </table>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script> --}}
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

        const bars = Morris.Bar({
            element: 'myChart',
            data: [
                { y: '2006', a: 100, b: 90 },
                { y: '2007', a: 75,  b: 65 },
                { y: '2008', a: 50,  b: 40 },
                { y: '2009', a: 75,  b: 65 },
                { y: '2010', a: 50,  b: 40 },
                { y: '2011', a: 75,  b: 65 },
                { y: '2012', a: 100, b: 90 }
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            barColors : ['rgba(0, 158, 247, 0.85)', 'rgba(228, 230, 239, 0.85)'],
            barShape: 'soft'
        });


        // $(document).ready(function () {
        //     var chartData = {!!  $chartData !!};

        //     Morris.Area({
        //         element: 'morris-area-chart',
        //         data: chartData,
        //         lineColors: ['#01c0c8'],
        //         xkey: ['month'],
        //         ykeys: ['amount'],
        //         labels: ['Earning'],
        //         pointSize: 0,
        //         lineWidth: 0,
        //         resize: true,
        //         fillOpacity: 0.8,
        //         behaveLikeLine: true,
        //         gridLineColor: '#e0e0e0',
        //         hideHover: 'auto',
        //         parseTime: false
        //     });

        //     $('.vcarousel').carousel({
        //         interval: 3000
        //     })
        // });

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