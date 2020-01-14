@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => 'Beoordelen', 'thumb' => 'people.jpg'])
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
                        <th scope="col" class="th-sm">inleverdata</th>
                        <th scope="col" class="th-sm">Actie</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($assignments as $assignment)
                        <tr>
                            <th scope="row">{{ $assignment->user->name }}</th>
                            <td>{{ $assignment->user->email }}</td>
                            <td>{{ $assignment->component->name }}</td>
                            <td>{{ $assignment->updated_at->format('d-m-Y ') }} om {{ $assignment->updated_at->format(' H:i') }}</td>
                            @can('judge assignment')
                                <td class="text-center">
                                    <a href="{{route('admin.assignments.rating', $assignment->id)}}"
                                       class="btn btn-sm bg-color-blue text-center text-white">
                                        Beoordelen
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
