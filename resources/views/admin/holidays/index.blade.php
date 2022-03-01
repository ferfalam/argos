@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>

    <x-slot name="btns">
        <x-link type="link" url="javascript:;" onclick="showAdd()"  classes="btn btn-cs-blue " icon="fa fa-plus" title="modules.holiday.addNewHoliday"/>
        <x-link type="link" url="javascript:;" onclick="calendarData()"  classes="btn btn-cs-green " icon="fa fa-calendar" title="modules.holiday.viewOnCalendar"/>
        {{-- <x-link type="link" url="{{ route('admin.attendances.create') }}" classes="btn btn-cs-blue markHoliday" icon="fa fa-plus" title="modules.holiday.markSunday"/> --}}
    </x-slot>
</x-main-header>
@endsection

@push('head-script')
    <style>
        #holidaySectionData .panel{
            border-radius: 0px;
        }
    </style>
@endpush

@section('content')
    <div class="panel-container">

        <div class="panel panel-default">
            
            <div class="form-group pull-right">
                <label class="control-label">@lang('app.select') @lang('app.year')</label>
                <select onchange="showData()" class="select2 form-control" data-placeholder="@lang('app.menu.projects') @lang('app.status')" id="year">
                    @forelse($years as $yr)
                        <option @if($yr == $year) selected @endif value="{{ $yr }}">{{ $yr }}</option>
                    @empty
                    @endforelse
                </select>
            </div>

            
            <div class="" id="holidaySectionData" >

            </div>
        </div>
    </div>
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="edit-column-form" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}

@endsection

@push('footer-script')
    <script>
        @if($number_of_sundays>$holidays_in_db)
                $('.markHoliday').show();
        @endif

        showData();
       // Delete Holiday
        function del(id, date) {

            swal({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.confirmation.deleteHoliday')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('messages.deleteConfirmation')",
                cancelButtonText: "@lang('messages.confirmNoArchive')",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {

                    var url = "{{ route('admin.holidays.destroy',':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {'_token': token, '_method': 'DELETE'},
                    });
                }
            });
        }
        // Show Create Holiday Modal
        function showAdd() {
            var url = "{{ route('admin.holidays.create') }}";
            $.ajaxModal('#edit-column-form', url);
        }
        // Show Create Holiday Modal
        function showMarkHoliday() {
            var url = "{{ route('admin.holidays.mark-holiday') }}?year"+ $('#year').val();
            $.ajaxModal('#edit-column-form', url);
        }
        // Show Create Holiday Modal
        function calendarData() {
            var year = $('#year').val();
            var url = "{{ route('admin.holidays.calendar', ':year') }}";
            url = url.replace(':year', year);
            window.location.href = url;
        }

        // Show Holiday
        function showData() {
            var year = $('#year').val();
            var url = "{{ route('admin.holidays.view-holiday',':year') }}"
            url = url.replace(':year', year);
            $.easyAjax({
                type: 'GET',
                url: url,
                container: '#holidaySectionData',
                success: function (response) {
                  $('#holidaySectionData').html(response.view);
                    if(response.number_of_sundays > response.holidays_in_db){
                        $('.markHoliday').show();
                    }
                    else{
                        $('.markHoliday').hide();
                    }
                }
            });
        }

    </script>
@endpush