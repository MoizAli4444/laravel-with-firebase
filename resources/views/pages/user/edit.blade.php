@extends('layout.master')


@section('content')
    <div class="d-flex justify-content-end py-2">
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-info fw-bold">All Users</a>
    </div>

    <div class="py-2">

        <form method="POST" action="{{ route('user.update', $user['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" minlength="3" maxlength="25"
                    required value="{{ old('name', $user['name'] ?? '') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required
                    value="{{ old('email', $user['email'] ?? '') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" name="role" id="role" aria-label="Default select example" required>
                    @if ($user['role'])
                        <option value="" disabled>Select Role</option>
                        <option value="Plumber" {{ old('role', $user['role']) === 'Plumber' ? 'selected' : '' }}>Plumber
                        </option>
                        <option value="Carpenter" {{ old('role', $user['role']) === 'Carpenter' ? 'selected' : '' }}>
                            Carpenter
                        </option>
                        <option value="Mechanic" {{ old('role', $user['role']) === 'Mechanic' ? 'selected' : '' }}>Mechanic
                        </option>
                    @else
                        <option value="" disabled>Role not found</option>
                    @endif
                </select>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection
