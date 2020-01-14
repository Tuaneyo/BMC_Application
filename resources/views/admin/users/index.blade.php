@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => $html['title'], 'thumb' => $html['thumb']])
    <main class="pt-3 ">
        <div class="container-fluid">
            <div class="table-wrapper padding m-4">
                <table name="item" id="rating-table" class="table table-bordered table-hover" width="100%"
                       cellspacing="0" style="border-collapse: initial !important;">
                    <thead class="white-text">
                    <tr class="tr-header">
                        <th scope="col">Naam:</th>
                        <th scope="col">Achternaam:</th>
                        <th scope="col">E-mail Adres:</th>
                        <th scope="col">Aangemaakt op:</th>
                        <th scope="col">Acties:</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if(!$user->hasRole('administrator') )
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d-m-Y ') }} om {{ $user->created_at->format(' H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show-edit', $user->id) }}"
                                       class="btn btn-sm bg-color-blue text-white">Aanpassen</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </main>


@endsection
