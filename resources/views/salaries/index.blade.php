@extends('layouts.master_template', ['title'=> 'Salaries'])

@section('title', 'Salaries')
@section('header')
<div class="pagetitle">
    <h1>Salaries</h1>
    <nav>
        <ol class="breadcrumb
        ">
            <li class="breadcrumb
            -item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Salaries</li>
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
                    <h5 class="mb-0">Salary History - {{ $employee->name }}</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateSalaryModal">
                        Update Salary
                    </button>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Current Salary: {{ $employee->salaries()->latest()->first()?->amount ?? 'Not Set' }}</h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#processMonthlyModal">
                                Process Monthly Salary
                            </button>
                        </div>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Previous Amount</th>
                                <th>New Amount</th>
                                <th>Increment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salaries as $salary)
                            <tr>
                                <td>{{ $salary->effective_date }}</td>
                                <td>{{ $salary->previous_amount ?? '-' }}</td>
                                <td>{{ $salary->amount }}</td>
                                <td>{{ $salary->increment_amount ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $salaries->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Salary Modal -->
<div class="modal fade" id="updateSalaryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Salary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('employees.salaries.store', $employee) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>New Salary Amount</label>
                        <input type="number" name="amount" class="form-control" required step="0.01">
                    </div>
                    <div class="form-group">
                        <label>Effective Date</label>
                        <input type="date" name="effective_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Salary</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Process Monthly Salary Modal -->
<div class="modal fade" id="processMonthlyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Process Monthly Salary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Current Salary: {{ $employee->salaries()->latest()->first()?->amount ?? 'Not Set' }}</h6>
                <h6>Pending Advances: {{ $employee->advances()->where('status', 'pending')->sum('amount') }}</h6>
                <hr>
                <form action="{{ route('employees.salaries.process-monthly', $employee) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Process Salary</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection