{!! Form::open(['id'=>'storePayments','class'=>'ajax-form','method'=>'POST']) !!}        
  <x-filter-form-group label="app.selectDateRange">
      <div id="reportrange" class="form-control reportrange">
          <i class="fa fa-calendar"></i>&nbsp;
          <span></span> <i class="fa fa-caret-down pull-right"></i>
      </div>

      <input type="hidden" class="form-control" id="start-date" placeholder="@lang('app.startDate')"
              value=""/>
      <input type="hidden" class="form-control" id="end-date" placeholder="@lang('app.endDate')"
              value=""/>
  </x-filter-form-group>

  @if(in_array('projects.title', $modules))
  <x-filter-form-group label="app.selectProject">
      <select class="select2 form-control" data-placeholder="@lang('app.selectProject')" id="project_id">
          <option value="all">@lang('modules.client.all')</option>
              @foreach($projects as $project)
                  <option value="{{ $project->id }}">{{ ucwords($project->project_name) }}</option>
              @endforeach
      </select>            
  </x-filter-form-group>
  @endif

  <x-filter-form-group label="app.selectTask">
      <select class="select2 form-control" data-placeholder="@lang('app.selectTask')" id="task_id">
          <option value="all">@lang('modules.client.all')</option>
          @foreach($tasks as $task)
              <option value="{{ $task->id }}">{{ ucwords($task->heading) }}</option>
          @endforeach
      </select>
  </x-filter-form-group>

  <x-filter-form-group label="modules.employees.title">
      <select class="form-control select2" name="employee" id="employee" data-style="form-control">
          <option value="all">@lang('modules.client.all')</option>
          @forelse($employees as $employee)
              <option value="{{$employee->id}}">{{ ucfirst($employee->name) }}</option>
          @empty
          @endforelse
      </select>
  </x-filter-form-group>

  <x-filter-form-group label="app.invoiceGenerate">
      <select class="form-control select2" name="invoice_generate" id="invoice_generate" data-style="form-control">
          <option value="all">@lang('modules.client.all')</option>
          <option value="1">@lang('app.yes')</option>
          <option value="0">@lang('app.no')</option>
      </select>
  </x-filter-form-group>

  <x-filter-btn-group class="p-t-10">
      <x-button id="filter-results" classes="btn btn-cs-green col-md-6" title="app.apply"></x-button>
      <x-button id="reset-filters" classes="btn btn-inverse col-md-offset-1 col-md-5 rounded-pill" title="app.reset"></x-button>
  </x-filter-btn-group>
{!! Form::close() !!}