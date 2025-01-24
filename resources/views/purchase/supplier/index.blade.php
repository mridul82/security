{{-- resources/views/suppliers/index.blade.php --}}
@extends('layouts.master_template', ['title'=> 'Suppliers'])

@section('title', 'Suppliers')
@section('header')
<div class="pagetitle">
    <h1>Suppliers</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Suppliers</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">

                <a href="{{ route('admin-supplier-create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New Supplier
                </a>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Search and Filters --}}
    {{-- <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin-suppliers') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                               placeholder="Search suppliers...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Blocked</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Product Type</label>
                        <select name="supplier_product_type" class="form-select">
                            <option value="">All Product Types</option>
                            <option value="book" {{ request('supplier_product_type') == 'book' ? 'selected' : '' }}>Book</option>
                            <option value="instrument" {{ request('supplier_product_type') == 'instrument' ? 'selected' : '' }}>Instrument</option>

                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-secondary d-block w-100">
                            <i class="bi bi-search"></i> Filter Results
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}

    {{-- Suppliers Table --}}
    <div class="card">
        <div class="card-body">
            <div class="card-title">Suppliers List</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Company Name</th>
                            <th>Contact Person</th>
                            <th>Email/Phone</th>
                            <th>Status</th>
                            <th>Product Type</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->supplier_code }}</td>
                            <td>{{ $supplier->company_name }}</td>
                            <td>{{ $supplier->contact_person }}</td>
                            <td>
                                {{ $supplier->email }}<br>
                                <small class="text-muted">{{ $supplier->phone }}</small>
                            </td>
                            <td>
                                <span class="badge {{ $supplier->status === 'active' ? 'bg-success' :
                                    ($supplier->status === 'inactive' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ ucfirst($supplier->status) }}
                                </span>
                            </td>
                            <td>{{ $supplier->supplier_product_type }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin-supplier-show', $supplier) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin-supplier-edit', $supplier) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $supplier->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No suppliers found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">

            </div>
        </div>
    </div>
</div>

{{-- Delete Modals --}}
@foreach($suppliers as $supplier)
<div class="modal fade" id="deleteModal{{ $supplier->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete supplier "{{ $supplier->company_name }}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin-supplier-delete', $supplier) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection
