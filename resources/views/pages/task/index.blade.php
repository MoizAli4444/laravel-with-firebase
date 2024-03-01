@extends('layout.master')


@section('content')
    <div class="d-flex justify-content-end py-2">
        <a href="{{ route('task.create') }}" class="btn btn-sm btn-info">Add Task</a>
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

    <table class="table border">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Due Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $key => $task)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $task['title'] ?? '-' }}</td>
                    <td>{{ $task['due_date'] ?? '-' }}</td>
                    <td>
                        <a class="btn btn-outline-info btn-sm p-0 px-1" href="{{ route('task.edit', ['id' => $key]) }}"
                            target="_self"><i class="bi bi-pencil-square"></i></a>
                        <a class="btn btn-outline-secondary btn-sm p-0 px-1" href="{{ route('task.show', ['id' => $key]) }}"
                            target="_self"><i class="bi bi-eye-fill"></i></a>


                        <a class="btn btn-outline-danger btn-sm p-0 px-1" href="#"
                            onclick="if(confirm('Are you sure you want to delete this task?')) {event.preventDefault(); document.getElementById('deleteForm{{ $key }}').submit();}">
                            <i class="bi bi-trash-fill"></i>
                        </a>

                        <form id="deleteForm{{ $key }}" action="{{ route('task.destroy', ['id' => $key]) }}"
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
