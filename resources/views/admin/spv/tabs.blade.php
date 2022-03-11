<style>
    .tab-btn{
        color: black !important;
    }
</style>
<div class="tabs">
    <div class="tabs-header">
        <a class="tab-btn {{request()->routeIs('admin.spv.show', $spvDetails->id) ? 'active' : ""}} " href="{{ route('admin.spv.show', $spvDetails->id) }}">@lang('modules.employees.profile')</a>
        <a class="tab-btn {{request()->routeIs('admin.spv.projects', $spvDetails->id) ? 'active' : ""}}" href="{{ route('admin.spv.projects', $spvDetails->id) }}"><span>@lang('app.menu.projects')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv.invoices', $spvDetails->id) ? 'active' : ""}}" href="{{ route('admin.spv.invoices', $spvDetails->id) }}"><span>@lang('app.menu.invoices')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv-contacts', $spvDetails->id) ? 'active' : ""}}" href="{{ route('admin.spv-contacts', $spvDetails->id) }}"><span>@lang('app.menu.contacts')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv.payments', $spvDetails->id) ? 'active' : ""}}" href="{{ route('admin.spv.payments', $spvDetails->id) }}"><span>@lang('app.menu.payments')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv.notes', $spvDetails->id) ? 'active' : ""}}" href="{{ route('admin.spv.notes', $spvDetails->id) }}"><span>@lang('app.menu.notes')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv-client-docs', $spvDetails->id) ? 'active' : ""}}" href="{{ route('admin.spv-client-docs', $spvDetails->id) }}"><span>@lang('app.menu.documents')</span></a>
        @if($gdpr->enable_gdpr)
        <a class="tab-btn {{request()->routeIs('admin.spv.gdpr', $spvDetails->id) ? 'active' : ""}}" href="{{ route('admin.spv.gdpr', $spvDetails->id) }}"><span>@lang('modules.gdpr.gdpr')</span></a>
        @endif
    </div>
</div>


