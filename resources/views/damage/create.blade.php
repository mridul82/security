@extends('layouts.master_template', ['title'=> 'Damage'])

@section('title', 'Damage')

@section('header')
<div class="pagetitle">
    <h1>Damage</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Damage</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Add Damage</h5>
        <form action="{{ route('admin-damage-store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="stock_id">Stock Item</label>
                <select name="stock_id" id="stock_id" class="form-control" required>

                    <option value="{{ $stock->id }}" selected disabled>
                        {{ $stock->product->name }} (Stock: {{ $stock->quantity }})
                    </option>

                </select>
            </div>

            <div class="form-group mb-3">
                <label for="damage_type">Damage Type</label>
                <select name="damage_type" id="damage_type" class="form-control" required>
                    <option value="returnable">Returnable</option>
                    <option value="non-returnable">Non-Returnable</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="damage_quantity">Damage Quantity</label>
                <input type="number" name="damage_quantity" id="damage_quantity" class="form-control" step="0.01" required>
            </div>

            <div class="form-group mb-3">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin-damages') }}" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
</div>

@endsection
