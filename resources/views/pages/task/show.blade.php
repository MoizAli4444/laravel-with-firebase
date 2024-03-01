@extends('layout.master')


@section('content')
    <div class="d-flex justify-content-end py-2">
        <a href="{{ route('task.edit', ['id' => $task['id']]) }}" class="btn btn-sm btn-info mx-2">Edit Task</a>
        <a href="{{ route('task.index') }}" class="btn btn-sm btn-secondary">All Tasks</a>
    </div>

    <div class="container">
        <h1>Task Details</h1>
        <div class="row">
            <div class="col-md-12">
                <p><strong>Title:</strong> {{ $task['title'] }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Assignee:</strong> {{ $task['assignee'] ?? '-' }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Due Date:</strong> {{ $task['due_date'] }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Priority:</strong>
                    @if ($task['priority'] === 'high')
                        <span class="badge bg-danger">{{ $task['priority'] }}</span>
                    @elseif($task['priority'] === 'medium')
                        <span class="badge bg-warning text-dark">{{ $task['priority'] }}</span>
                    @else
                        <span class="badge bg-success">{{ $task['priority'] }}</span>
                    @endif
                </p>
            </div>
            <div class="col-md-3">
                <p><strong>Status:</strong>
                    @if ($task['status'] === 'pending')
                        <span class="badge bg-warning text-dark">{{ $task['status'] }}</span>
                    @elseif($task['status'] === 'approved')
                        <span class="badge bg-success">{{ $task['status'] }}</span>
                    @else
                        <span class="badge bg-danger">{{ $task['status'] }}</span>
                    @endif
                </p>
            </div>

            <div class="col-12">
                <p><strong>Description:</strong> {{ $task['description'] }}</p>
            </div>
        </div>
    </div>
@endsection
