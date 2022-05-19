@php $subTaskCount = (isset($subtask->files)) ? $subtask->files->count() : 0; @endphp
@foreach($subtask->files as  $key => $file)
    <li class="list-group-item sub-task-file nonTopBorder @if($subTaskCount != ($key+1)) nonBottomBorder @endif" id="sub-task-file-{{  $file->id }}">
        <div class="row" style="display: contents">
            <div class="col-md-6">
                {{ $file->filename }}
            </div>
            <div class="col-md-3">
                <span class="">{{ $file->created_at->diffForHumans() }}</span>
            </div>
            <div class="col-md-3">
                <a target="_blank" href="{{ $file->file_url }}"
                    data-toggle="tooltip" data-original-title="View"
                    class="btn btn-info btn-circle"><i
                            class="fa fa-search"></i></a>
                @if(is_null($file->external_link))
                    <a href="{{ route('admin.sub-task-files.download', $file->id) }}"
                        data-toggle="tooltip" data-original-title="Download"
                        class="btn btn-inverse btn-circle"><i
                                class="fa fa-download"></i></a>
                @endif

                @if ($file->inDataRoom())
                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-file-id="{{ $file->id }}"
                data-pk="list" class="btn  btn-circle" style="background-color: #262626;"><i class="fa fa-times"></i></a>
                @else
                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-file-id="{{ $file->id }}"
                data-pk="list" class="btn btn-danger btn-circle sub-file-delete"><i class="fa fa-times"></i></a>
                @endif
                @if ($file->inDataRoom())
                <a href="javascript:;" data-toggle="tooltip" data-original-title="Data-Room" data-file-id="{{ $file->id }}"
                data-pk="list" class="btn btn-circle" style="background-color: #262626;"><i class="fa fa-database"></i></a>
                @else
                <a href="javascript:;" data-toggle="tooltip" data-original-title="Data-Room" data-task-id="{{ $subtask->id }}" data-type="sub_task" data-file-id="{{ $file->id }}"
                    data-pk="list" class="btn btn-warning btn-circle file-in-dataRoom"><i class="fa fa-database"></i></a>
                @endif
            </div>
        </div>
    </li>
@endforeach
