<button type="button" id="{{$id}}" class="{{$classes}}">
    @if (isset($icon) && !empty($icon))
        <i class="{{$icon}}"></i>        
    @endif

    @if (isset($ionIcon) && !empty($ionIcon))
        <ion-icon name="{{$ionIcon}}"></ion-icon>
    @endif

    {{__($title)}}
</button>