<div class="table-responsive">
    @if(isset($dataTable) && !empty($dataTable))
        {!! $dataTable->table(['class' => 'table  dataTable table-bordered table-hover toggle-circle default footable-loaded footable']) !!}
    @else
        {{$slot}}
    @endif
</div>
