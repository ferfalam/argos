<style>
    .tab-btn{
        color: black !important;
    }
</style>
<div class="tabs">
    <div class="tabs-header">
        <a class="tab-btn {{request()->routeIs('admin.suppliers.show', $client->id) ? 'active' : ""}} " href="{{ route('admin.suppliers.show', $client->id) }}">@lang('modules.employees.profile')</a>
        <a class="tab-btn {{request()->routeIs('admin.clients.projects', $client->id) ? 'active' : ""}}" href=""><span>@lang('app.menu.projects')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.clients.invoices', $client->id) ? 'active' : ""}}" href=""><span>@lang('app.menu.invoices')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.supplier.contacts', $client->id) ? 'active' : ""}}" href="{{ route('admin.supplier.contacts', $client->id) }}"><span>@lang('app.menu.contacts')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.clients.payments', $client->id) ? 'active' : ""}}" href=""><span>@lang('app.menu.payments')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.notes.show', $client->id) ? 'active' : ""}}" href=""><span>@lang('app.menu.notes')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.client-docs.show', $client->id) ? 'active' : ""}}" href=""><span>@lang('app.menu.documents')</span></a>
        @if($gdpr->enable_gdpr)
        <a class="tab-btn {{request()->routeIs('admin.clients.gdpr', $client->id) ? 'active' : ""}}" href=""><span>@lang('modules.gdpr.gdpr')</span></a>
        @endif
    </div>
</div>


