@extends('layouts.sub_admin_template', ['title'=> 'Inventory'])

@section('title', 'Inventory')

@section('header')
<div class="pagetitle">
    <h1>Inventory for {{ $branch->name }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Inventory</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Inventory for {{ $branch->name }}</h5>
            <div class="mb-3">
                <button id="refreshStock" class="btn btn-primary">Refresh Stock</button>
            </div>
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>StockID</th>
                        <th>Product</th>
                        <th>Supplier</th>
                        <th>Total Quantity</th>
                        <th>Current Stock</th>
                        <th>Damaged Quantity</th>
                        <th>Unit Cost Price</th>
                        <th>Total Cost Price</th>
                        <th>Total Selling Price</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedStocks as $group)
                        <tr>

                            <td>{{ $group['stock_id'] }}</td>
                            <td>{{ $group['product']->name }}</td>
                            <td>{{ $group['supplier']->company_name }}</td>
                            <td>{{ $group['total_quantity'] }}</td>
                            <td>{{ $group['remaining_quantity'] }}</td>
                            <td>{{ $group['total_damaged_quantity'] }}</td>
                            <td></td>
                            <td>{{ number_format($group['total_cost_price'], 2) }}</td>
                            <td>{{ number_format($group['total_selling_price'], 2) }}</td>
                            <td>

                                <button type="button" class="btn btn-danger record-damage"
                                        data-bs-stock-id="{{ $group['stock_id'] }}"
                                        data-bs-product-name="{{ $group['product']->name }}"
                                        data-bs-toggle="modal" data-bs-target="#damageModal"

                                        >
                                    Record Damage
                                </button>
                                <!-- Damage Modal (moved outside the loop) -->
<div class="modal fade" id="damageModal" tabindex="-1" role="dialog" aria-labelledby="damageModalLabel" aria-hidden="true"
data-bs-backdrop="static"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="damageModalLabel">Record Damage</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="damageForm" action="{{ route('branch-damage-store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="stock_id" id="stock_id"  value="">
                    <div class="form-group mb-3">
                        <label for="damage_quantity">Damage Quantity</label>
                        <input type="number" class="form-control" id="damage_quantity" name="damage_quantity" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="damage_type" class="form-label">Damage Type</label>
                        <select class="form-control" name="damage_type" required>
                            <option value="returnable">Returnable</option>
                            <option value="non-returnable">Non-Returnable</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="damage_description">Description (Optional)</label>
                        <textarea class="form-control" id="damage_description" name="damage_description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Record Damage</button>
                </div>
            </form>
        </div>
    </div>
</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@push('script')
<script>
     $("#refreshStock").click(function() {
        $.ajax({
            url: '{{ route("branch-inventory-refresh") }}',
            method: 'POST',
            data: {_token: '{{ csrf_token() }}'},
            success: function(response) {
                if (response.success) {
                    alert('Stock updated successfully.');
                    location.reload(); // Refresh the page
                } else {
                    alert('Failed to refresh stock.');
                }
            }
        });
    });

    
    $(".record-damage").click(function() {
        var stockId = $(this).data("bs-stock-id");
        var productName = $(this).data("bs-product-name");
        $("#stock_id").val(stockId);
        $("#damageModalLabel").text("Record Damage for " + productName);

    });
   </script>
@endpush
