@extends('layouts.master_template', ['title'=> 'Delivery'])

@section('title', 'Delivery')

@section('header')
<div class="pagetitle">
    <h1>Delivery</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Delivery</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Delivery Orders</h5>

    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sale Order</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Delivery Type</th>
                    <th>Delivery Boy</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deliveries as $delivery)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $delivery->sale->so_order_number ?? 'N/A' }}</td>
                        <td>{{ $delivery->sale->customer_name ?? 'N/A' }}</td>
                        <td>{{ $delivery->sale->billing_address ?? 'N/A' }}</td>
                        <td>{{ ucfirst($delivery->delivery_type) }}</td>
                        <td>{{ $delivery->deliveryBoy->name ?? 'Unassigned' }}</td>
                        <td>{{ ucfirst($delivery->delivery_status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No deliveries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
