<style>
    .tab-btn{
        color: black !important;
    }
</style>
<div class="tabs">
    <div class="tabs-header">
        <a class="tab-btn {{request()->routeIs('admin.suppliers.show', $supplierDetail->id) ? 'active' : ""}} " href="{{ route('admin.suppliers.show', $supplierDetail->id) }}">@lang('modules.employees.profile')</a>
        <a class="tab-btn {{request()->routeIs('admin.supplier.projects', $supplierDetail->id) ? 'active' : ""}}" href="{{ route('admin.supplier.projects', $supplierDetail->id) }} "><span>@lang('app.menu.projects')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.supplier.invoices', $supplierDetail->id) ? 'active' : ""}}" href=" {{ route('admin.supplier.invoices', $supplierDetail->id) }}"><span>@lang('app.menu.invoices')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.supplier.contacts', $supplierDetail->id) ? 'active' : ""}}" href="{{ route('admin.supplier.contacts', $supplierDetail->id) }}"><span>@lang('app.menu.contacts')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.suppliers.payments', $supplierDetail->id) ? 'active' : ""}}" href="{{ route('admin.suppliers.payments', $supplierDetail->id) }}"><span>@lang('app.menu.payments')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.suppliersNotes.show', $supplierDetail->id) ? 'active' : ""}}" href="{{ route('admin.suppliersNotes.show', $supplierDetail->id) }}"><span>@lang('app.menu.notes')</span></a>
        <a class="tab-btn {{request()->routeIs('admin.suppliers-docs.show', $supplierDetail->id) ? 'active' : ""}}" href="{{ route('admin.suppliers-docs.show',$supplierDetail->id) }}"><span>@lang('app.menu.documents')</span></a>
        @if($gdpr->enable_gdpr)
        <a class="tab-btn {{request()->routeIs('admin.clients.gdpr', $supplierDetail->id) ? 'active' : ""}}" href=""><span>@lang('modules.gdpr.gdpr')</span></a>
        @endif
    </div>
</div>


