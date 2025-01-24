@extends('layouts.master_template')

@section('title', 'Employee')

@section('content')

<div class="col-lg-12">
    <a href="{{ route('admin-employee-create') }}" class="btn btn-primary" style="margin-bottom: 10px; margin-left: 15px">
        <i class="bi bi-plus-circle"></i>
        Add Employee</a>
    <div class="card">
        <div class="card-header">Employees by Branch</div>
        <div class="card-body">
            @foreach($branches as $branch)
            <div class="card mb-4">
                <div class="card-header">
                    <h2>{{ $branch->name }}</h2>
                    <p class="text-muted">{{ $branch->address }}</p>
                </div>
                <div class="card-body">
                    @if($branch->employees->isEmpty())
                        <p>No employees assigned to this branch.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Position</th>
                                    <th>Manager</th>
                                    <th>Date of Joining</th>
                                    <th>Salary</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($branch->employees as $employee)
                                    <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->contact_number }}</td>
                                        <td>{{ $employee->position }}</td>
                                        <td>{{ $employee->is_manager ? 'Yes' : 'No' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($employee->doj)->format('d M Y') }}</td>
                                        <td>{{ number_format($employee->salary, 2) }}</td>
                                        <td>
                                                                        <!-- Edit Icon -->
                                            <a href="{{ route('admin-employee-edit', $employee->id) }}" class="text-primary me-2">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <!-- Delete Icon with Confirmation -->
                                            <form action="{{ route('admin-employee-destroy', $employee->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this employee?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach

        </div>
    </div>
</div>

</div>


@endsection
