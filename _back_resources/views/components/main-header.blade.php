<div class="main-header">
    @isset($slot)
        {{$slot}}
    @endisset

    @isset($title)
    <h4 class="page-title">
        {{$title}}
    </h4>
    @endisset

    @isset($btns)
    <div class="main-header-btns">
        {{ $btns }}
    </div>
    @endisset

</div>