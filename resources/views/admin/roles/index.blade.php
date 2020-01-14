@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => 'Beoordelen', 'thumb' => 'mountain-top.jpg'])
    <main class="pt-3 ">
        <div class="container-fluid">
            <div class="table-wrapper padding m-4">
                <table name="item" id="rating-table" class="table table-striped table-bordered" width="100%"
                       cellspacing="0" style="border-collapse: initial !important;">
                    <thead class="white-text">
                    <a href="{{ route('admin.roles.show-create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Nieuwe rol aanmaken</a>
                    <tr class="tr-header">
                        <th scope="col">Naam:</th>
                        <th scope="col">Aangemaakt op:</th>
                        <th scope="col">Laatste bewerking:</th>
                        <th scope="col">Acties:</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at ? "Nog niet bewerkt." : $role->updated_at  }}</td>
                            <td>
                                <form action="{{ route('admin.roles.delete-role', $role->id) }}" METHOD="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-white btn-danger"><i
                                                class="far fa-trash-alt"></i> Verwijderen
                                    </button>
                                </form>
                                <a href="{{ route('admin.roles.show-edit', $role->id) }}"
                                   class="btn btn-sm btn-success text-white"><i class="fas fa-edit"></i> Aanpassen</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </main>


@endsection
