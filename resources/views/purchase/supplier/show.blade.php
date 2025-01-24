@extends('layouts.master_template')

@section('title', 'Supplier Details')
```
@section('header')
    <div class="pagetitle">
        <h1>Supplier Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin-suppliers') }}">Suppliers</a></li>
                <li class="breadcrumb-item active">Supplier Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Supplier Details</h3>
                </div>
                    <div class="card-body">
                        @include('purchase.supplier._details', ['supplier' => $supplier])

                        <div class="col-md-4">
                    <div class="card-footer text-end">
                        <a href="{{ route('admin-supplier-edit', $supplier) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('admin-suppliers') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
