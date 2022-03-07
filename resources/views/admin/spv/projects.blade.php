@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>
</x-main-header>
@endsection


@section('content')

    @include('admin.spv.client_header')
        
    @include('admin.spv.tabs')

    <x-tab-container title="app.menu.projects">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.client.projectName')</th>
                    <th>@lang('modules.client.startedOn')</th>
                    <th>@lang('modules.client.deadline')</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody id="timer-list">
                @forelse($client->projects as $key=>$project)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ ucwords($project->project_name) }}</td>
                        <td>{{ $project->start_date->format($global->date_format) }}</td>
                        <td>@if($project->deadline){{ $project->deadline->format($global->date_format) }}@else - @endif</td>
                        <td><a href="{{ route('admin.projects.show', $project->id) }}" class="label label-info">@lang('modules.client.viewDetails')</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">@lang('messages.noProjectFound')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </x-tab-container>
    

@endsection

@push('footer-script')
    <script>
        $('ul.showClientTabs .clientProjects').addClass('tab-current');
    </script>
@endpush