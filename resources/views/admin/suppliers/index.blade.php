@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle)
    </x-slot>

    {{-- <x-slot name="btns">
        <x-link type="link" url="{{ route('admin.clients.create') }}" id="createTaskCategory" classes="btn btn-cs-blue"
            icon="fa fa-plus" title="modules.client.addNewClient" />
    </x-slot> --}}
</x-main-header>
@endsection

@push('head-script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterange-picker/daterangepicker.css') }}" />


<style>
    .filter-section::-webkit-scrollbar {
        display: block !important;
    }
</style>
@endpush

@section('filter-section')
<div class="row" id="ticket-filters">
    <form action="" id="filter-form">
        <x-filter-form-group label="app.selectDateRange">
            <div id="reportrange" class="form-control reportrange">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down pull-right"></i>
            </div>
            <input type="hidden" class="form-control" id="start-date" placeholder="@lang('app.startDate')" value="" />
            <input type="hidden" class="form-control" id="end-date" placeholder="@lang('app.endDate')" value="" />
        </x-filter-form-group>

        <x-filter-form-group label="app.client">
            <select class="form-control select2" name="client" id="client" data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
                {{-- @forelse($clients as $client)
                <option value="{{$client->id}}">{{ $client->name }}</option>
                @empty
                @endforelse --}}
            </select>
        </x-filter-form-group>

        <x-filter-form-group label="app.category">
            <select class="form-control select2" name="category_id" id="category_id" data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
                {{-- @foreach($categories as $category)
                <option value="{{$category->id}}">{{ ucwords($category->category_name) }}</option>
                @endforeach --}}
            </select>
        </x-filter-form-group>

        <x-filter-form-group label="modules.logTimeSetting.project">
            <select class="form-control select2" name="project_id" id="project_id" data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
                {{-- @foreach($projects as $project)
                <option value="{{$project->id}}">{{ $project->project_name }}</option>
                @endforeach --}}
            </select>
        </x-filter-form-group>

        <x-filter-form-group label="modules.contracts.contractType">
            <select class="form-control select2" name="contract_type_id" id="contract_type_id"
                data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
                {{-- @foreach($contracts as $contract)
                <option value="{{$contract->id}}">{{ $contract->name }}</option>
                @endforeach --}}
            </select>
        </x-filter-form-group>

        <x-filter-form-group label="modules.stripeCustomerAddress.country">
            <select class="form-control select2" name="country_id" id="country_id" data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{ $country->nicename }}</option>
                @endforeach
            </select>
        </x-filter-form-group>

        <x-filter-btn-group class="p-t-10">
            <x-button id="apply-filters" classes="btn btn-cs-green col-md-6" title="app.apply"></x-button>
            <x-button id="reset-filters" classes="btn btn-inverse col-md-offset-1 col-md-5 rounded-pill"
                title="app.reset"></x-button>
        </x-filter-btn-group>

        <x-filter-form-group hidden label="modules.productCategory.subCategory">
            <select class="form-control select2" name="sub_category_id" id="sub_category_id" data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
                {{-- @foreach($subcategories as $subcategory)
                <option value="{{$subcategory->id}}">{{ $subcategory->category_name }}</option>
                @endforeach --}}
            </select>
        </x-filter-form-group>
    </form>
</div>
@endsection

@section('content')
<div class="panel-4">
    <div class="panel-heading">
        <h2>@lang('liste des fournisseurs')</h2>
        <a href="{{route('admin.suppliers.create')}}" class="btn btn-cs-blue">ajouter un fournisseur</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table  dataTable table-bordered table-hover toggle-circle default footable-loaded footable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Raison sociale</th>
                        <th>Contact principal</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Date création</th>
                        <th>Téléphone </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>123</td>
                        <td>E33 Lisbonne</td>
                        <td>
                           
                            E33 Dubai
                        </td>
                        <td>Lisbonne</td>
                        <td> <img src="{{asset('img/table-flag.png')}}" alt=""></td>
                        <td>15/12/2021</td>
                        <td>+33 6 87 65 88 77</td>
                        <td>
                            <div class="btn-group dropdown m-r-10">
                                <span aria-expanded="false" data-toggle="dropdown" class=" dropdown-toggle "
                                    type="button">
                                    <ion-icon name="ellipsis-vertical" role="img" class="md hydrated"
                                        aria-label="ellipsis vertical"></ion-icon>
                                </span>
                                <ul role="menu" class="dropdown-menu pull-right">
                                    <li>
                                        <a href="{{route('admin.suppliers.edit', 1)}}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i> Éditer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('footer-script')
