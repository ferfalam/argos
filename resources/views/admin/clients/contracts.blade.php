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

    <x-tab-container title="app.menu.contacts">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.contracts.contractName')</th>
                    <th>@lang('modules.contracts.contractType')</th>
                    <th>@lang('app.project')</th>
                    <th>@lang('app.amount')</th>
                    <th>@lang('modules.contracts.startDate')</th>
                    <th>@lang('modules.contracts.endDate')</th>
                    <th>@lang('modules.contracts.signature')</th>
                </tr>
                </thead>
                @forelse($clientDetail->contracts as $key=>$contract)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{$contract->contract_name}}</td>
                        <td>{{$contract->contract_type->name}}</td>
                        <td>{{$contract->project->project_name}}</td>
                        <td>{{$contract->amount}}</td>
                        <td>{{$contract->start_date}}</td>
                        <td>{{$contract->end_date}}</td>
                        <td>{{$contract->signature->full_name}}</td> 
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">@lang('messages.noContractFound')</td>
                    </tr>
                @endforelse
                </tbody>
                <tbody id="timer-list">
            </table>
        </div>
    </x-tab-container>
    

@endsection

@push('footer-script')
    <script>
        $('ul.showClientTabs .clientProjects').addClass('tab-current');
    </script>
@endpush