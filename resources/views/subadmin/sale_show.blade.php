@extends('layouts.sub_admin_template', ['title' => 'Branch Sale Details'])

@section('title', 'Branch Sale Details')

@section('header')
<div class="pagetitle">
    <h1>Branch Sale Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sub-admin-sales') }}">Branch Sales Orders</a></li>
            <li class="breadcrumb-item active">Branch Sale Details</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5>Branch Sale Details</h5>
        </div>
        <div class="card-body">
            <!-- Sale Information Section -->
            <div class="section-card">
                <h4>General Information</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Order Number</th>
                        <td>{{ $sale->so_order_number }}</td>
                    </tr>
                    <tr>
                        <th>Sale Date</th>
                        <td>{{ $sale->sale_date }}</td>
                    </tr>
                    <tr>
                        <th>Branch</th>
                        <td>{{ $sale->branchSale->branch->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ ucfirst($sale->salesPayment->payment_method) }}</td>
                    </tr>
                </table>
            </div>

            <!-- Customer Information Section -->
            <div class="section-card">
                <h4>Customer Information</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $sale->customer_name }}</td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td>{{ $sale->customer_contact }}</td>
                    </tr>
                </table>
            </div>

            <!-- Billing Information Section -->
            <div class="section-card">
                <h4>Billing Information</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Billing Name</th>
                        <td>{{ $sale->billing_name }}</td>
                    </tr>
                    <tr>
                        <th>Billing Address</th>
                        <td>{{ $sale->billing_address }}</td>
                    </tr>
                    <tr>
                        <th>Billing Contact</th>
                        <td>{{ $sale->billing_contact }}</td>
                    </tr>
                </table>
            </div>

            <!-- Products Section -->
            <div class="section-card">
                <h4>Products</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Selling Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if ($product->is_free_gift)
                                        Free Gift
                                    @else
                                        {{ number_format($product->unit_sale_price, 2) }}
                                    @endif
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if ($product->is_free_gift)
                                        Free Gift
                                    @else
                                        {{ number_format($product->unit_sale_price * $product->quantity, 2) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Additional Charges Section -->
            <div class="section-card">
                <h4>Additional Charges</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Delivery Charges</th>
                        <td>{{ number_format($sale->delivery->delivery_charge, 2) }}</td>
                    </tr>
                    <tr>
                        <th>COD Charges</th>
                        <td>{{ number_format($sale->salesPayment->cod_charge, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>{{ number_format($sale->salesPayment->discount, 2) }}</td>
                    </tr>
                </table>
            </div>

            <!-- Total Section -->
            <div class="section-card">
                <h4>Total</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Subtotal</th>
                        <td>{{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Additional Charges</th>
                        <td>{{ number_format($additionalCharges, 2) }}</td>
                    </tr>
                    <tr class="table-primary">
                        <th>Grand Total</th>
                        <td><strong>{{ number_format($grandTotal, 2) }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
