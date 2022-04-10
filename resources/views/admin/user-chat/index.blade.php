@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>

    <x-slot name="btns">
        {{-- <a href="javascript:;" id="new-chat" class="small-success-btn btn-sm"><i class="icon-note"></i> @lang("modules.messages.startConversation")</a> --}}
    </x-slot>
</x-main-header>

@endsection

@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.css') }}">
<style>
    #errorMessage
    {
        margin-left:10px;
    }
    .color_black{
        color: black!important;
    }
    .odd{
        background: linear-gradient(to right, #00c5fb 0%, #0253cc 100%);
        color: white !important;
    }
    .main_page_responsive{
        padding-top: 1% !important;
        padding-left: 0% !important;
    }
    .other-section {
    /* background: red; */
    background: #00232D!important;
    border-right: 1px solid #f2f2f3;
}

.setsearch{
    height: 0!important;
    background: white;
    
}
.set_pad_10{
    padding-left: 12px!important;
}
.data-section{
padding: 0!important;
}

.main.main-tertiary ~ .main{
    display: none;
}
</style>
@endpush


@section('chat-content')
    <!-- Page Content Holder -->
    <main class="main main-tertiary ">
        <!-- Chat Sidebar Start -->
        <div class="chat-sidebar-container">
          <div class="chat-sidebar-overlay"></div>
          <nav class="chat-sidebar">
            <div class="chat-search">
              {{-- <input type="text" class="form-control" placeholder="Search"> --}}
              <input id="userSearch" type="text" class=" form-control" placeholder="@lang("modules.messages.searchContact")" />
            </div>

            <ul class="chat-sidebar-list chatonline style-none userList">
                @forelse($userList as $users)
                    @php
                        if(is_null($users->image))
                            $img_url = asset('img/default-profile-3.png');
                        else
                            $img_url = asset_url('avatar/' . $users->image);
                    @endphp

                    <li id="dp_{{$users->id}}">
                        <a href="javascript:void(0)" data-img-url="{{$img_url}}" data-user-name="{{$users->name}}" id="dpa_{{$users->id}}"
                        onclick="getChatData('{{$users->id}}', '{{$users->name}}')" class="user-list-item">
                            <img src="{{ $img_url }}" alt="user-img" >

                            <span @if($users->message_seen == 'no' && $users->user_one != $user->id) class="font-bold" @endif> {{$users->name}}
                                <small  class="text-simple"> @if($users->last_message) <span style="font-size: 10px">  {{  \Carbon\Carbon::parse($users->last_message)->diffForHumans()}} </span> @endif
                                    @if(\App\User::isAdmin($users->id))
                                        <label style="font-size: 12px !important; margin-bottom:0px;">Admin</label>
                                    @elseif(\App\User::isClient($users->id))
                                        <label style="font-size: 12px !important; margin-bottom:0px;">Client</label>
                                    @else
                                        <label style="font-size: 12px !important; margin-bottom:0px;" class="text-sm">Employee</label>
                                    @endif
                                </small>
                            </span>
                        </a>
                    </li>
                @empty
                    <li>
                        <span class="text-white"> 
                            @lang("messages.noUser")
                        </span>
                    </li>
                @endforelse
            </ul>

          </nav>
        </div>
        <!-- Chat Sidebar End -->


        <!-- Main Header Start -->
        <div class="main">
          <div class="main-header">
              <h1 class="heading-1">
                <ion-icon name="menu-outline" class="chat-sidebar-toggler"></ion-icon>
                @lang('app.chat')
              </h1>

              <div class="main-header-btns">
                <a href="javascript:;" id="new-chat" class="small-success-btn btn-sm"><i class="icon-note"></i> @lang("modules.messages.startConversation")</a>

              </div>
          </div>

          <!-- Main Content Start -->
          <div class="main-content">
            <div class="chat">

              <div class="chat-header">
                <div class="chat-user-info">
                  <div class="chat-user-img">
                    <img src="{{ asset('img/default-profile-3.png')}}" alt="">
                  </div>
                  <p class="chat-user-name">Username</p>
                </div>
              </div>

              <div class="chat-messages">
                <div class="chat-list slimscroll p-t-30 chats" style="height: 100%"></div>
              </div>

              {!! Form::open(['id'=>'storechat','class'=>'ajax-form','method'=>'POST']) !!}

                <div class="chat-input">
                    <div class="input-group">
                        <input type="text" style="height: 54px" name="message" id="submitTexts"  autocomplete="off" placeholder="@lang("modules.messages.typeMessage")" class="form-control">
                        <input id="dpID" value="{{$dpData}}" type="hidden"/>
                        <input id="dpName" value="{{$dpName}}" type="hidden"/>
                        <span id="attachBtn" class="input-group-addon" style="margin-right: 10px" type="button"><i class="fa fa-paperclip"></i></span>
                        <span id="submitBtn" class="input-group-addon input-group-addon-1" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                        {{-- <div class="custom-send" style=" text-align: right">
                        </div> --}}
                    </div>
                </div>
                <div id="errorMessage"></div>

                <div class="attachmentBox"  style="margin-bottom: 30px; margin-top: 20px; display: none; ">
                    @if($upload)
                        <button type="button"
                                class="btn btn-block btn-outline-info btn-sm col-md-2 select-image-button"
                                style="margin-bottom: 10px;display: none "><i class="fa fa-upload"></i>
                            File Select Or Upload
                        </button>
                        <div id="file-upload-box">
                            <div class="" id="file-dropzone">
                                <div class="col-md-12" >
                                    <div class="dropzone"
                                            id="file-upload-dropzone">
                                        {{ csrf_field() }}
                                        <div class="fallback">
                                            <input name="file" type="file" multiple/>
                                        </div>
                                        <input name="image_url" id="image_url" type="hidden"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="chatID" id="chatID">
                    @else
                        <div class="alert alert-danger">@lang('messages.storageLimitExceed', ['here' => '<a href='.route('admin.billing.packages'). '>Here</a>'])</div>
                    @endif
                </div>
                {!! Form::close() !!}
            </div>
          </div>
          <!-- Main Content End -->
        </div>
        <!-- Main Header End -->
    </main>

    
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="newChatModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


@section('contenst')
 <div style="background: white!important">
    <div class="row">
        <div class="col-xs-12">

            <div class="chat-main-box">

                <!-- .chat-left-panel -->
                <div class="chat-left-aside">
                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                    <div class="chat-left-inner">

                        <div class="form-material" style="margin-left: 10px">
                            <input id="userSearch" type="text"
                                            class="setsearch" style="padding: 17px 42px!important;"        placeholder="@lang("modules.messages.searchContact")"></div>
                        <ul class="chatonline style-none userList set_pad_10" >
                            @forelse($userList as $users)
                                <li id="dp_{{$users->id}}" class="bg-white">
                                    <a href="javascript:void(0)" id="dpa_{{$users->id}}"
                                    onclick="getChatData('{{$users->id}}', '{{$users->name}}')">
                                        @if(is_null($users->image))
                                            <img src="{{ asset('img/default-profile-3.png') }}" alt="user-img"
                                                class="img-circle" style="height:30px; width:30px;">
                                        @else
                                            <img src="{{ asset_url('avatar/' . $users->image) }}" alt="user-img"
                                                class="img-circle" style="height:30px; width:30px;">
                                        @endif
                                        <span @if($users->message_seen == 'no' && $users->user_one != $user->id) class="font-bold" @endif> {{$users->name}}
                                            <small class="text-simple"> @if($users->last_message){{  \Carbon\Carbon::parse($users->last_message)->diffForHumans()}} @endif
                                                @if(\App\User::isAdmin($users->id))
                                                    <label class="btn btn-danger btn-xs btn-outline">Admin</label>
                                                @elseif(\App\User::isClient($users->id))
                                                    <label class="btn btn-success btn-xs btn-outline">Client</label>
                                                @else
                                                    <label class="btn btn-warning btn-xs btn-outline">Employee</label>
                                                @endif
                                            </small>
                                        </span>
                                    </a>
                                </li>


                            @empty
                                <li>
                                    @lang("messages.noUser")
                                </li>
                            @endforelse


                            <li class="p-20"></li>
                        </ul>
                    </div>
                </div>

                <!-- .chat-right-panel -->
                <div class="chat-right-aside">
                    <div class="chat-main-header">
                        <div class="p-20 b-b row">
                            {{-- <h3 class="box-title col-md-9">@lang("app.menu.messages")</h3> --}}
                        </div>
                    </div>
                    <div class="chat-box ">

                        <ul class="chat-list slimscroll p-t-30 chats"></ul>

                        <div class="row send-chat-box" style="margin: 16px 15px!important;">
                            {!! Form::open(['id'=>'storechat','class'=>'ajax-form','method'=>'POST']) !!}

                            <div class="col-md-12">
                                <input type="text" style="height: 54px" name="message" id="submitTexts"  autocomplete="off" placeholder="@lang("modules.messages.typeMessage")"
                                       class="form-control col-md-10">
                                <input id="dpID" value="{{$dpData}}" type="hidden"/>
                                <input id="dpName" value="{{$dpName}}" type="hidden"/>

                                <div class="custom-send" style=" text-align: right">
                                    <button id="attachBtn" class="btn btn-info btn-rounded" style="margin-right: 10px" type="button"><i class="fa fa-paperclip"></i></button>
                                    <button id="submitBtn" class="btn btn-info btn-rounded" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="errorMessage"></div>
                            <div class="col-md-12 attachmentBox"  style="margin-bottom: 30px;display: none; ">
                                @if($upload)
                                    <button type="button"
                                            class="btn btn-block btn-outline-info btn-sm col-md-2 select-image-button"
                                            style="margin-bottom: 10px;display: none "><i class="fa fa-upload"></i>
                                        File Select Or Upload
                                    </button>
                                    <div id="file-upload-box">
                                        <div class="col-md-10" id="file-dropzone">
                                            <div class="col-md-12" >
                                                <div class="dropzone"
                                                     id="file-upload-dropzone">
                                                    {{ csrf_field() }}
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple/>
                                                    </div>
                                                    <input name="image_url" id="image_url" type="hidden"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="chatID" id="chatID">
                                @else
                                    <div class="alert alert-danger">@lang('messages.storageLimitExceed', ['here' => '<a href='.route('admin.billing.packages'). '>Here</a>'])</div>
                                @endif
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- .chat-right-panel -->
            </div>
        </div>


    </div>

    <!-- .row -->

</div>
@endsection

@push('footer-script')
<script src="{{ asset('js/cbpFWTabs.js') }}"></script>
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.js') }}"></script>

<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

    @if($upload)
        Dropzone.autoDiscover = false;
    //Dropzone class
    myDropzone = new Dropzone("div#file-upload-dropzone", {
        url: "{{ route('admin.user-chat-files.store') }}",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        paramName: "file",
        maxFilesize: 10,
        maxFiles: 10,
        acceptedFiles: "image/*,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/docx,application/pdf,text/plain,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        autoProcessQueue: false,
        uploadMultiple: true,
        addRemoveLinks: true,
        parallelUploads: 10,
        dictDefaultMessage: "@lang('modules.projects.dropFile')",
        init: function () {
            myDropzone = this;
            this.on("success", function (file, response) {
                if(response.status == 'fail') {
                    $.showToastr(response.message, 'error');
                    return;
                }
            })
        }
    });

    myDropzone.on('sending', function (file, xhr, formData) {
        var ids = $('#chatID').val();
        formData.append('chat_id', ids);
    });

    myDropzone.on('completemultiple', function () {
        myDropzone.removeAllFiles();
        var msgs = "@lang('messages.fetchChat')";
        $.showToastr(msgs, 'success');
        var dpID = $('#dpID').val();
        var dpName = $('#dpName').val();
        scroll = true;
        //set chat data
        getChatData(dpID, dpName);
        $(".attachmentBox").hide();
    });
    @endif
var chatID;
    $('.chat-left-inner > .chatonline').slimScroll({
        height: '100%',
        position: 'right',
        size: "0px",
        color: '#dcdcdc',

    });
    $(function () {
        $(window).load(function () { // On load
            $('.chat-list').css({'height': (($(window).height()) - 170) + 'px'});
        });
        $(window).resize(function () { // On resize
            $('.chat-list').css({'height': (($(window).height()) - 170) + 'px'});
        });
    });

    // this is for the left-aside-fix in content area with scroll

    $(function () {
        $(window).load(function () { // On load
            $('.chat-left-inner').css({
                'height': (($(window).height()) - 240) + 'px'
            });
        });
        $(window).resize(function () { // On resize
            $('.chat-left-inner').css({
                'height': (($(window).height()) - 240) + 'px'
            });
        });
    });


    $(".open-panel").click(function () {
        $(".chat-left-aside").toggleClass("open-pnl");
        $(".open-panel i").toggleClass("ti-angle-left");
    });
    $("#attachBtn").click(function () {
        $(".attachmentBox").toggle();
        myDropzone.removeAllFiles();
    });


    $(function () {
        $('#userList').slimScroll({
            height: '350px'
        });
    });

    var dpButtonID = "";
    var dpName = "";
    var scroll = true;

    var dpClassID = '{{$dpData}}';

    if (dpClassID) {
        $('#dp_' + dpClassID).addClass('active');
    }

    getChatData(dpButtonID, dpName);

    //getting data
    window.setInterval(function(){
        getChatData(dpButtonID, dpName);
        /// call your function here
    }, 30000);

    $('#submitTexts').keypress(function (e) {

        var key = e.which;
        if (key == 13)  // the enter key code
        {
            e.preventDefault();
            $('#submitBtn').click();
            return false;
        }
    });


    //submitting message
    $('#submitBtn').on('click', function (e) {
        e.preventDefault();
        //getting values by input fields
        var submitText = $('#submitTexts').val();
        var dpID = $('#dpID').val();
        var attachedFile = myDropzone.getQueuedFiles().length;
        //checking fields blank
        if ((submitText == "" || submitText == undefined || submitText == null) && (attachedFile == 0)) {
            $('#errorMessage').html('<span class="text-danger"><p>@lang('messages.fieldBlank')</p></span>');
            return;
        } else if (dpID == '') {
            $('#errorMessage').html('<span class="text-danger"><p>@lang('messages.noUser')</p></span>');
            return;
        } else {

            var url = "{{ route('admin.user-chat.message-submit') }}";
            var token = "{{ csrf_token() }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                messagePosition: '',
                data: {'message': submitText, 'user_id': dpID, 'added_files': attachedFile, '_token': token},
                container: ".chat-form",
                blockUI: true,
                redirect: false,
                success: function (response) {
                    var dpID = $('#dpID').val();
                    var dpName = $('#dpName').val();
                    var dropzone = 0;
                    @if($upload)
                        dropzone = myDropzone.getQueuedFiles().length;
                    @endif

                    if(dropzone > 0){
                        chatID = response.chat_id;
                        $('#chatID').val(response.chat_id);
                        myDropzone.processQueue();
                    } else {
                        var msgs = "@lang('messages.fetchChat')";
                        $.showToastr(msgs, 'success');
                        scroll = true;
                        //set chat data
                        getChatData(dpID, dpName);
                        {{--window.location.href = '{{ route('admin.all-tasks.index') }}'--}}
                    }
                    var blank = "";
                    $('#submitTexts').val('');
                    //set user list
                    $('.userList').html(response.userList);

                    //set active user
                    if (dpID) {
                        $('#dp_' + dpID + 'a').addClass('active');
                    }
                }
            });
        }

        return false;
    });

    //getting all chat data according to user
    //submitting message
    $("#userSearch").keyup(function (e) {
        var url = "{{ route('admin.user-chat.user-search') }}";

        $.easyAjax({
            type: 'GET',
            url: url,
            messagePosition: '',
            data: {'term': this.value},
            container: ".userList",
            success: function (response) {
                //set messages in box
                $('.userList').html(response.userList);
                addListener();

            }
        });

        
    });

    //getting all chat data according to user
    function getChatData(id, dpName, scroll) {
        var getID = '';
        $('#errorMessage').html('');
        if (id != "" && id != undefined && id != null) {
            $('.userList li a.active ').removeClass('active');
            $('#dpa_' + id).addClass('active');
            $('#dpID').val(id);
            getID = id;
            $('#badge_' + id).val('');
        } else {
            $('.userList li:first-child a').addClass('active');
            getID = $('#dpID').val();
            
        }

        var url = "{{ route('admin.user-chat.index') }}";

        $.easyAjax({
            type: 'GET',
            url: url,
            messagePosition: '',
            data: {'userID': getID},
            container: ".chats",
            success: function (response) {
                //set messages in box
                $('.chats').html(response.chatData);
                scrollChat();
            }
        });
    }

    function scrollChat() {
        if(scroll == true) {
            $('.chat-list').stop().animate({
                scrollTop: $(".chat-list")[0].scrollHeight
            }, 800);
        }
        scroll = false;
    }

    $('#new-chat').click(function () {
        var url = '{{ route('admin.user-chat.create')}}';
        $('#modelHeading').html('Start Conversation');
        $.ajaxModal("#newChatModal", url);
    })

    function addListener(){
        $('.user-list-item').click(function(){
            $('.chat-user-name').html($(this).attr('data-user-name'))
            $('.chat-user-img img').attr('src', $(this).attr('data-img-url'))
        });
    }

    addListener();

    $('ready', function(){
        const activeItem = $('.chat-sidebar-list li.active a');
        $('.chat-user-name').html(activeItem.attr('data-user-name'))
        $('.chat-user-img img').attr('src', activeItem.attr('data-img-url'))
    })

</script>

@if (request()->get('user') != "")
    <script>
        getChatData("{{ request()->get('user') }}", "{{ request()->get('user') }}");
    </script>
@endif
@endpush
