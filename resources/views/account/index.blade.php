@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Beoordelen', 'thumb' => 'mountain-top.jpg'])

    <div class="container">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Avatar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img src="{{ asset('uploads/avatar/'.$user->id.'/'.$user->file) }}" alt="" class="img-thumbnail" width="25%" aria-placeholder="test">
                    </td>
                </tr>
            </tbody>
        </table>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('changeProfilePicture') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ csrf_field() }}
            <input type="file" class="form-control-file" id="upload" name="upload">

            <input type="submit" class="btn btn-primary">
        </form>

        <div class="col-md-12 row">

        <div class="col-md-6">
        <h2>Onbeoordeelde inleveringen:</h2>
        @foreach($assignments as $assignment)
            <div class="card" >
                <div class="card-body">

                <h4>{{$assignment->updated_at}}</h4>
                <h4>Component: {{$assignment->component_id}}</h4>
                <h4>User: {{$assignment->user_id}}</h4>
                <br>




                <label>Kansen:</label>
                    @if($assignment->file2 != "")
                    <h4>2/2</h4>
                @else
                    <h4>1/2</h4>
                @endif

                        <div class="row">
                            <form action="{{ route('download') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <h4>{{$assignment->file1}}</h4>
                                <input hidden value="{{$assignment->component_id}}" name="component_id"/>
                                <input hidden value="{{$assignment->file1}}" name="file1" />

                                <button type="submit" class="button btn purple-gradient"><i class="fa fa-download" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        @if($assignment->file2 != "")
                        <div class="row">
                            <h4>{{$assignment->file2}}</h4>
                            <form action="{{ route('download') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <input hidden value="{{$assignment->component_id}}" name="component_id"/>
                                <input hidden value="{{$assignment->file2}}" name="file1" />

                                <button type="submit" class="button btn purple-gradient"><i class="fa fa-download" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        @endif


                <form action="{{ route('changeRating') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input hidden name="id" value="{{$assignment->id}}">
                    <button type="submit" name="rated" value="1" class="btn btn-success">Voldoende</button>


                    <button type="submit" name="rated" value="2" class="btn btn-danger">Onvoldoende</button>
                </form>

                </div>
            </div>
            <br>

        @endforeach
        </div>


        <div class="col-md-6">
            <h2>Beoordeelde inleveringen:</h2>
            @foreach($finishedAssignments as $assignment)
                <div class="card">
                    <div class="card-body">

                        <h4>{{$assignment->updated_at}}</h4>
                        <h4>Component: {{$assignment->component_id}}</h4>
                        <h4>User: {{$assignment->user_id}}</h4>

                        <h4>Beoordeling: @if($assignment->rated == 1) Voldoende @else Onvoldoende @endif</h4>
                        <br>


                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample{{$assignment->id}}" aria-expanded="false" aria-controls="collapseExample">
                                Button with data-target
                            </button>

                        <div class="collapse" id="collapseExample{{$assignment->id}}">




                        <label>Kansen:</label>
                        @if($assignment->file2 != "")
                            <h4>2/2</h4>
                        @else
                            <h4>1/2</h4>
                        @endif

                        <div class="row">
                            <form action="{{ route('download') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <h4>{{$assignment->file1}}</h4>
                                <input hidden value="{{$assignment->component_id}}" name="component_id"/>
                                <input hidden value="{{$assignment->file1}}" name="file1" />

                                <button type="submit" class="button btn purple-gradient"><i class="fa fa-download" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        @if($assignment->file2 != "")
                            <div class="row">
                                <h4>{{$assignment->file2}}</h4>
                                <form action="{{ route('download') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <input hidden value="{{$assignment->component_id}}" name="component_id"/>
                                    <input hidden value="{{$assignment->file2}}" name="file1" />

                                    <button type="submit" class="button btn purple-gradient"><i class="fa fa-download" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        @endif

                        <button type="button" id="modal-btn" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal{{$assignment->id}}" class="btn btn-primary"><i class="fa fa-cog" aria-hidden="true"></i>



                        </button>






                            <!-- Modal -->
                            <div class="modal fade mt-lg-5 mt-md-5 mt-0 pt-lg-5 pt-md-5 mt-0" id="basicExampleModal{{$assignment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content ">
                                        <div class="d-flex flex-lg-row flex-md-row flex-column w-100">

                                            <div class="d-flex flex-column w-100 p-4">
                                                <div class="modal-header-wrap">
                                                    <h2 class="modal-title" id="exampleModalLabel">Document inleveren</h2>
                                                    <p>Je staat op het punt om de beoordeling te veranderen</p>
                                                    <br>
                                                    <p>Huidige beoordeling is @if($assignment->rated == 2) <b>onvoldoende</b> @else <b>voldoende</b> @endif</p>

                                                </div>
                                                <div class="modal-body-wrap my-3"></div>
                                                <div class="modal-ft my-4">

                                                    <form action="{{ route('changeRating') }}" method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input hidden name="id" value="{{$assignment->id}}">
                                                        <button type="submit" name="rated" value="1" class="btn btn-success">Voldoende</button>


                                                        <button type="submit" name="rated" value="2" class="btn btn-danger">Onvoldoende</button>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
                <br>

            @endforeach
        </div>
        </div>
    </div>


    {{--    --}}
    {{--    <div class="colors-divider linear-background mt-5 " style="height: 7px;"></div>--}}
    {{--    --}}



@endsection
