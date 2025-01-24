@extends('layouts.sub_admin_template', ['title'=> 'Damage'])

@section('title', 'Damage')

@section('header')
<div class="pagetitle">
    <h1>Damage</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/subadmin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Damage</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Damaged Products at {{ $branch->name }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th>Total Quantity</th>
                        <th>Damaged Quantity</th>
                        <th>Damage Type</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($damagedStocks as $stock)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $stock->product->name }}</td>
                            <td>{{ $stock->supplier->company_name ?? 'N/A' }}</td>
                            <td>{{ number_format($stock->quantity, 2) }}</td>
                            <td>{{ number_format($stock->damaged_quantity, 2) }}</td>
                            <td>{{ $stock->damage_type ?? 'N/A' }}</td>
                            <td>{{ $stock->notes ?? 'No Notes' }}</td>
                            <td>
                                <!-- Action buttons -->
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editDamageModal-{{ $stock->id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Damage Modal -->
                        <div class="modal fade" id="editDamageModal-{{ $stock->id }}" tabindex="-1" aria-labelledby="editDamageModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('sub-admin-damages-update', $stock->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDamageModalLabel">Edit Damage - {{ $stock->product->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="damage_quantity">Damage Quantity</label>
                                                <input type="number" name="damage_quantity" id="damage_quantity" class="form-control" value="{{ $stock->damaged_quantity }}" min="1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="notes">Notes</label>
                                                <textarea name="notes" id="notes" class="form-control">{{ $stock->notes }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
