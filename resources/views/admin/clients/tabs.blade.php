<style>
    .tab-btn{
        color: black !important;
    }
</style>
<div class="tabs">
    <div class="tabs-header">
        <a class="tab-btn {{request()->routeIs('admin.clients.show', $clientDetail->id) ? 'active' : ""}} " href="{{ route('admin.clients.show', $clientDetail->id) }}">@lang('modules.employees.profile')</a>
        <a class="tab-btn {{request()->routeIs('admin.clients.projects', $clientDetail->id) ? 'active' : ""}}" href="{{ route('admin.clients.projects', $clientDetail->id) }}"><span>@lang('app.menu.projects')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.clients.invoices', $clientDetail->id) ? 'active' : ""}}" href="{{ route('admin.clients.invoices', $clientDetail->id) }}"><span>@lang('app.menu.invoices')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.clients.payments', $clientDetail->id) ? 'active' : ""}}" href="{{ route('admin.clients.payments', $clientDetail->id) }}"><span>@lang('app.menu.reglement')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.contacts.show', $clientDetail->id) ? 'active' : ""}}" href="{{ route('admin.contacts.show', $clientDetail->id) }}"><span>@lang('app.menu.contacts')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.notes.show', $clientDetail->id) ? 'active' : ""}}" href="{{ route('admin.notes.show', $clientDetail->id) }}"><span>@lang('app.menu.notes')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.client-docs.show', $clientDetail->id) ? 'active' : ""}}" href="{{ route('admin.client-docs.show', $clientDetail->id) }}"><span>@lang('app.menu.documents')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.clients.contracts', $clientDetail->id) ? 'active' : ""}}" href="{{ route('admin.clients.contracts', $clientDetail->id) }}"><span>@lang('app.menu.contracts')</span></a>
        @if($gdpr->enable_gdpr)
        <a class="tab-btn {{request()->routeIs('admin.clients.gdpr', $clientDetail->id) ? 'active' : ""}}" href="{{ route('admin.clients.gdpr', $clientDetail->id) }}"><span>@lang('modules.gdpr.gdpr')</span></a>
        @endif
    </div>
</div>


