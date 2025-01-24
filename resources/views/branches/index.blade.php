@extends('layouts.master_template', ['title'=> 'Branches'])

@section('title', ' Branches')
@section('header')
<div class="pagetitle">
    <h1>Branches</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Branches</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">Add Branch</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin-branches-store') }}" class="p-3 rounded shadow-sm">
                        @csrf

                        <div class="form-group row mb-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-weight-bold">Branch Name</label>
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
                            <label for="address" class="col-md-4 col-form-label text-md-right font-weight-bold">Address</label>
                            <div class="col-md-6">
                                <textarea id="address" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" required>{{ old('address') }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right font-weight-bold">Contact Number</label>
                            <div class="col-md-6">
                                <input id="contact_number" type="text" class="form-control form-control-sm @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" required>
                                @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="extra_expense" class="col-md-4 col-form-label text-md-right font-weight-bold">Extra Expense</label>
                            <div class="col-md-6">
                                <input id="extra_expense" type="number" step="0.01" class="form-control form-control-sm @error('extra_expense') is-invalid @enderror" name="extra_expense" value="{{ old('extra_expense') }}">
                                @error('extra_expense')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="salary" class="col-md-4 col-form-label text-md-right font-weight-bold">Salary</label>
                            <div class="col-md-6">
                                <input id="salary" type="number" step="0.01" class="form-control form-control-sm @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}">
                                @error('salary')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="manager_id" class="col-md-4 col-form-label text-md-right font-weight-bold">Branch Manager</label>
                            <div class="col-md-6">
                                <select id="manager_id" class="form-control form-control-sm @error('manager_id') is-invalid @enderror" name="manager_id">
                                    <option value="">Select Manager</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('manager_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} - {{ $user->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('manager_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="is_active" class="col-md-4 col-form-label text-md-right font-weight-bold">Status</label>
                            <div class="col-md-6">
                                <select id="is_active" class="form-control form-control-sm @error('is_active') is-invalid @enderror" name="is_active" required>
                                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm px-4">
                                    Add Branch
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Branches</h5>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Manager</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $branch)
                            <tr>
                                <td>{{$branch->name}}</td>
                                <td>{{$branch->address}}</td>
                                <td>{{$branch->contact_number}}</td>
                                <td>{{$branch->manager ? $branch->manager->name : 'Not Assigned'}}</td>
                                <td>
                                    <span class="badge bg-{{ $branch->is_active ? 'success' : 'danger' }}">
                                        {{$branch->status_label}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{url('/admin/branches/edit/'.$branch->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
