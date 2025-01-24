@extends('layouts.master_template', ['title'=> 'Sales Return'])

@section('title', 'Sales Return')

@section('header')
<div class="pagetitle">
        <h1>Sales Return</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Sales Return</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
<div class="card">

    <div class="card-header">
        <a href="{{ route('admin-sales-returns-create') }}" class="btn btn-primary float-end">Create New Sales Return</a>
        <h5 class="card-title">Sales Return</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sale Order</th>
                    <th>Product</th>
                    <th>Branch</th>
                    <th>Quantity</th>
                    <th>Return Amount</th>
                    <th>Reason</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($salesReturns as $return)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $return->sale->so_order_number ?? 'N/A' }}</td>
                        <td>{{ $return->product->name ?? 'N/A' }}</td>
                        <td>{{ $return->branch->name ?? 'N/A' }}</td>
                        <td>{{ number_format($return->quantity, 2) }}</td>
                        <td>{{ number_format($return->return_amount, 2) }}</td>
                        <td>{{ $return->reason }}</td>
                        <td>{{ $return->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Sales Returns Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
