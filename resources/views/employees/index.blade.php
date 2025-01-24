@extends('layouts.master_template', ['title'=> 'Employees'])

@section('title', 'Employees')
@section('header')
<div class="pagetitle">
    <h1>Employees</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Employees</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Employees</h5>
                    <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">Add New Employee</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>District</th>
                                <th>Join Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->employee_code }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->phone_number }}</td>
                                <td>{{ $employee->district }}</td>
                                <td>{{ $employee->date_of_joining }}</td>
                                <td>
                                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ route('employees.salaries.index', $employee) }}" class="btn btn-sm btn-success">Salary</a>
                                    <a href="{{ route('employees.advances.index', $employee) }}" class="btn btn-primary">
                                        Manage Advances
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
   
