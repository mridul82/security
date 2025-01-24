@extends('layouts.sub_admin_template', ['title'=> 'Sales'])

@section('title', 'Sales')

@section('header')
<div class="pagetitle">
    <h1>Sales</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/subadmin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Sales</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Sales Orders</h5>
        <a href="{{ route('sub-admin-sales-create') }}" class="btn btn-primary float-end">Create New Sale</a>
    </div>
    <div class="card-body">
      <table class="table table-bordered dataTable">
        <thead>
            <tr>
                <th>Sale Order Number</th>
                <th>Branch</th>
                <th>Sale Date</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Total Amount</th>
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($sales as $sale)
          <tr>
              <td>{{ $sale->so_order_number }}</td>
              <td>{{ $sale->branchSale->branch->name ?? 'N/A' }}</td>
              <td>{{ $sale->sale_date }}</td>
              <td>{{ $sale->customer_name }}</td>
              <td>{{ $sale->customer_contact }}</td>
            
              <td>{{ $sale->salesPayment->total_payment ?? 'N/A' }}</td>
            <td><a href="{{route('sub-admin-sales-show', $sale->id)}}" class="btn btn-info btn-sm">View</a></td>
              <!-- Add more columns as needed -->
          </tr>
      @endforeach
        </tbody>
    </table>

    
    </div>
</div>
@endsection
