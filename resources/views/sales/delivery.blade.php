@extends('layouts.master_template', ['title'=> 'Sales'])

@section('title', 'Sales')

@section('header')
<div class="pagetitle">
        <h1>Delivery</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/subadmin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Delivery</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h5>Assign Delivery for Sale #{{ $sale->so_order_number }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin-sales-assign-delivery', $sale->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="assign_to" class="form-label">Assign To (Delivery Boy)</label>
                <select name="assign_to" id="assign_to" class="form-control" required>
                    <option value="" selected disabled>Select a Delivery Boy</option>
                    @foreach($deliveryBoys as $deliveryBoy)
                        <option value="{{ $deliveryBoy->id }}">{{ $deliveryBoy->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign Delivery</button>
            <a href="{{ route('admin-sales') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
