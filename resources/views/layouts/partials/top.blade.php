<div class="d-flex h-100 flex-row">
    @if(isset($list[0]))
        <div class="full-flex  pr-lg-2 pr-md-2 pr-1 pb-lg-2 pb-md-2 pb-auto">
            <a href="{{ route('profile', $list[0]['user']->id) }}" class="full-flex flex-column top-content flex-center shadow-hover" style="background: goldenrod;">
                <span class=" top-place">1 <small><sup> ste </sup></small> plaats</span>
                <div class="progress-bar1" data-percent="{{$list[0]['total']}}" data-duration="1000"
                     data-color="#e3e3e3,#44E15F"></div>
                <span class="top-name">{{$list[0]['user']->name}} {{$list[0]['user']->lastname}}</span>
            </a>
        </div>
    @else
        <a href="{{route('components')}}" class="full-flex  pr-lg-2 pr-md-2 pr-1 pb-lg-2 pb-md-2 pb-auto">
            <div class="full-flex flex-column claim flex-center shadow-hover">
                <span class="claim-icon"><i class="fas fa-plus"></i></span>
                <span class="claim-text">Claim deze plaats</span>
            </div>
        </a>
    @endif
    @if(isset($list[1]))
        <div class="full-flex  pl-lg-2 pl-md-2 pl-1 pb-lg-2 pb-md-2 pb-auto">
            <a href="{{ route('profile', $list[1]['user']->id) }}" class="full-flex flex-column top-content flex-center shadow-hover" style="background: #8c8c8c;">
                <span class="top-place">2 <small><sup> de </sup></small> plaats</span>
                <div class="progress-bar1" data-percent="{{$list[1]['total']}}" data-duration="1000"
                     data-color="#e3e3e3,#44E15F"></div>
                <p class="top-name"><span>{{$list[1]['user']->name}} </span> <span>{{$list[1]['user']->lastname}}</span> </p>
            </a>
        </div>
    @else
        <a href="{{route('components')}}" class="full-flex  pl-lg-2 pl-md-2 pl-1 pb-lg-2 pb-md-2 pb-auto">
            <div class="full-flex flex-column claim flex-center shadow-hover">
                <span class="claim-icon"><i class="fas fa-plus"></i></span>
                <span class="claim-text">Claim deze plaats</span>
            </div>
        </a>
    @endif
</div>
<div class="d-flex h-100 flex-row">
    @if(isset($list[2]))
        <div class="full-flex  pr-lg-2 pr-md-2 pr-1 pt-2">
            <a href="{{ route('profile', $list[2]['user']->id) }}" class="full-flex flex-column top-content flex-center shadow-hover" style="background: #cd7f32;">
                <span class="top-place">3 <small><sup> de </sup></small> plaats</span>
                <div class="progress-bar1" data-percent="{{$list[2]['total']}}" data-duration="1000"
                     data-color="#e3e3e3,#44E15F"></div>
                <span class="top-name">{{$list[2]['user']->name}} {{$list[2]['user']->lastname}}</span>
            </a>
        </div>
    @else
        <a href="{{route('components')}}" class="full-flex  pr-lg-2 pr-md-2 pr-1 pt-2">
            <div class="full-flex flex-column claim flex-center shadow-hover">
                <span class="claim-icon"><i class="fas fa-plus"></i></span>
                <span class="claim-text">Claim deze plaats</span>
            </div>
        </a>
    @endif
    @if(isset($list[3]))
        <div class="full-flex pl-lg-2 pl-md-2 pl-1 pt-2">
            <a href="{{ route('profile', $list[3]['user']->id) }}" class="full-flex flex-column top-content flex-center shadow-hover" >
                <span class=" top-place">4 <small><sup> de </sup></small> plaats</span>
                <div class="progress-bar1" data-percent="{{$list[3]['total']}}" data-duration="1000"
                     data-color="#e3e3e3,#44E15F"></div>
                <span class="top-name">{{$list[3]['user']->name}} {{$list[3]['user']->lastname}}</span>
            </a>
        </div>
    @else
        <a href="{{route('components')}}" class="full-flex pl-lg-2 pl-md-2 pl-1 pt-2">
            <div class="full-flex flex-column claim flex-center shadow-hover">
                <span class="claim-icon"><i class="fas fa-plus"></i></span>
                <span class="claim-text">Claim deze plaats</span>
            </div>
        </a>
    @endif
</div>
