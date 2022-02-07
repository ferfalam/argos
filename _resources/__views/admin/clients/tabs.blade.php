<style>
    .tab-btn{
        color: black !important;
    }
</style>
<div class="tabs">
    <div class="tabs-header">
        <a class="tab-btn {{request()->routeIs('admin.clients.show', $client->id) ? 'active' : ""}} " href="{{ route('admin.clients.show', $client->id) }}">@lang('modules.employees.profile')</a>
        <a class="tab-btn {{request()->routeIs('admin.clients.projects', $client->id) ? 'active' : ""}}" href="{{ route('admin.clients.projects', $client->id) }}"><span>@lang('app.menu.projects')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.clients.invoices', $client->id) ? 'active' : ""}}" href="{{ route('admin.clients.invoices', $client->id) }}"><span>@lang('app.menu.invoices')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.contacts.show', $client->id) ? 'active' : ""}}" href="{{ route('admin.contacts.show', $client->id) }}"><span>@lang('app.menu.contacts')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.clients.payments', $client->id) ? 'active' : ""}}" href="{{ route('admin.clients.payments', $client->id) }}"><span>@lang('app.menu.payments')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.notes.show', $client->id) ? 'active' : ""}}" href="{{ route('admin.notes.show', $client->id) }}"><span>@lang('app.menu.notes')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.client-docs.show', $client->id) ? 'active' : ""}}" href="{{ route('admin.client-docs.show', $client->id) }}"><span>@lang('app.menu.documents')</span></a>
        @if($gdpr->enable_gdpr)
        <a class="tab-btn {{request()->routeIs('admin.clients.gdpr', $client->id) ? 'active' : ""}}" href="{{ route('admin.clients.gdpr', $client->id) }}"><span>@lang('modules.gdpr.gdpr')</span></a>
        @endif
    </div>
</div>


