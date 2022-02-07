@extends('layouts.client-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title">  {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 bg-title-right">
            <div class="col-md-3 pull-right hidden-xs hidden-sm">
                @if ($company_details->count() > 1)
                    <select class="selectpicker company-switcher" data-width="fit" name="companies" id="companies">
                        @foreach ($company_details as $company_detail)
                            <option {{ $company_detail->company->id === $global->id ? 'selected' : '' }} value="{{ $company_detail->company->id }}">{{ ucfirst($company_detail->company->company_name) }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <ol class="breadcrumb">
                <li><a href="{{ route('client.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li class="active">{{ __($pageTitle) }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
<style>
    .col-in {
        padding: 0 20px !important;

    }

    .fc-event{
        font-size: 10px !important;
    }
    .front-dashboard .white-box{
        margin-bottom: 8px;
    }

    .list-task .list-group-item, .list-task .list-group-item:first-child {
        display: -webkit-box;
    }

    .list-task .list-group-item{
        display: flex;
    }

    @media (min-width: 769px) {
        .panel-wrapper{
            height: 530px;
            overflow-y: auto;
        }
    }

</style>
@endpush

@section('content')
    <x-panel-container>
        @if(in_array('projects',$modules))
        <x-stat-card count="{{ $counts->totalProjects }}" img="card-1.png" title="modules.dashboard.totalProjects"></x-stat-card>
        @endif

        @if(in_array('tickets',$modules))
        <x-stat-card count="{{ $counts->totalUnResolvedTickets }}" img="card-2.png" title="modules.tickets.totalUnresolvedTickets"></x-stat-card>
        @endif
        
        @if(in_array('invoices',$modules))
        <x-stat-card count="{{ floor($counts->totalPaidAmount) }}" img="card-3.png" title="modules.dashboard.totalPaidAmount"></x-stat-card>
        <x-stat-card count="{{ floor($counts->totalUnpaidAmount) }}" img="card-4.png" title="modules.dashboard.totalOutstandingAmount"></x-stat-card>
        @endif
    </x-panel-container>

    <div class="row" >
        @if(in_array('projects',$modules))
        <div class="col-md-6" id="project-timeline">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang("modules.dashboard.projectActivityTimeline")</div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="steamline">
                            @foreach($projectActivities as $activity)
                                <div class="sl-item">
                                    <div class="sl-left"><i class="fa fa-circle text-info"></i>
                                    </div>
                                    <div class="sl-right">
                                        <div><h6><a style="font-family: 'Roboto', sans-serif" href="{{ route('client.projects.show', $activity->project_id) }}" class="text-danger"><span style="font-weight: bold">{{ ucwords($activity->project_name) }}</span>:</a> {{ $activity->activity }}</h6> <span class="sl-date">{{ $activity->created_at->timezone($global->timezone)->diffForHumans() }}</span></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(in_array('projects',$modules))
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.dashboard.upcomingPayments')</div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <ul class="list-task list-group" data-role="tasklist">
                            <li class="list-group-item row" data-role="task">
                                <div class="col-xs-4"><strong>@lang('app.invoiceNo')</strong> </div>
                                <div class="col-xs-5"><span ><strong>@lang('app.amount')</strong></span></div>
                                <span class="pull-right"><strong>@lang('modules.dashboard.dueDate')</strong></span>
                            </li>
                            @forelse($upcomingInvoices as $key=>$invoice)
                                <a href="{{ route('client.invoices.show', $invoice->id) }}" >
                                    <li class="list-group-item row" data-role="task">
                                        <div class="col-xs-4">
                                                <a href="{{ route('client.invoices.show', $invoice->id) }}" class="font-12">{{ ucwords($invoice->invoice_number) }}</a>
                                        </div>
                                        <div class="col-xs-5">
                                            {{ number_format((float)$invoice->amountDue(), 2, '.', '') }}
                                        </div>
                                        <label class="label label-danger pull-right col-xs-3">{{ $invoice->due_date->format($global->date_format) }}</label>
                                    </li>
                                </a>
                            @empty
                                <li class="list-group-item" data-role="task">
                                    @lang("messages.noUpcomingPayments")
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection
