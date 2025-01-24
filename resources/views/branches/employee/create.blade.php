@extends('layouts.master_template', ['title'=> 'employee'])

@section('title', 'Employee')

@section('header')
<div class="pagetitle">
    <h1>Add Employee</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Add Employee</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Add Employee</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin-employee-store') }}">
                @csrf

                <div class="row">
                    <!-- Branch Selection -->
                    <div class="col-md-6 form-group">
                        <label for="branch_id">Branch</label>
                        <select name="branch_id" id="branch_id" class="form-control" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Employee Name -->
                    <div class="col-md-6 form-group">
                        <label for="name">Employee Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Email -->
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <!-- Contact Number -->
                    <div class="col-md-6 form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Position -->
                    <div class="col-md-6 form-group">
                        <label for="position">Position</label>
                        <input type="text" name="position" id="position" class="form-control" required>
                    </div>

                    <!-- Manager Checkbox -->
                    <div class="col-md-6 form-group">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="is_manager" id="is_manager" class="form-check-input">
                            <label class="form-check-label" for="is_manager">Is Manager</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Salary -->
                    <div class="col-md-6 form-group">
                        <label for="salary">Salary</label>
                        <input type="number" step="0.01" name="salary" id="salary" class="form-control" required>
                    </div>

                    <!-- Date of Joining (DOJ) -->
                    <div class="col-md-6 form-group">
                        <label for="doj">Date of Joining</label>
                        <input type="date" name="doj" id="doj" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-right mt-3">
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
