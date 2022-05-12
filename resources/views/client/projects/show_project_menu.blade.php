<div class="tabs" style="margin-top: 20px; margin-bottom:40px;">
    <div class="tabs-header">
        <a class="tab-btn {{request()->routeIs('client.projects.show', $project->id) ? 'active' : ""}} " href="{{ route('client.projects.show', $project->id) }}">@lang('modules.projects.overview')</a>
        
        @if(in_array('users.title',$modules))
        <a class="tab-btn {{request()->routeIs('client.project-members.show', $project->id) ? 'active' : ""}} " href="{{ route('client.project-members.show', $project->id) }}">@lang('modules.projects.members')</a>
        @endif

        <a class="tab-btn {{request()->routeIs('client.milestones.show', $project->id) ? 'active' : ""}} " href="{{ route('client.milestones.show', $project->id) }}">@lang('modules.projects.milestones')</a>

        @if($project->client_view_task == 'enable' && in_array('projects.task',$modules))
        <a class="tab-btn {{request()->routeIs('client.tasks.edit', $project->id) ? 'active' : ""}} " href="{{ route('client.tasks.edit', $project->id) }}">@lang('app.menu.tasks')</a>
        @endif
        
        <a class="tab-btn {{request()->routeIs('client.files.show', $project->id) ? 'active' : ""}} " href="{{ route('client.files.show', $project->id) }}">@lang('modules.projects.files')</a>

        @if(in_array('timelogs',$modules))
        <a class="tab-btn {{request()->routeIs('client.time-log.show', $project->id) ? 'active' : ""}} " href="{{ route('client.time-log.show', $project->id) }}">@lang('app.menu.timeLogs')</a>
        @endif

        @if(in_array('invoices',$modules))
        <a class="tab-btn {{request()->routeIs('client.project-invoice.show', $project->id) ? 'active' : ""}} " href="{{ route('client.project-invoice.show', $project->id) }}">@lang('app.menu.invoices')</a>
        @endif
        
        @if(in_array('expenses',$modules))
        <a class="tab-btn {{request()->routeIs('client.project-expenses.show', $project->id) ? 'active' : ""}} " href="{{ route('client.project-expenses.show', $project->id) }}">@lang('app.menu.expenses')</a>
        @endif
        
        @if(in_array('payments',$modules))
        <a class="tab-btn {{request()->routeIs('client.project-payments.show', $project->id) ? 'active' : ""}} " href="{{ route('client.project-payments.show', $project->id) }}">@lang('app.menu.payments')</a>
        @endif
        
        @if($project->status == 'finished')
        <a class="tab-btn {{request()->routeIs('client.project-ratings.show', $project->id) ? 'active' : ""}} " href="{{ route('client.project-ratings.show', $project->id) }}">@lang('app.rating')</a>
        @endif
        
        <a class="tab-btn {{request()->routeIs('client.project-notes.show', $project->id) ? 'active' : ""}} " href="{{ route('client.project-notes.show', $project->id) }}">@lang('modules.projects.notes')</a>
    </div>
</div>

