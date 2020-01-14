@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => 'Beoordeeld', 'thumb' => 'money.jpg'])
    <main class="pt-3 ">
        <div class="container-fluid">
            <div class="table-wrapper padding m-4">
                <table name="item" id="rating-table" class="table table table-bordered table-hover " width="100%" cellspacing="0" style="border-collapse: initial !important;" >
                    <caption>Ingeleverde opdrachten</caption>
                    <thead class="white-text">
                    <tr class="tr-header">
                        <th scope="col" class="th-sm">Naam</th>
                        <th scope="col" class="th-sm">Email</th>
                        <th scope="col" class="th-sm">Onderdeel</th>
                        <th scope="col" class="th-sm">Beoordeeld op</th>
                        <th scope="col" class="th-sm">Beoordeling</th>
                        <th scope="col" class="th-sm">Actie</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($rated as $r)
                        <tr>
                            <th scope="row">{{ $r->user->name }}</th>
                            <td>{{ $r->user->email }}</td>
                            <td>{{ $r->component->name }}</td>
                            <td>
                                @if($r->rated == 2)
                                    <span class="home-color-green">voldoende</span>
                                @elseif($r->rated == 1)
                                    <span class="home-color-red">onvoldoende</span>
                                @endif
                            </td>
                            <td>{{ $r->updated_at->format('d-m-Y ') }} om {{ $r->updated_at->format(' H:i') }}</td>

                            @can('judge assignment')
                                <td class="text-center">
                                    <a href="{{route('admin.assignments.rating', $r->id)}}"
                                       class="btn btn-sm bg-color-blue text-center text-white">
                                        Bekijken
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </main>


@endsection
