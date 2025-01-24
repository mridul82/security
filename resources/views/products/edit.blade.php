@extends('layouts.master_template', ['title'=> 'Products'])

@section('title', 'Edit Product')
@section('header')
<div class="pagetitle">
    <h1>Edit Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Edit Product</li>
      </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Edit Product</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin-product-update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $product->name ?? '') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control" required>
                            <option value="book" {{ old('type', $product->type ?? '') == 'book' ? 'selected' : '' }}>Book</option>
                            <option value="instrument" {{ old('type', $product->type ?? '') == 'instrument' ? 'selected' : '' }}>Instrument</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="author" value="{{ old('author', $product->author ?? '') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" class="form-control" name="publisher" value="{{ old('publisher', $product->publisher ?? '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" name="isbn" value="{{ old('isbn', $product->isbn ?? '') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="manufacturer">Manufacturer</label>
                        <input type="text" class="form-control" name="manufacturer" value="{{ old('manufacturer', $product->manufacturer ?? '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="marketer">Marketer</label>
                        <input type="text" class="form-control" name="marketer" value="{{ old('marketer', $product->marketer ?? '') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="hsn_code">HSN Code</label>
                        <input type="text" class="form-control" name="hsn_code" value="{{ old('hsn_code', $product->hsn_code ?? '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control" name="semester" value="{{ old('semester', $product->semester ?? '') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" name="year" value="{{ old('year', $product->year ?? '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" name="notes">{{ old('notes', $product->notes ?? '') }}</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="cost_price">Cost Price</label>
                        <input type="number" step="0.01" class="form-control" name="cost_price" value="{{ old('cost_price', $product->cost_price ?? '') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" step="0.01" class="form-control" name="selling_price" value="{{ old('selling_price', $product->selling_price ?? '') }}" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
