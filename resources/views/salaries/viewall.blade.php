@extends('layouts.master_template', ['title'=> 'Employee Salaries'])

@section('title', 'Employee Salaries')
@section('header')
<div class="pagetitle">
    <h1>Salaries</h1>
    <nav>
        <ol class="breadcrumb
        ">
            <li class="breadcrumb
            -item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Employee Salaries</li>
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
                    <h5 class="mb-0">Current Salary </h5>
                   
                </div>
                <div class="card-body">
                   
                    
                    <table class="table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Previous Salary</th>
                                <th>Current Salary</th>
                                <th>Increment</th>
                                <th>Effective Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salaries as $salary)
                            <tr>
                                <td>{{ $salary->employee->name }} </td>
                                <td>{{ $salary->previous_amount ?? '-' }}</td>
                                <td>{{ $salary->amount }}</td>
                                <td>{{ $salary->increment_amount ?? '-' }}</td>
                                <td>{{ $salary->effective_date }}</td>
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