<div class="tabs showClientTabs" style="margin-top: 0px">
    <div class="tabs-header">
        <a class="tab-btn {{ request()->routeIs('admin.currency.index') ? "active" : '' }}" href="{{ route('admin.currency.index') }}"> <span>@lang('modules.currencySettings.currencySetting')</span></a>
        <a class="tab-btn {{ request()->routeIs('admin.currency.currency-format') ? "active" : '' }}" href="{{ route('admin.currency.currency-format') }}"> <span>@lang('modules.currencySettings.currenyFormatSetting')</span></a>
    </div>
</div>
