<div class="d-flex finish-divider-wrap animated fadeIn delay-25ms ">
    @for($i=0; $i<9;$i++)
        @if(isset($assignments[$i]))
            @if($assignments[$i]->rated == 2)
                @switch($assignments[$i]->component->id)
                    @case($component[0]->id)
                    <div class="finish-divider bg-partnerts"></div>
                    @break
                    @case($component[1]->id)
                    <div class="finish-divider bg-kern"></div>
                    @break
                    @case($component[2]->id)
                    <div class="finish-divider bg-people"></div>
                    @break
                    @case($component[3]->id)
                    <div class="finish-divider bg-value"></div>
                    @break
                    @case($component[4]->id)
                    <div class="finish-divider bg-relation"></div>
                    @break
                    @case($component[5]->id)
                    <div class="finish-divider bg-networ"></div>
                    @break
                    @case($component[6]->id)
                    <div class="finish-divider bg-client"></div>
                    @break
                    @case($component[7]->id)
                    <div class="finish-divider bg-money"></div>
                    @break
                    @case($component[8]->id)
                    <div class="finish-divider bg-income"></div>
                    @break
                @endswitch
            @endif
        @else
            <div class="finish-divider bg-grey"></div>
        @endif

    @endfor
</div>
