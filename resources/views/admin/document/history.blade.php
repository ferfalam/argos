<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

<style>
    .modal-body{
        max-height: 500px;
    }
    .history-row{
        margin: 10px 0px;
        display: flex;
        border-bottom: 1px solid #c2c2c2;
        justify-content: space-around
    }

    .user-img{
        margin-right: 20px;
    }

    .history-details{
        font-weight: 600;
    }

    .history-date{
        opacity: 0.5;
    }
</style>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.tasks.history')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        @forelse ($doc_histories as $history)
            <div class="history-row">
                <div class="user-img">
                    <img data-toggle="tooltip" data-placement="top" data-original-title="{{$history->user()->name}}" src="{{$history->user()->image_url}}" style="width:50px; height:50px; border-radius: 50%;">'
                </div>
                <div class="details">
                    <p class="histrory-details">{{$history->user()->name}} {{__('modules.dataRoom.'.$history->details)}}</p>
                    <p class="history-date">{{\Carbon\Carbon::parse($history->created_at)->format($global->date_format.' H:i:s')}}</p>
                </div>
                <div class="icon" style="font-size: 30px">
                    @if ($history->details == 'seeDoc')
                    <i class="fa fa-search text-info"></i>
                        
                    @elseif ($history->details == 'updateDoc')
                    <i class="fa fa-edit text-warning"></i>

                    @elseif ($history->details == 'downloadDoc')
                    <i class="fa fa-download text_inverse"></i>
                        
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-history">
                <p>Pas d'historique pour ce fichier</p>
            </div>
        @endforelse
    </div>
</div>


<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>

