<style>
    .tabs-style-line nav li.tab-current a{
        color: white !important;
    }
    .showProjectTabs li {
        background-color: grey;
    }
    .showProjectTabs a {
        padding-left: 5px !important;
        color: white !important;
    }

    .white-box{
        display: grid;
    }

    .tab-btn{
        padding-left: 20px;
        padding-right: 20px;
    }

    .tabs{
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>

<div class="tabs">
    <div class="tabs-header">
        <a class="tab-btn {{request()->routeIs('admin.projects.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.projects.show', $project->id) }}">@lang('modules.projects.overview')</a>
        @if(in_array('users.title',$modules))
        <a class="tab-btn projectMembers {{request()->routeIs('admin.project-members.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.project-members.show', $project->id) }}">@lang('modules.projects.members')</a>
        @endif
        <a class="tab-btn projectMilestones {{request()->routeIs('admin.milestones.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.milestones.show', $project->id) }}">@lang('modules.projects.milestones')</a>
        @if(in_array('projects.task',$modules))
        <a class="tab-btn {{request()->routeIs('admin.tasks.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.tasks.show', $project->id) }}">@lang('app.menu.tasks')</a>
        <a class="tab-btn {{request()->routeIs('admin.tasks.kanbanboard', $project->id) ? 'active' : ""}} " href="{{ route('admin.tasks.kanbanboard', $project->id) }}">@lang('modules.tasks.taskBoard')</a>
        @endif
        
        <a class="tab-btn projectFiles {{request()->routeIs('admin.files.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.files.show', $project->id) }}">@lang('modules.projects.files')</a>

        <a class="tab-btn projectInvoices {{request()->routeIs('admin.invoices.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.invoices.show', $project->id) }}">@lang('app.menu.invoices')</a>
        
        <a class="tab-btn projectInvoices {{request()->routeIs('admin.project-payments.showreglement', $project->id) ? 'active' : ""}} " href="{{ route('admin.project-payments.showreglement', $project->id) }}">@lang('app.menu.reglement')</a>
        
        <a class="tab-btn projectTimeLogs {{request()->routeIs('admin.time-logs.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.time-logs.show', $project->id) }}">@lang('app.menu.timeLogs')</a>
        
        @if(in_array('invoices',$modules))
        <a class="tab-btn projectDiscussion {{request()->routeIs('admin.projects.discussion', $project->id) ? 'active' : ""}} " href="{{ route('admin.projects.discussion', $project->id) }}">@lang('modules.projects.discussion')</a>
        @endif
        
        <a class="tab-btn projectNotes {{request()->routeIs('admin.project-notes.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.project-notes.show', $project->id) }}">@lang('modules.projects.notes')</a>
        
        <a class="tab-btn {{request()->routeIs('admin.projects.burndown-chart', $project->id) ? 'active' : ""}} " href="{{ route('admin.projects.burndown-chart', $project->id) }}">@lang('modules.projects.burndownChart')</a>
        
        @if (in_array('expenses', $modules))
        <a class="tab-btn {{request()->routeIs('admin.project-expenses.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.project-expenses.show', $project->id) }}">@lang('app.menu.expenses')</a>
        @endif
        
        @if(in_array('payments',$modules))
        <a class="tab-btn {{request()->routeIs('admin.project-payments.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.project-payments.show', $project->id) }}">@lang('app.menu.payments')</a>
        @endif

        <a class="tab-btn {{request()->routeIs('admin.projects.gantt', $project->id) ? 'active' : ""}} " href="{{ route('admin.projects.gantt', $project->id) }}">@lang('modules.projects.viewGanttChart')</a>

        <a class="tab-btn {{request()->routeIs('admin.project-ratings.show', $project->id) ? 'active' : ""}} " href="{{ route('admin.project-ratings.show', $project->id) }}">@lang('app.rating')</a>
{{--         
        <div class="col-md-1 text-center tabs-more">
            <div class="btn-group dropdown m-r-10">
                 <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-gears "></i></button>
                <ul role="menu" class="dropdown-menu pull-right">
                <li><a href="{{ route('admin.projects.burndown-chart', $project->id) }}"><i class="icon-graph" aria-hidden="true"></i> @lang('modules.projects.burndownChart')</a>
                </li>
                @if(in_array('expenses',$modules))
                  <li><a href="{{ route('admin.project-expenses.show', $project->id) }}"><i class="ti-shopping-cart" aria-hidden="true"></i> @lang('app.menu.expenses')</a></li>
                @endif
    
                @if(in_array('payments',$modules))
                    <li><a href="{{ route('admin.project-payments.show', $project->id) }}"><i class="fa fa-money" aria-hidden="true"></i> @lang('app.menu.payments')</a></li>
                @endif

                <li class="gantt">
                    <a href="{{ route('admin.projects.gantt', $project->id) }}"><i class="fa fa-bar-chart"></i>
                        <span>@lang('modules.projects.viewGanttChart')</span></a>
                </li>
                 <li class="projectRatings">
                     <a href="{{ route('admin.project-ratings.show', $project->id) }}">
                         <i class="fa fa-star" aria-hidden="true"></i> <span>@lang('app.rating')</span>
                     </a>
                 </li>

                </ul>
            </div>
        </div> --}}
    </div>
</div>
