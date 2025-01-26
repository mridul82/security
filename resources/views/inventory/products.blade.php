@extends('layouts.master_template', ['title'=> 'Inventory Products'])

@section('title', 'Inventory Products')
@section('header')
<div class="pagetitle">
    <h1>Inventory Products</h1>
    <nav>
        <ol class="breadcrumb
        ">
            <li class="breadcrumb
            -item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Inventory Products</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="row">
           
                <div class="col-md-4">
                    <div class="card-header">Add Product</div>
                    <div class="card-body">
                        <form action="{{ route('inventory.add-product') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="inventory_sub_category_id">Sub-Category</label>
                                <select name="inventory_sub_category_id" class="form-control" required>
                                    @foreach($categories as $category)
                                        @foreach($category->subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}">
                                                {{ $category->name }} - {{ $subCategory->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  mb-3">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="quantity">Initial Quantity</label>
                                <input type="number" name="quantity" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="type">Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="employee">Employee</option>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-header">Products</div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                @foreach($category->subCategories as $subCategory)
                                    @foreach($subCategory->products as $product)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $subCategory->name }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ ucfirst($product->type) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" 
                                                        data-bs-target="#issueStockModal{{ $product->id }}">
                                                    Issue Stock
                                                </button>
                                            </td>
                                        </tr>
        
                                        <!-- Issue Stock Modal -->
                                        <div class="modal fade" id="issueStockModal{{ $product->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Issue Stock: {{ $product->name }}</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('inventory.issue-stock') }}" method="POST">
                                                        @csrf
                                                        <input type="text" name="inventory_product_id" value="{{ $product->id }}">
                                                        <input type="text" name="issued_to_id" id="hidden_issued_to_id_{{ $product->id }}">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Quantity to Issue</label>
                                                                <input type="number" name="quantity" class="form-control" max="{{ $product->quantity }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Issue To</label>
                                                                <select name="issued_to_type" id="issued_to_type_{{ $product->id }}" 
                                                                        class="form-control issued_to_type" 
                                                                        data-product-id="{{ $product->id }}" 
                                                                        required>
                                                                    <option value="">-- Select Type --</option>
                                                                    <option value="employee">Employee</option>
                                                                    <option value="client">Client</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" id="issued_to_container_{{ $product->id }}">
                                                                <!-- Dynamic input field will be inserted here -->
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Issue Stock</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
   $(document).on('change', '.issued_to_type', function () {
    const productId = $(this).data('product-id');
    const selectedType = $(this).val();
    const container = $(`#issued_to_container_${productId}`);
    const hiddenInput = $(`#hidden_issued_to_id_${productId}`);
    
    if (selectedType === 'employee') {
        $.ajax({
            url: '/admin/employees/get-employees',
            method: 'GET',
            success: function (data) {
                let options = data.map(employee =>
                    `<option value="${employee.id}">${employee.name} (ID: ${employee.id})</option>`
                ).join('');
                container.html(`
                    <label>Select Employee</label>
                    <select class="form-control dynamic_issued_to_id" required>
                        <option value="">-- Select Employee --</option>
                        ${options}
                    </select>
                `);

                // Update the hidden input when the dynamic dropdown changes
                container.find('.dynamic_issued_to_id').on('change', function () {
                    hiddenInput.val($(this).val());
                });
            },
            error: function () {
                alert('Failed to fetch employee data.');
            }
        });
    } else if (selectedType === 'client') {
        $.ajax({
            url: '/admin/clients/get-clients',
            method: 'GET',
            success: function (data) {
                let options = data.map(client =>
                    `<option value="${client.id}">${client.business_name} (ID: ${client.id})</option>`
                ).join('');
                container.html(`
                    <label>Select Client</label>
                    <select class="form-control dynamic_issued_to_id" required>
                        <option value="">-- Select Client --</option>
                        ${options}
                    </select>
                `);

                // Update the hidden input when the dynamic dropdown changes
                container.find('.dynamic_issued_to_id').on('change', function () {
                    hiddenInput.val($(this).val());
                });
            },
            error: function () {
                alert('Failed to fetch client data.');
            }
        });
    } else {
        container.html('');
        hiddenInput.val(''); // Reset hidden input if no type selected
    }
});

</script>

<script>
    $('form').on('submit', function () {
    console.log($(this).serializeArray()); // Inspect all form data
});
</script>
@endpush
                    