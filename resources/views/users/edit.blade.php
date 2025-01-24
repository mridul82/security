@extends('layouts.master_template', ['title' => 'Edit User'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin-users-update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-select" id="role" required>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="sub_admin" {{ $user->role == 'sub_admin' ? 'selected' : '' }}>Sub Admin</option>
                                <option value="delivery_boy" {{ $user->role == 'delivery_boy' ? 'selected' : '' }}>Delivery Boy</option>
                                <!-- Add more roles if needed -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="form-label">Active Status</label>
                            <select name="is_active" class="form-select" id="is_active" required>
                                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="{{ route('admin-users') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
