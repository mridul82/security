@extends('layouts.master_template', ['title'=> 'Edit Employee'])

@section('title', 'Edit Employee')

@section('header')
<div class="pagetitle">
    <h1>Edit Employee</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin-employees') }}">Employees</a></li>
        <li class="breadcrumb-item active">Edit Employee</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Edit Employee</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin-employee-update', $employee->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                <!-- Branch Selection -->
                <div class="form-group col-md-6">
                    <label for="branch_id">Branch</label>
                    <select name="branch_id" id="branch_id" class="form-control" required>
                        <option value="">Select Branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $branch->id == $employee->branch_id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Employee Name -->
                <div class="form-group col-md-6">
                    <label for="name">Employee Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $employee->name }}" required>
                </div>

            </div>

            <div class="row">
                <!-- Email -->
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $employee->email }}" required>
                </div>

                <!-- Contact Number -->
                <div class="form-group col-md-6">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ $employee->contact_number }}" required>
                </div>
            </div>

            <div class="row">

                <!-- Position -->
                <div class="form-group col-md-6">
                    <label for="position">Position</label>
                    <input type="text" name="position" id="position" class="form-control" value="{{ $employee->position }}" required>
                </div>

                <!-- Manager Checkbox -->
                <div class="form-group form-check col-md-6">
                    <input type="checkbox" name="is_manager" id="is_manager" class="form-check-input" {{ $employee->is_manager ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_manager">Is Manager</label>
                </div>

            </div>

            <div class="row">

                <!-- Salary -->
                <div class="form-group col-md-6">
                    <label for="salary">Salary</label>
                    <input type="number" step="0.01" name="salary" id="salary" class="form-control" value="{{ $employee->salary }}" required>
                </div>

                <!-- Date of Joining (DOJ) -->
                <div class="form-group  col-md-6">
                    <label for="doj">Date of Joining</label>
                    <input type="date" name="doj" id="doj" class="form-control" value="{{ $employee->doj }}" required>
                </div>

            </div>

                <button type="submit" class="btn btn-primary">Update Employee</button>
            </form>
        </div>
    </div>
</div>
@endsection
