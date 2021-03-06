<div class="panel panel-default" style="max-width: 40vw; min-width : 210px; padding-right: 0px; padding-left: 10px">
    <div class="panel-body">
        <img src="{{asset("img/$img")}}" alt="" />
        <div class="panel-body-info" style="font-weight: bold">
            <h2 style="display: flex; align-item:center; justify-content:center; gap:20px;">
                {{$slot}}
                {{ $count }}
            </h2>
            <a href="{{$url}}">
                <p>
                    @if (is_array($title))
                        @foreach ($title as $t)
                            {{__($t)}}
                        @endforeach
                    @else    
                        {{ __($title) }}
                    @endif
                </p>
            </a>
        </div>
    </div>
</div>