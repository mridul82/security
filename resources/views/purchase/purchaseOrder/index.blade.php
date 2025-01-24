@extends('layouts.master_template', ['title'=> 'Purchase'])

@section('title', 'Purchase')

@section('header')
<div class="pagetitle">
    <h1>Purchase</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Purchase</li>
      </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <h1>Purchase Orders</h1>
    <a href="{{ route('admin-purchase-create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Create Purchase Order</a>
    <table class="table table-striped table-hover  datatable">
        <thead>
            <tr>
                <th>PO Number</th>
                <th>Supplier</th>
                <th>Date</th>
                <th>Paid Amount</th>
                <th>Outstanding Balance</th>
                <th>Payment Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseOrders as $order)
            <tr>
                <td>{{ $order->po_number }}</td>
                <td>{{ $order->supplier->company_name }}</td>
                <td>{{ $order->purchase_date }}</td>
                <td>₹{{ number_format($order->purchaseOrderPayment->amount) }}</td>
                <td>₹{{ number_format($order->purchaseOrderPayment->outstanding_amount) }}</td>
                <td>{{ $order->payment_type }}</td>
                <td>
                    <a href="{{ route('admin-purchase-view', $order) }}" class="btn btn-info">View Details</a>
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
