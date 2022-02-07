@forelse($chatDetails as $chatDetail)
    <div class="chat-message {{$chatDetail->from == $user->id ? 'chat-message-sent' : 'chat-message-received'}}">
        <p class="text">
            {{ $chatDetail->message }}
        </p>

        @foreach($chatDetail->files as $file)
        <div class="">
            <div class="card">
                <div class="file-bg">
                    <div class="overlay-file-box">
                        <div class="user-content">
                            <a target="_blank" href="{{ $file->file_url }}">
                                @if($file->icon == 'images')
                                    <img class="card-img-top img-responsive" src="{{ $file->file_url }}"
                                         alt="Card image cap">
                                @else
                                    <i class="fa {{$file->icon}} card-img-top img-responsive"
                                       style="font-size: -webkit-xxx-large; padding-top: 65px;"></i>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <h6 class="card-title thumbnail-img"></h6>

                    <a target="_blank" href="{{ $file->file_url }}"
                       data-toggle="tooltip" data-original-title="View"
                       class="btn btn-info btn-circle"><i
                                class="fa fa-search"></i></a>

                    <a href="{{ route('admin.user-chat-files.download', $file->id) }}"
                       data-toggle="tooltip" data-original-title="Download"
                       class="btn btn-default btn-circle"><i
                                class="fa fa-download"></i></a>
                </div>
            </div>
        </div>
        @endforeach

        <p class="time">{{ $chatDetail->created_at->timezone($global->timezone)->format($global->date_format.' '. $global->time_format) }}</p>
    </div>
@empty
    <li>
        <div class="message">@lang('messages.noMessage')</div>
    </li>
@endforelse
