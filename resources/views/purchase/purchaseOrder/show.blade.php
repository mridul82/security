@extends('layouts.master_template', ['title'=> 'Purchase Details'])

<style>
    .section-card {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        background-color: #fff;
    }
    .card-header {
        background-color: #f8f9fa;
        padding: 10px;
        font-weight: bold;
        font-size: 16px;
        border-bottom: 1px solid #ddd;
    }
    .table-details th, .table-details td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
</style>

@section('title', 'Purchase Order Details')

@section('header')
<div class="pagetitle">
    <h1>Purchase Order Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin-purchases') }}">Purchase Orders</a></li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="col-lg-12">

    <!-- PO Basic Details -->
    <div class="section-card">
        <div class="card-header">Basic Details</div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>PO Number:</strong> {{ $purchase->po_number }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Purchase Date:</strong> {{ $purchase->purchase_date }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Supplier:</strong> {{ $purchase->supplier->company_name }}</p>
            </div>
        </div>
    </div>

    <!-- Billing Details -->
    <div class="section-card">
        <a href="{{ route('admin-purchase-edit', $purchase->id) }}" class="text-primary me-2" style="float: right; margin-right: 10px">
            <i class="bi bi-pencil-square" ></i>Edit
            </a>
        <div class="card-header">Billing Details</div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Billing Name:</strong> {{ $purchase->billing_name }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Billing Contact:</strong> {{ $purchase->billing_contact }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Payment Type:</strong> {{ $purchase->payment_type }}</p>
            </div>
            <div class="col-md-12 mt-2">
                <p><strong>Billing Address:</strong> {{ $purchase->billing_address }}</p>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="section-card">
        <a href="{{ route('admin-purchase-edit', $purchase->id) }}" class="text-primary me-2" style="float: right; margin-right: 10px">
        <i class="bi bi-pencil-square" ></i>Edit
        </a>
        <div class="card-header">Products</div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>GST (%)</th>
                    <th>GST Amount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ $item->gst_percentage }}%</td>
                        <td>{{ number_format($item->gst_amount, 2) }}</td>
                        <td>{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Additional Charges -->
    <div class="section-card">
        <a href="{{ route('admin-purchase-edit', $purchase->id) }}" class="text-primary me-2" style="float: right; margin-right: 10px">
            <i class="bi bi-pencil-square" ></i>Edit
            </a>
        <div class="card-header">Additional Charges</div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Tax Type:</strong> {{ $purchase->tax_type }}</p>
                <p><strong>Tax Amount:</strong> ₹{{ number_format($purchase->tax_amount, 2) }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Transport Amount:</strong> ₹{{ number_format($purchase->transport_amount, 2) }}</p>
                <p><strong>Miscellaneous:</strong> ₹{{ number_format($purchase->miscellaneous_amount, 2) }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Discount:</strong> -₹{{ number_format($purchase->discount_details, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Totals -->
    <div class="section-card">
        <div class="card-header">Payment Summary</div>
        <table class="table">
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td class="text-end">₹{{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Additional Charges:</strong></td>
                <td class="text-end">₹{{ number_format($additionalCharges, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Discount:</strong></td>
                <td class="text-end text-danger">-₹{{ number_format($purchase->discount_details, 2) }}</td>
            </tr>
            <tr class="table-primary">
                <td><strong>Total:</strong></td>
                <td class="text-end"><strong>₹{{ number_format($grandTotal, 2) }}</strong></td>
            </tr>
        </table>
    </div>

    <!-- Payment Details -->
    <div class="section-card">
        <div class="card-header">Payment Details</div>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Payment Type:</strong> {{ $purchase->purchaseOrderPayment->payment_type }}</p>
                @if ($purchase->payment_type == 'Credit')
                    <p><strong>Credit Terms:</strong> {{ $purchase->purchaseOrderPayment->credit_terms }} days</p>
                    <p><strong>Due Date:</strong> {{ $purchase->purchaseOrderPayment->due_date }}</p>
                @elseif ($purchase->payment_type == 'Half-payment')
                <p><strong>Partial Payment:</strong> ₹{{ number_format($purchase->purchaseOrderPayment->partial_payment_amount, 2) }}</p>
                    {{-- <p><strong>Partial Payment:</strong> ₹{{ number_format($purchase->purchaseOrderPayments->partial_payment_amount, 2) }}</p> --}}
                    <p><strong>Outstanding Payment:</strong> ₹{{ number_format($purchase->purchaseOrderPayment->outstanding_amount, 2) }}</p>
                @else
                    <p><strong>Payment Method:</strong> {{ ucfirst($purchase->purchaseOrderPayment->payment_method) }}</p>
                    <p><strong>Payment Date:</strong> {{ $purchase->purchaseOrderPayment->payment_date }}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><a href="#" class="btn btn-danger">Convert to Purchase</a></p>
            </div>
    </div>

</div>
@endsection
