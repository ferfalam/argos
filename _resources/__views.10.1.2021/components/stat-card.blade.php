<div class="panel panel-default" style="max-width: 40vw">
    <div class="panel-body">
        <img src="{{asset("img/$img")}}" alt="" />
        <div class="panel-body-info">
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