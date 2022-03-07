<style>
    .tab-btn{
        color: black !important;
    }
</style>
<div class="tabs">
    <div class="tabs-header">
        <a class="tab-btn {{request()->routeIs('admin.spv.show', $client->id) ? 'active' : ""}} " href="{{ route('admin.spv.show', $client->id) }}">@lang('modules.employees.profile')</a>
        <a class="tab-btn {{request()->routeIs('admin.spv.projects', $client->id) ? 'active' : ""}}" href="{{ route('admin.spv.projects', $client->id) }}"><span>@lang('app.menu.projects')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv.invoices', $client->id) ? 'active' : ""}}" href="{{ route('admin.spv.invoices', $client->id) }}"><span>@lang('app.menu.invoices')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv-contacts', $client->id) ? 'active' : ""}}" href="{{ route('admin.spv-contacts', $client->id) }}"><span>@lang('app.menu.contacts')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv.payments', $client->id) ? 'active' : ""}}" href="{{ route('admin.spv.payments', $client->id) }}"><span>@lang('app.menu.payments')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv.notes', $client->id) ? 'active' : ""}}" href="{{ route('admin.spv.notes', $client->id) }}"><span>@lang('app.menu.notes')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.spv-client-docs', $client->id) ? 'active' : ""}}" href="{{ route('admin.spv-client-docs', $client->id) }}"><span>@lang('app.menu.documents')</span></a>
        @if($gdpr->enable_gdpr)
        <a class="tab-btn {{request()->routeIs('admin.spv.gdpr', $client->id) ? 'active' : ""}}" href="{{ route('admin.spv.gdpr', $client->id) }}"><span>@lang('modules.gdpr.gdpr')</span></a>
        @endif
    </div>
</div>


