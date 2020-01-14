@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => 'Nieuwsberichten', 'thumb' => 'mountain-top.jpg'])
    <main class="pt-3 ">

        <div class="container-fluid">
            <div class="table-wrapper padding m-4">
                <a href="{{ route('admin.notifications.create') }}" class="btn btn-success">Nieuw bericht</a>
                <table name="item" id="rating-table" class="table table-striped table-bordered" width="100%"
                       cellspacing="0" style="border-collapse: initial !important;">
                    <thead class="white-text">
                    <tr class="tr-header">
                        <th scope="col">Titel:</th>
                        <th scope="col">Bericht:</th>
                        <th scope="col">Aangemaakt op:</th>
                        <th scope="col">Laatste bewerking:</th>
                        <th scope="col">Acties:</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td>{{ $notification->title }}</td>
                            <td>{{ str_limit($notification->body, $limit = 40, $end = '...') }}</td>
                            <td>{{ $notification->created_at }}</td>
                            <td>{{ $notification->updated_at ? "Nog niet bewerkt."  : $notification->updated_at  }}</td>
                            <td>
                                <form action="{{ route('admin.notifications.delete',$notification->id) }}" METHOD="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-white btn-danger"><i
                                                class="far fa-trash-alt"></i> Verwijderen
                                    </button>
                                </form>
                                <a href="{{ route('admin.notifications.show-edit',$notification->id) }}"
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

