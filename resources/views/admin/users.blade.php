@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="container">
            <h3 class="text-center m-3">List of Users</h3>
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class='text-center'>
                            <h6> User's Id </h6>
                        </th>
                        <th class='text-center'>
                            <h6> Email </h6>
                        </th>
                        <th class='text-center'>
                            <h6> Actions </h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class='align-self-center'>
                            <td class='text-center'>{{ $user->id }}</td>
                            <td class='text-center'> {{ $user->email }}</td>
                            <td class='text-center'><a type="button" class="btn btn-secondary" href="users/{{ $user->id }}">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection

@section('footer')
    {{ $users->links() }}
@endsection
