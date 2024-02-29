@extends('layout.master')


@section('content')
    <div class="d-flex justify-content-end py-2">
        <a href="{{ route('user.create') }}" class="btn btn-sm btn-info">Add User</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table border ">
        <thead>
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['role'] }}</td>
                    <td>
                        <a class="text-info" href="{{ route('user.edit', ['id' => $key]) }}" target="_self"><i
                                class="bi bi-pencil-square"></i></a>
                        <a class="text-danger" href="#"
                            onclick="if(confirm('Are you sure you want to delete this user?')) {event.preventDefault(); document.getElementById('deleteForm{{ $key }}').submit();}">
                            <i class="bi bi-trash-fill"></i>
                        </a>

                        <form id="deleteForm{{ $key }}" action="{{ route('user.destroy', ['id' => $key]) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>



                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
