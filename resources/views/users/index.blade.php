@extends('layouts.master_template', ['title'=> 'Users'])

@section('title', 'Users')
@section('header')
<div class="pagetitle">
    <h1>Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection


<div class="col-lg-12">
    <div class="row">
@section('content')
<div class="container">
    <a href="{{ route('admin-users-create') }}" class="btn btn-primary btn-sm" style="margin-bottom: 15px"><i class="bi bi-plus-circle"></i> Add User</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>@if ($user->is_active == 1) <span class="badge bg-success">Yes</span> @else <span class="badge bg-danger">No </span> @endif</td>
                                <td>
                                    <a href="{{ route('admin-users-edit', $user->id) }}" class="btn btn-primary  btn-xs">Edit</a>
                                    <form action="{{ route('admin-users-destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    </div>
@section('script')
<script>
    @if(session('status'))
        toastr.success("{{ session('status') }}");
    @elseif(session('error'))
        toastr.error("{{ session('error') }}");
    @elseif(session('info'))
        toastr.info("{{ session('info') }}");
    @elseif(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
@endsection
</div>
