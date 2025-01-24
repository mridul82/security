@extends('layouts.master_template', ['title'=> 'Purchase'])

@section('title', 'Create Purchase')
@section('header')
<div class="pagetitle">
    <h1>Create Purchase</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Create Purchase</li>
      </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Create Purchase</div>
        <div class="card-body">



            <form action="{{ route('admin-purchase-store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <!-- Product Type -->
                    <div class="col-md-4">
                        <label for="product_type" class="form-label">Product Type</label>
                        <select name="product_type" id="product_type" class="form-select" required onchange="fetchProducts(this.value)">
                            <option value="">Select Product Type</option>
                            <option value="book">Book</option>
                            <option value="instrument">Instrument</option>
                        </select>
                    </div>

                    <!-- Product -->
                    <div class="col-md-4">
                        <label for="product_id" class="form-label">Product</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">Select Product</option>
                        </select>
                    </div>

                    <!-- Supplier -->
                    <div class="col-md-4">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-select" required>
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- PO Number -->
                    <div class="col-md-4">
                        <label for="po_number" class="form-label">PO Number</label>
                        <input type="text" name="po_number" id="po_number" class="form-control" required>
                    </div>

                    <!-- Date -->
                    <div class="col-md-4">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>

                    <!-- Payment Type -->
                    <div class="col-md-4">
                        <label for="payment_type" class="form-label">Payment Type</label>
                        <select name="payment_type" id="payment_type" class="form-select" required>
                            <option value="Credit">Credit</option>
                            <option value="Half-payment">Half-payment</option>
                            <option value="Full-payment">Full-payment</option>
                        </select>
                    </div>

                    <!-- Tax Type -->
                    <div class="col-md-4">
                        <label for="tax_type" class="form-label">Tax Type</label>
                        <input type="text" name="tax_type" id="tax_type" class="form-control">
                    </div>

                    <!-- Tax Amount -->
                    <div class="col-md-4">
                        <label for="tax_amount" class="form-label">Tax Amount</label>
                        <input type="number" step="0.01" name="tax_amount" id="tax_amount" class="form-control">
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>

                    <!-- Unit Price -->
                    <div class="col-md-4">
                        <label for="unit_price" class="form-label">Unit Price</label>
                        <input type="number" step="0.01" name="unit_price" id="unit_price" class="form-control" required>
                    </div>

                    <!-- Total Price -->
                    <div class="col-md-4">
                        <label for="total_price" class="form-label">Total Price</label>
                        <input type="number" step="0.01" name="total_price" id="total_price" class="form-control" readonly>
                    </div>

                    <!-- Miscellaneous Amount -->
                    <div class="col-md-4">
                        <label for="miscellaneous_amount" class="form-label">Miscellaneous Amount</label>
                        <input type="number" step="0.01" name="miscellaneous_amount" id="miscellaneous_amount" class="form-control">
                    </div>

                    <!-- Transport Amount -->
                    <div class="col-md-4">
                        <label for="transport_amount" class="form-label">Transport Amount</label>
                        <input type="number" step="0.01" name="transport_amount" id="transport_amount" class="form-control">
                    </div>

                    <!-- PO Creator/Approver -->
                    <div class="col-md-4">
                        <label for="po_creator" class="form-label">PO Creator/Approver</label>
                        <input type="text" name="po_creator" id="po_creator" class="form-control" required>
                    </div>

                    <!-- Discount -->
                    <div class="col-md-4">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" step="0.01" name="discount" id="discount" class="form-control">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>


</div>
    </div>
</div>

@endsection

@push('script')
<script type="text/javascript">


function fetchProducts(productType) {
    var productIdSelect = document.getElementById('product_id');

    // Clear existing options
    productIdSelect.innerHTML = '<option value="">Select Product</option>';

    // Fetch products based on the selected type
    fetch('/admin/get-products/' + productType)
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data)) { // Ensure data is an array
                data.forEach(product => {
                    var option = document.createElement('option');
                    option.value = product.id;
                    option.textContent = product.name;
                    productIdSelect.appendChild(option);
                });
            } else {
                console.error('Unexpected response:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching products:', error);
        });
};

document.getElementById('quantity').addEventListener('input', calculateTotal);
document.getElementById('unit_price').addEventListener('input', calculateTotal);

function calculateTotal() {
    const quantity = parseFloat(document.getElementById('quantity').value) || 0;
    const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
    document.getElementById('total_price').value = (quantity * unitPrice).toFixed(2);
}


</script>



@endpush
