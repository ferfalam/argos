@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>

    <x-slot name="btns">
        <x-link type="link" url="{{ route('admin.designations.create') }}" classes="btn btn-cs-blue" icon="fa fa-plus" :title="['app.add', 'app.menu.designation']"/>
    </x-slot>
</x-main-header>
@endsection

@section('content')

<x-table>
    <table class="table dataTable table-bordered table-hover toggle-circle default footable-loaded footable" id="users-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('app.menu.designation')</th>
                <th>@lang('app.employees')</th>
                <th>@lang('app.action')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($groups as $group)
                <tr id="group{{ $group->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <?php
                        $size = 0;
                        foreach ($group->members as  $item) {
                            if ($item->user->company_id == company()->id){
                                $size++;
                            }
                        }
                    ?>
                    <td>{{ $group->name }} <label class="label label-success">{{ $size }} @lang('modules.projects.members')</label></td>
                    <td>
                        @forelse($group->members as $item)
                            @if ($item->user->company_id == company()->id)
                                <img data-toggle="tooltip" data-original-title="{{ ucwords($item->user->name) }}" src="{{ $item->user->image_url }}"
                                alt="user" class="img-circle" width="25" height="25"> 
                            @endif
                        @empty
                            @lang('messages.noRecordFound')
                        @endforelse
                    </td>
                    <td>

                        <div class="btn-group dropdown m-r-10">
                            <span aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" type="button"><ion-icon name="ellipsis-vertical"></ion-icon></span>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="{{ route('admin.designations.edit', [$group->id]) }}"><i class="icon-settings"></i> @lang('app.modify')</a></li>
                                <li><a href="javascript:;"  data-group-id="{{ $group->id }}" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> @lang('app.delete') </a></li>

                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="background: #ddd;">
                        <div class="empty-space" style="height: 200px;">
                            <div class="empty-space-inner">
                                <div class="icon" style="font-size:30px"><i
                                            class="icon-layers"></i>
                                </div>
                                <div class="title m-b-15">@lang('messages.noDesignation')
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
</x-table>
    <!-- .row -->

@endsection

@push('footer-script')
    <script>
        $(function() {


            $('body').on('click', '.sa-params', function(){
                var id = $(this).data('group-id');
                swal({
                    title: "@lang('messages.sweetAlertTitle')",
                    text: "@lang('messages.confirmation.deleteDesignation')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "@lang('messages.deleteConfirmation')",
                    cancelButtonText: "@lang('messages.confirmNoArchive')",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm){
                    if (isConfirm) {

                        var url = "{{ route('admin.designations.destroy',':id') }}";
                        url = url.replace(':id', id);

                        var token = "{{ csrf_token() }}";

                        $.easyAjax({
                            type: 'DELETE',
                            url: url,
                            data: {'_token': token},
                            success: function (response) {
                                if (response.status == "success") {
                                    $.unblockUI();
                                    $('#group'+id).fadeOut();
                                }
                            }
                        });
                    }
                });
            });



        });

    </script>
@endpush
