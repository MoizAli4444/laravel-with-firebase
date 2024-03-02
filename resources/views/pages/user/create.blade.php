@extends('layout.master')


@section('content')
    <div class="d-flex justify-content-end py-2">
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-info fw-bold">View Users</a>
    </div>

    <div class="py-2">

        @include('layout.alert')


        <form method="POST" action="{{ route('user.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" minlength="3" maxlength="25"
                    required value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required
                    value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" name="role" id="role" aria-label="Default select example" required>
                    <option value="" disabled>Select Role</option>
                    <option value="Plumber" {{ old('role') === 'Plumber' ? 'selected' : '' }}>Plumber</option>
                    <option value="Carpenter" {{ old('role') === 'Carpenter' ? 'selected' : '' }}>Carpenter</option>
                    <option value="Mechanic" {{ old('role') === 'Mechanic' ? 'selected' : '' }}>Mechanic</option>
                </select>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection
