@extends('layout.master')


@section('content')
    <div class="d-flex justify-content-end py-2">
        <a href="{{ route('task.show', ['id' => $task['id']]) }}" class="btn btn-sm btn-info mx-2">View Task</a>
        <a href="{{ route('task.index') }}" class="btn btn-sm btn-secondary">All Tasks</a>
    </div>

    <div class="py-2">
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


        <form method="POST" action="{{ route('task.update', $task['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" minlength="3" maxlength="255"
                    required value="{{ old('title', $task['title'] ?? '') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $task['description'] ?? '') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="assignee_id" class="form-label">Assignee</label>
                <select class="form-select" name="assignee_id" id="assignee_id" required>
                    <option value="" disabled>Select Assignee</option>
                    @foreach ($users as $key => $user)
                        <option value="{{ $key }}"
                            {{ old('assignee_id', $task['assignee_id'] ?? '') == $key ? 'selected' : '' }}>
                            {{ $user['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('assignee_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="" disabled>Select Status</option>
                    <option value="open" {{ old('status', $task['status'] ?? '') == 'open' ? 'selected' : '' }}>Open
                    </option>
                    <option value="in_progress"
                        {{ old('status', $task['status'] ?? '') == 'in_progress' ? 'selected' : '' }}>In
                        Progress</option>
                    <option value="completed" {{ old('status', $task['status'] ?? '') == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select class="form-select" name="priority" id="priority" required>
                    <option value="" disabled>Select Priority</option>
                    <option value="high" {{ old('priority', $task['priority'] ?? '') == 'high' ? 'selected' : '' }}>High
                    </option>
                    <option value="medium" {{ old('priority', $task['priority'] ?? '') == 'medium' ? 'selected' : '' }}>
                        Medium
                    </option>
                    <option value="low" {{ old('priority', $task['priority'] ?? '') == 'low' ? 'selected' : '' }}>Low
                    </option>
                </select>
                @error('priority')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required
                    value="{{ old('due_date', $task['due_date'] ?? '') }}">
                @error('due_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>


    </div>
@endsection
