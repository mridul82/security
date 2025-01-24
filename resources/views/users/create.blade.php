@extends('layouts.master_template', ['title'=> 'Users'])
@section('title', 'Users')
@section('header')
<div class="pagetitle">
    <h1>Create Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Create Users</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create User</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin-users-store') }}" class="p-3 rounded shadow-sm" >
                        @csrf

                        <div class="form-group row mb-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-weight-bold">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-bold">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="role" class="col-md-4 col-form-label text-md-right font-weight-bold">Role</label>
                            <div class="col-md-6">
                                <select id="role" class="form-control form-control-sm @error('role') is-invalid @enderror" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="sub_admin">Sub Admin</option>
                                    <option value="delivery_boy">Delivery Boy</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm px-4">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