<script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('js/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/daterange-picker/daterangepicker.js') }}"></script>
{{-- {!! $dataTable->scripts() !!} --}}

<script>
    $(function() {
            var dateformat = '{{ $global->moment_format }}';

            var start = '';
            var end = '';

            function cb(start, end) {
                if(start){
                    $('#start-date').val(start.format(dateformat));
                    $('#end-date').val(end.format(dateformat));
                    $('#reportrange span').html(start.format(dateformat) + ' - ' + end.format(dateformat));
                }
            }

            moment.locale('{{ $global->locale }}');

            $('#reportrange').daterangepicker({
                // startDate: start,
                // endDate: end,
                locale: {
                    language: '{{ $global->locale }}',
                    format: '{{ $global->moment_format }}',
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

        var subCategories = @json($subcategories);

        $('#category_id').change(function (e) {
            // get projects of selected users
            var opts = '';

            var subCategory = subCategories.filter(function (item) {
                return item.category_id == e.target.value
            });
            subCategory.forEach(project => {
                console.log(project);
            opts += `<option value='${project.id}'>${project.category_name}</option>`
        })

        $('#sub_category_id').html('<option value="0">Select Sub Category...</option>'+opts)

        $("#sub_category_id").select2({
                formatNoMatches: function () {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });
        });

        $(".select2").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        $(".table").dataTable();

        // var table;
        // $(function () {
        //     $('body').on('click', '.sa-params', function () {
        //         var id = $(this).data('user-id');
        //         swal({
        //             title: "@lang('messages.sweetAlertTitle')",
        //             text: "@lang('messages.confirmation.recoverDeleteUser')",
        //             type: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#DD6B55",
        //             confirmButtonText: "@lang('messages.deleteConfirmation')",
        //             cancelButtonText: "@lang('messages.confirmNoArchive')",
        //             closeOnConfirm: true,
        //             closeOnCancel: true
        //         }, function(isConfirm){
        //             if (isConfirm) {

        //                 var url = "{{ route('admin.clients.destroy',':id') }}";
        //                 url = url.replace(':id', id);

        //                 var token = "{{ csrf_token() }}";

        //                 $.easyAjax({
        //                     type: 'POST',
        //                     url: url,
        //                     data: {'_token': token, '_method': 'DELETE'},
        //                     success: function (response) {
        //                         if (response.status == "success") {
        //                             $.easyBlockUI('#clients-table');
        //                             window.LaravelDataTables["clients-table"].draw();
        //                             $.easyUnblockUI('#clients-table');
        //                         }
        //                     }
        //                 });
        //             }
        //         });
        //     });

        // });

        $('.toggle-filter').click(function () {
            $('#ticket-filters').toggle('slide');
        })

        $('#apply-filters').click(function () {
            $('#clients-table').on('preXhr.dt', function (e, settings, data) {
                var startDate = $('#start-date').val();

                if (startDate == '') {
                    startDate = null;
                }

                var endDate = $('#end-date').val();

                if (endDate == '') {
                    endDate = null;
                }
                var category_id = $('#category_id').val();
                var sub_category_id = $('#sub_category_id').val();
                var project_id = $('#project_id').val();
                var contract_type_id = $('#contract_type_id').val();
                var country_id = $('#country_id').val();

                var client = $('#client').val();
                data['startDate'] = startDate;
                data['endDate'] = endDate;
                data['client'] = client;
                data['category_id'] = category_id;
                data['sub_category_id'] = sub_category_id;
                data['project_id'] = project_id;
                data['contract_type_id'] = contract_type_id;
                data['country_id'] = country_id;

            });
            $.easyBlockUI('#clients-table');
            window.LaravelDataTables["clients-table"].draw();
            $.easyUnblockUI('#clients-table');
        });

        $('#reset-filters').click(function () {
            $('#filter-form')[0].reset();
            $('.select2').val('all');
            $('#filter-form').find('select').select2();

            $.easyBlockUI('#clients-table');
            $('#start-date').val('');
            $('#end-date').val('');
            $('#reportrange span').html('');

            window.LaravelDataTables["clients-table"].draw();
            $.easyUnblockUI('#clients-table');
        })

        // function exportData(){

        //     var client = $('#client').val();
        //     var status = $('#status').val();

        //     var url = '{{ route('admin.clients.export', [':status', ':client']) }}';
        //     url = url.replace(':client', client);
        //     url = url.replace(':status', status);

        //     window.location.href = url;
        // }
            
</script>
@endpush