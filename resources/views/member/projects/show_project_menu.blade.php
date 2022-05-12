
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
        <a class="tab-btn {{ request()->routeIs('member.projects.show', $project->id) ? 'active' : '' }}" href="{{ route('member.projects.show', $project->id) }}"><span>@lang('modules.projects.overview')</span></a>
        
        @if(in_array('users.title',$modules))
        <a class="tab-btn {{ request()->routeIs('member.project-members.show', $project->id) ? 'active' : '' }}"  href="{{ route('member.project-members.show', $project->id) }}"> <span>@lang('modules.projects.members')</span></a>
        @endif

        @if ($user->cans('view_projects'))
        <a class="tab-btn {{ request()->routeIs('member.milestones.show', $project->id) ? 'active' : '' }}"  href="{{ route('member.milestones.show', $project->id) }}"> <span>@lang('modules.projects.milestones')</span></a>
        @endif

        @if(in_array('projects.task',$modules))
        <a class="tab-btn {{ request()->routeIs('member.tasks.show', $project->id) ? 'active' : '' }}"  href="{{ route('member.tasks.show', $project->id) }}"> <span>@lang('app.menu.tasks')</span></a>
        @endif

        <a class="tab-btn {{ request()->routeIs('member.files.show', $project->id) ? 'active' : '' }}" href="{{ route('member.files.show', $project->id) }}"> <span>@lang('modules.projects.files')</span></a>

        @if(in_array('timelogs',$modules))
        <a class="tab-btn {{ request()->routeIs('member.time-log.show-log', $project->id) ? 'active' : '' }}" href="{{ route('member.time-log.show-log', $project->id) }}"> <span>@lang('app.menu.timeLogs')</span></a>
        @endif
        
        <a class="tab-btn {{ request()->routeIs('member.projects.discussion', $project->id) ? 'active' : '' }}" href="{{ route('member.projects.discussion', $project->id) }}">
            <span>@lang('modules.projects.discussion')</span>
        </a>
        
        <a class="tab-btn {{ request()->routeIs('member.projects.gantt', [$project->id]) ? 'active' : '' }}" href="{{ route('member.projects.gantt', [$project->id]) }}">
            <span>@lang('modules.projects.viewGanttChart')</span>
        </a>
        
        @if($project->visible_rating_employee)
        <a class="tab-btn {{ request()->routeIs('member.project-ratings.show', $project->id) ? 'active' : '' }}" href="{{ route('member.project-ratings.show', $project->id) }}">
            <span>@lang('app.rating')</span>
        </a>
        @endif
        <a class="tab-btn {{ request()->routeIs('member.project-notes.show', $project->id) ? 'active' : '' }}" href="{{ route('member.project-notes.show', $project->id) }}">
            <span>@lang('modules.projects.notes')</span>
        </a>
    </div>
</div>
