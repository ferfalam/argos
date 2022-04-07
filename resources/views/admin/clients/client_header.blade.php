<style>
  .panel-right table tr td{
    padding: 0px !important;
  }
</style>
<div class="client-profile-panel panel">
    <div class="panel-body">
      <div class="panel-left">
        <img src="{{ $clientDetail->image_url }}" alt="" class="client-profile-img" />
        <div>
          @if(isset($contect))
          <h3 class="text-primary">{{ ucwords($contect->name) }}</h3>
          @endif
          <h3 class="text-danger">
            {{-- @if (!empty($client->client_details) && $client->client_details->company_name != '') --}}
                {{ $clientDetail->company_name }}
            {{-- @endif --}}
        </h3>
        </div>
      </div>
      <div class="panel-right">
        <table>
          <tr>
            <td style="display: revert"><p>@lang('modules.dashboard.totalProjects') :</p></td>
            <td><span class="">
              {{ $clientStats->totalProjects}}
            </span></td>
          </tr>
          <tr>
            <td><p>@lang('modules.contracts.totalContracts') :</p></td>
            <td><span>
              {{ $clientStats->totalContracts  }}
            </span></td>
          </tr>
          <tr>
            <td><p>@lang('modules.dashboard.totalInvoices') :</p></td>
            <td><span>
              {{ $clientStats->projectPayments  }}
            </span></td>
          </tr>
          <tr>
            <td><p>@lang('modules.dashboard.totalPaidAmount') :</p></td>
            <td><span>
              {{ $clientStats->totalUnpaidInvoices}}
            </span></td>
          </tr>
        </table>
      </div>
    </div>
</div>
