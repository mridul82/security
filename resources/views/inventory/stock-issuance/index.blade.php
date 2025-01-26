@extends('layouts.master_template', ['title'=> 'Stock Issuance'])

@section('title', 'Stock Issuance')
@section('header')
<div class="pagetitle">
    <h1>Stock Issuance</h1>
    <nav>
        <ol class="breadcrumb
        ">
            <li class="breadcrumb
            -item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Stock Issuance</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <h2>Stock Issuance History</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover table-bordered datatable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Issued To</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @forelse($issuances as $issuance)
                <tr>
                    <td>{{ $issuance->issued_at }}</td>
                    <td>{{ $issuance->product->name }}</td>
                    <td>{{ $issuance->quantity }}</td>
                    <td>{{ ($issuance->issued_to_type == 'employee') ? $issuance->issued_to->name : $issuance->issued_to->business_name }}</td>
                    <td>{{ ucfirst($issuance->issued_to_type) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection