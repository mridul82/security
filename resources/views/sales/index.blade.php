@extends('layouts.master_template', ['title'=> 'Sales'])

@section('title', 'Sales')

@section('header')
<div class="pagetitle">
        <h1>Sales</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Sales</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Sales Orders</h5>
        <a href="{{ route('admin-sales-create') }}" class="btn btn-primary float-end">Create New Sale</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order Number</th>
                    <th>Sale Date</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sale->so_order_number }}</td>
                        <td>{{ $sale->sale_date }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ number_format($sale->total_amount, 2) }}</td>
                        <td>{{ ucfirst($sale->payment_method) }}</td>
                        <td>
                            <a href="{{ route('admin-sales-show', $sale->id) }}" class="btn btn-sm btn-info">View</a>
                            {{-- <a href="{{ route('admin-sales-edit', $sale->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin-sales-delete', $sale->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this sale?')">Delete</button>
                            </form> --}}
                            {{-- <a href="{{ route('admin-sales-delivery', $sale->id) }}" class="btn btn-sm btn-warning">Assign Delivery</a> --}}
                            <a href="javascript:void(0)"
                                class="btn btn-sm btn-warning assign-delivery-btn"
                                data-sale-id="{{ $sale->id }}"
                                data-sale-amount="{{ number_format($sale->total_amount, 2) }}"
                                data-bs-toggle="modal"
                                data-bs-target="#assignDeliveryModal"
                                id="assignDeliveryBtn{{ $sale->id }}"
                                >
                                Assign Delivery
                                </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No sales orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>


<!-- Assign Delivery Modal -->
<!-- Assign Delivery Modal -->
<div class="modal fade" id="assignDeliveryModal" tabindex="-1" aria-labelledby="assignDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin-sales-assign-delivery') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="assignDeliveryModalLabel">Assign Delivery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Sale ID -->
                    <input type="text" name="sale_id" id="modal-sale-id" class="form-control"  readonly>

                    <!-- Sale Amount (readonly) -->
                    <div class="mb-3">
                        <label for="modal_sale_amount" class="form-label">Sale Amount</label>
                        <input type="text" id="modal-sale-amount" class="form-control" name="sale_amount" readonly>
                    </div>

                    <!-- Assign To (Dropdown) -->
                    <div class="mb-3">
                        <label for="modal_assign_to" class="form-label">Assign To</label>
                        <select name="assign_to" id="modal_assign_to" class="form-control" required>
                            <option value="" selected disabled>Select Delivery Boy</option>
                            @foreach($deliveryBoys as $deliveryBoy)
                                <option value="{{ $deliveryBoy->id }}">{{ $deliveryBoy->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Delivery Charge -->
                    {{-- <div class="mb-3">
                        <label for="modal_delivery_charge" class="form-label">Delivery Charge</label>
                        <input type="number" name="delivery_charge" id="modal_delivery_charge" class="form-control" min="0" step="0.01">
                    </div> --}}

                    <!-- Delivery Type -->
                    <div class="mb-3">
                        <label for="modal_delivery_type" class="form-label">Delivery Type</label>
                        <input type="text" name="delivery_type" id="modal_delivery_type" class="form-control" placeholder="e.g., courier, pickup">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endSection

@push('script')
<script>
    $(document).ready(function () {
    // Click event for Assign Delivery buttons
    $('.assign-delivery-btn').on('click', function () {
        // Get the sale ID from the button
        var saleId = $(this).data('sale-id');
        console.log(saleId);
        console.log($('#modal-sale-id'));
        console.log("hi")

        // Clear previous modal inputs
        $('#modal-sale-id').val('');
        $('#modal-sale-amount').val('');
        $('#modal-assign-to').val('');
        $('#modal-delivery-charge').val('');
        $('#modal-delivery-type').val('');

        // Set the sale ID in the hidden input
        $('#modal-sale-id').val(saleId);
        $('#modal-sale-amount').val($(this).data('sale-amount'));

        console.log(saleId);
        console.log($(this).data('sale-amount'));

        // Fetch sale details using AJAX
        $.ajax({
            url: '/admin/sales/' + saleId + '/details',
            method: 'GET',
            success: function (response) {
                if (response.success) {
                    console.log(response.sale);
                    // Populate the sale amount
                    $('#modal-sale-amount').val(response.sale.sales_payment.total_payment);
                } else {
                    alert('Failed to fetch sale details.');
                }
            },
            error: function () {
                alert('An error occurred while fetching sale details.');
            }
        });

        // Show the modal
        $('#assignDeliveryModal').modal('show');
    });
});

</script>
@endpush
