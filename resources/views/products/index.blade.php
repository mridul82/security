@extends('layouts.master_template', ['title'=> 'Products'])

@section('title', 'Products')
@section('header')
<div class="pagetitle">
    <h1>Products</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
      </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <a href="{{ route('admin-product-create') }}" class="btn btn-primary" style="margin-bottom: 10px; margin-left: 15px">
        <i class="bi bi-plus-circle"></i> Add Product
    </a>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <table class="table table-borderless datatable table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>HSN Code</th>
                                
                                <th>MRP</th>
                                <th>Selling Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->type }}</td>
                                <td>{{ $product->hsn_code }}</td>
                               
                                <td>{{ $product->mrp }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>
                                    <a href="{{ route('admin-product-edit', $product->id) }}" class="text-primary me-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin-product-destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if (count($products) == 0)
                            <tr>
                                <td colspan="8" class="text-center">No products found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
