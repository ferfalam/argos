<div class="client-profile-panel panel">
    <div class="panel-body">
      <div class="panel-left">
        <img src="{{ $clientDetail->image_url }}" alt="" class="client-profile-img" />
        <div>
          @if(isset($contect))
          <h3>{{ ucwords($contect->name) }}</h3>
          @endif
          <p>
            {{-- @if (!empty($client->client_details) && $client->client_details->company_name != '') --}}
                {{ $clientDetail->company_name }}
            {{-- @endif --}}
          </p>
        </div>
      </div>
      <div class="panel-right">
        <table>
          <tr>
            <td><p>@lang('modules.dashboard.totalProjects') :</p></td>
            <td><span class="color-primary">
              {{-- {{ $clientStats->totalProjects}} --}}
            </span></td>
          </tr>
          <tr>
            <td><p>@lang('app.earnings') :</p></td>
            <td><span>
              {{-- {{ $clientStats->projectPayments  }} --}}
            </span></td>
          </tr>
          <tr>
            <td><p>@lang('modules.dashboard.totalUnpaidInvoices') :</p></td>
            <td><span>
              {{-- {{ $clientStats->totalUnpaidInvoices}} --}}
            </span></td>
          </tr>
          <tr>
            <td><p>@lang('modules.contracts.totalContracts') :</p></td>
            <td><span>
              {{-- {{ $clientStats->totalContracts  }} --}}
            </span></td>
          </tr>
        </table>
      </div>
    </div>
</div>
