<!-- All users section -->
<div class="row mx-0">
    <div class="col-md-12">
        <!-- Content -->
        <div class="d-flex w-100 h-100 align-items-center my-3">
            <div class="d-flex white-text text-center w-100 h-100 flex-center">
                <div class="d-flex">
                    <h2 class="header-text text-black-50" style="text-shadow: unset;">
                        <strong>Topondernemers</strong>
                    </h2>
                </div>

            </div>
        </div>
        <!-- Content -->
    </div>
    <!-- All users -->
    <div class="col-md-7 pr-lg-0 pr-md-0 pr-auto mt1 ">
        <div class="all-user-wrap pt-0 pr-lg-3 pr-md-3 pr-auto ">
            @foreach($list as $key => $l)
                @if($l['user']->hasRole('student'))
                    <input type="hidden" value="{{ $l['user']->id }}" name="user_id" class="user_id">
                    <a href="" class="d-flex all-users p-3 my-3 getUser">
                        <div class="d-flex aj-center ">
                            <span class="all-user-icon d-flex aj-center">{{ $key + 1 }}</span>
                        </div>
                        <div class="all-users-content d-flex flex-column justify-content-around w-100">
                            <span class="all-user-name">{{ $l['user']->name }}</span>
                            <span class="all-user-email ">{{ $l['user']->email }}</span>
                        </div>
                        <small class="d-flex align-items-center grey-text all-user-arrow"><i class="fas fa-chevron-right"></i></small>
                    </a>
                @endif
            @endforeach

        </div>
    </div>
    <!-- All users -->

    <!-- User info when clicked -->
    <div  class="col-md-5 pl-lg-0 pl-md-0 pl-auto mb-5">
        <div id="wrap-info" class="user-info-wrap padding pl-lg-3 pl-md-3 pl-auto">
            <div class="d-flex user-info p-3 flex-column">
                <div class="d-flex w-100 justify-content-center">
                    <span class="block-user-icon d-flex aj-center mr-0 " style="height: 60px">NA</span>
                </div>
                <div class="user-name mt-2">
                    <span class="all-user-name" id="username">{{ $list[0]['user']->name }} {{ $list[0]['user']->lastname }}</span>
                </div>
                <table class="table table-borderless user-table mt-3 mx-lg-4 mx-md-3 mx-auto">
                    <tbody>
                    <tr>
                        <th >Nummer</th>
                        <td id="st_number">{{ $list[0]['user']->st_number }}</td>
                    </tr>
                    <tr>
                        <th>Telefoon</th>
                        <td id="tel">{{ (empty($list[0]['user']->phone))? 'n.v.t' : $list[0]['user']->phone}}</td>
                    </tr>
                    <tr>
                        <th>bedrijfsnaam</th>
                        <td id="company_name">{{ (empty($list[0]['user']->company))? 'n.v.t' : $list[0]['user']->company}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-center text-white">
                    <a href="{{ route('profile', $list[0]['user']->id) }}" id="userid" class="btn btn-sm m-0 bg-color-blue">profiel bekijken</a>
                </div>
            </div>

            <div class="d-flex flex-column user-info p-3 mt-4">
                <div class="meter white nostripes ">
                                <span id="percentage" class="text-right text-white text-shadow-slight radius-right "
                                      style="width: {{  (($list[0]['user']->assignmentPercentile($list[0]['user']->id) == 0)? 0 : $list[0]['user']->assignmentPercentile($list[0]['user']->id))}}%;">
                                </span>
                </div>
                <span class="my-3 total-text" >
                                Totaal <span class="font-weight-bold" id="total">{{$list[0]['user']->getCountCompletedAssignments($list[0]['user']->id)}}
                </span> van de <span class="font-weight-bold">9</span> onderdelen afgerond</span>

            </div>

        </div>
    </div>
    <!-- User info when clicked -->
</div>
<!-- All users section -->
