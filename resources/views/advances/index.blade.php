@extends('layouts.master_template', ['title'=> 'Employee Advance Payment'])

@section('title', 'Employee Advance Payment')
@section('header')
<div class="pagetitle">
    <h1>Employee Advance Payment</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Employee Advance Payment</li>
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
                    <h5 class="mb-0">Advance Payments - {{ $employee->name }}</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newAdvanceModal">
                        New Advance Payment
                    </button>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <h6>Current Salary: {{ number_format($currentSalary, 2) }}</h6>
                        </div>
                        <div class="col-md-4">
                            <h6>Total Pending Advances: {{ number_format($totalPendingAdvance, 2) }}</h6>
                        </div>
                        <div class="col-md-4">
                            <h6>Available for Advance: {{ number_format(max(0, $currentSalary - $totalPendingAdvance), 2) }}</h6>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($advances as $advance)
                                <tr>
                                    <td>{{ $advance->date }}</td>
                                    <td>{{ number_format($advance->amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $advance->status === 'pending' ? 'warning' : 'success' }}">
                                            {{ ucfirst($advance->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($advance->status === 'pending')
                                            <button type="button" class="btn btn-sm btn-primary" 
                                                onclick="editAdvance({{ $advance->id }}, '{{ $advance->date }}', {{ $advance->amount }})">
                                                Edit
                                            </button>
                                            <form action="{{ route('employees.advances.destroy', [$employee, $advance]) }}" 
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this advance payment?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">No actions available</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No advance payments found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $advances->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Advance Modal -->
<div class="modal fade" id="newAdvanceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Advance Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('employees.advances.store', $employee) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" required step="0.01"
                            max="{{ $currentSalary - $totalPendingAdvance }}">
                        <small class="text-muted">Maximum available: {{ number_format($currentSalary - $totalPendingAdvance, 2) }}</small>
                    </div>
                    <div class="form-group mb-3">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required max="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Advance</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Advance Modal -->
<div class="modal fade" id="editAdvanceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Advance Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAdvanceForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" required step="0.01" id="editAmount">
                        <small class="text-muted">Maximum available: {{ number_format($currentSalary - $totalPendingAdvance, 2) }}</small>
                    </div>
                    <div class="form-group mb-3">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required max="{{ date('Y-m-d') }}" id="editDate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Advance</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    function editAdvance(id, date, amount) {
        const form = document.getElementById('editAdvanceForm');
        form.action = `{{ route('employees.advances.index', $employee) }}/${id}`;
        document.getElementById('editDate').value = date;
        document.getElementById('editAmount').value = amount;
        new bootstrap.Modal(document.getElementById('editAdvanceModal')).show();
    }
    </script>
@endpush