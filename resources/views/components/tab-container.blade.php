<div class="tabs-container" {{$attributes}}>
    <div class="tab active" id="tab">
        <div class="tab-body">
            <div class="panel panel-default" style="border-radius: 4px">
                <div class="main-header">
                    <h4 class="tab-heading">{{__($attributes['title'])}}</h4>
                    @isset($btns)
                        <div class="main-header-btns">
                            {{$btns}}
                        </div>
                    @endisset
                </div>
                {{$slot}}
            </div>
        </div>
    </div>
</div>