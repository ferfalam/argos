@forelse($userLists as $userList)
    @php
    if(is_null($userList->image))
        $img_url = asset('img/default-profile-3.png');
    else
        $img_url = asset_url('avatar/' . $userList->image);
    @endphp
    <li id="dp_{{$userList->id}}" >
        
        <a href="javascript:void(0)" id="dpa_{{$userList->id}}" data-img-url="{{$img_url}}" data-user-name="{{$userList->name}}" class="user-list-item @if(isset($userID) && $userID == $userList->id) active @endif" onclick="getChatData('{{$userList->id}}', '{{$userList->name}}')">
           <img src="{{ $img_url }}" alt="user-img">

            <span @if($userList->message_seen == 'no' && $userList->user_one != $user->id) class="font-bold" @endif>{{$userList->name}}
                <small class="text-simple">@if($userList->last_message){{  \Carbon\Carbon::parse($userList->last_message)->diffForHumans()}} @endif
                    @if(\App\User::isAdmin($userList->id))
                        <label style="font-size: 12px !important; margin-bottom:0px;">Admin</label>
                    @elseif(\App\User::isClient($userList->id))
                        <label style="font-size: 12px !important; margin-bottom:0px;">Client</label>
                    @else
                        <label style="font-size: 12px !important; margin-bottom:0px;">Employee</label>
                    @endif
                </small>
            </span>
        </a>
    </li>

@empty
    <li>
        <a href="javascript:void(0)">
            <span>
                @lang('messages.noConversation')
            </span>
        </a>
    </li>
@endforelse
