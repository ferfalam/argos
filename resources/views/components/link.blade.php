@if ($type == 'modal')
    <a href="#" data-toggle="modal" data-target="{{$modalId}}" class="{{$classes}}" {{ $attributes }}>
        @if (isset($icon) && !empty($icon))
            <i class="{{$icon}}"></i>        
        @endif

        {{__($title)}}
    </a>
@endif

@if ($type == 'link')
    <a href="{{$url}}" class="{{$classes}}" {{ $attributes }}>
        @if (isset($icon) && !empty($icon))
            <i class="{{$icon}}"></i>        
        @endif
        
        @if (isset($ionIcon) && !empty($ionIcon))
            <ion-icon name="{{$ionIcon}}"></ion-icon>
        @endif
        
        @if (is_array($title))
            @foreach ($title as $word)
                {{__($word)}}
            @endforeach
        @else    
            {{__($title)}}
        @endif

    </a>
@endif
