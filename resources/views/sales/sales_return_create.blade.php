@extends('layouts.master_template', ['title'=> 'Create Sales Return'])

@section('title', 'Create Sales Return')

@section('header')
<div class="pagetitle">
    <h1>Create Sales Return</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Create Sales Return</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Sales Return</h5>
        <form method="POST" action="{{ route('admin-sales-returns-store') }}">
            @csrf
            <div class="row mb-3">
            <div class=" col-md-6">
                <label for="sale_id" class="form-label">Sale Order</label>
                <select name="sale_id" id="sale_id" class="form-control">
                    <!-- Populate sale orders -->
                        <option value="">Select Sale Order</option>
                    @foreach($saleOrders as $sale)
                        <option value="{{ $sale->id }}">{{ $sale->so_order_number }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-md-6 col-md-6">
                <label for="product_id" class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-control">
                    <!-- Populate products -->
                    <option value="">Select Product</option>
                </select>
            </div>
            </div>
            <div class="row mb-3">
            <div class="col-md-6">
                <label for="branch_id" class="form-label">Branch</label>
                <select name="branch_id" id="branch_id" class="form-control">
                    <!-- Populate branches -->
                    <option value="">Select Branch</option>
                    @foreach($branches as $branch)

                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" step="0.01">
            </div>
            </div>
            <div class="row mb-3">
            <div class="mb-3 col-md-6">
                <label for="return_amount" class="form-label">Return Amount</label>
                <input type="number" name="return_amount" id="return_amount" class="form-control" step="0.01">
            </div>
            <div class="mb-3 col-md-6">
                <label for="reason" class="form-label">Reason</label>
                <textarea name="reason" id="reason" class="form-control"></textarea>
            </div>
            </div>
            <div class="row">
            <div class="mb-3 ">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control"></textarea>
            </div>
            </div>
            <button type="submit" class="btn btn-primary">Record Return</button>
        </form>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    // Populate product dropdown based on selected sale order
    $(document).ready(function () {
        $('#sale_id').on('change', function () {
            const saleId = $(this).val();

            // Clear the product dropdown if no sale is selected
            if (!saleId) {
                $('#product_id').html('<option value="">Select Product</option>');
                return;
            }

            // Fetch products via AJAX
            $.ajax({
                url: "{{ route('admin-sales-return-products') }}",
                type: "GET",
                data: { sale_id: saleId },
                success: function (response) {
                    let options = '<option value="">Select Product</option>';
                    response.forEach(product => {
                        options += `<option value="${product.product_id}">${product.product.name}</option>`;
                    });
                    $('#product_id').html(options);
                },
                error: function () {
                    alert('Error fetching products for the selected sale.');
                }
            });
        });
    });
</script>
@endpush
