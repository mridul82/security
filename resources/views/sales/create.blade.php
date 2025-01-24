<!-- resources/views/sales/create.blade.php -->
@extends('layouts.master_template', ['title'=> 'Sales'])
<style>
    .section-card {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
    }
    .product-row {
        background-color: #f8f9fa;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
</style>
@section('title', 'Create Sale')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@section('header')
<div class="pagetitle">
    <h1>Create Sale</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Create Sale</li>
      </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Create Sale</div>
        <div class="card-body">
            <form id="saleForm" method="POST" action="{{ route('admin-sales-store') }}">
                @csrf
                @include('sales.sale_order_form')

                <button type="submit" class="btn btn-primary">Create Sale</button>
            </form>
        </div>

       @include('sales.product_row_template')
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        //make curom selling price input text
        $(document).on('change', '#is_custom', function () {
                const isChecked = $(this).is(':checked');
                const container = $(this).closest('.form-group').find('.selling-price-container');

                if (isChecked) {
                    $("#is_custom").val('1');
                    console.log("Changing to input text");
                    container.html('<input type="text" class="form-control selling-price" name="selling_prices[]" placeholder="Enter Selling Price" required>');
                } else {
                    $("#is_custom").val('0');
                    console.log("Reverting to select dropdown");
                    container.html(`
                        <select class="form-control selling-price" name="selling_prices[]" required>
                            <option value="">Select Selling Price</option>
                        </select>
                    `);
                }
            });


        //calculate gift product
        $(document).on('change', '#is_gift', function () {
            const isChecked = $(this).is(':checked');
            const row = $(this).closest('.product-row');

            if (isChecked) {
                console.log("Gift selected - clearing total and moving calculated gift product value");

                // Clear total input
                row.find('.total-price').val(0.00);

                // Retrieve cost price and quantity
                const costPrice = parseFloat(row.find('.cost-price').val()) || 0; // Cost Price
                const quantity = parseInt(row.find('.quantity').val()) || 0; // Quantity

                // Calculate total for gift product
                const giftTotal = costPrice * quantity;

                // Populate the gift product input with the calculated value
                row.find('.gift-product').val(giftTotal);
                $('#is_gift').val('1');
            } else {
                console.log("Gift unselected - clearing gift product field");
                // Clear the gift product input if unchecked
                row.find('.gift-product').val('');
                $('#is_gift').val('0');
            }
        });

        $(document).on('input', '.quantity, .cost-price', function () {
            // Auto-recalculate gift product value if "Gift" is checked when quantity or cost price changes
            const row = $(this).closest('.product-row');
            const isGiftChecked = row.find('#is_gift').is(':checked');

            if (isGiftChecked) {
                const costPrice = parseFloat(row.find('.cost-price').val()) || 0;
                const quantity = parseInt(row.find('.quantity').val()) || 0;

                // Calculate gift total
                const giftTotal = costPrice * quantity;

                // Update gift product field
                row.find('.gift-product').val(giftTotal);
            }
        });


        // Add product row
        $('#addProduct').click(function() {
            const template = document.querySelector('#product-row-template');
            const clone = template.content.cloneNode(true);
            $('#products-container').append(clone);
            $('.product-select').select2();
            calculateTotals();
        });

        // Remove product row
        $(document).on('click', '.remove-product', function() {
            $(this).closest('.product-row').remove();
            calculateTotals();
        });

         // Fetch cost and selling prices on product change
         $(document).on('change', '.product-select', function () {
            const productId = $(this).val();
            const row = $(this).closest('.product-row');
            const costPriceSelect = row.find('.cost-price');
            const sellingPriceSelect = row.find('.selling-price');

            if (productId) {
                $.ajax({
                    url: '/admin/fetch-product-prices/' + productId, // Route to fetch data
                    method: 'GET',
                    success: function (response) {
                        console.log('Fetched data:', response);
                // Ensure currentStocks is an array
                const currentStocks = Array.isArray(response.currentStocks)
                    ? response.currentStocks
                    : Object.values(response.currentStocks);

                // Populate cost price dropdown
                costPriceSelect.empty().append('<option value="">Select Cost Price</option>');

                // Safety check before using forEach
                if (currentStocks && currentStocks.length > 0) {
                    currentStocks.forEach(stock => {
                        costPriceSelect.append(
                            `<option value="${stock.cost_price}"
                                    data-current-stock="${stock.current_stock}">
                                ${stock.cost_price} (Stock: ${stock.current_stock})
                            </option>`
                        );
                    });
                }else {
                    console.log('No current stocks available for this product');
                    costPriceSelect.append('<option value="">No stock available</option>');
                }
                // Populate selling price dropdown (similar safeguards)
                sellingPriceSelect.empty().append('<option value="">Select Selling Price</option>');
                if (response.sellingPrices && response.sellingPrices.length > 0) {
                    response.sellingPrices.forEach(price => {
                        sellingPriceSelect.append(`<option value="${price}">${price}</option>`);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching product prices:', error);
                alert('Error fetching product details. Please try again.');
            }
        });

            } else {
                costPriceSelect.empty().append('<option value="">Select Cost Price</option>');
                sellingPriceSelect.empty().append('<option value="">Select Selling Price</option>');
            }
        });

        // Calculate row total
        $(document).on('input', '.quantity, .unit-price', '.selling-price', function() {
            const row = $(this).closest('.product-row');

            const costPriceSelect = row.find('.cost-price');
            const selectedOption = costPriceSelect.find('option:selected');
            const availableStock = parseInt(selectedOption.data('current-stock')) || 0;
            const requestedQuantity = parseInt($(this).val()) || 0;

            if (requestedQuantity > availableStock) {
                alert(`Insufficient stock. Available stock is ${availableStock}`);
                $(this).val(availableStock); // Automatically adjust to max available
            }

            calculateRowTotal(row);

        });

        $(document).on('input', '#deliveryCharges, #codCharges, #discountAmount', function() {
            calculateTotals();
        })

        function calculateRowTotal(row) {
            const quantity = parseFloat(row.find('.quantity').val()) || 0;
            const unitSellingPrice = parseFloat(row.find('.selling-price').val()) || 0;
            const total = quantity * unitSellingPrice;
            row.find('.total-price').val(total.toFixed(2));
        }

        function calculateTotals() {
            let subtotal = 0;

            $('.total-price').each(function() {
                subtotal += parseFloat($(this).val()) || 0;
            });

            // Fetch additional charges and discount values
            const deliveryCharges = parseFloat($('#deliveryCharges').val()) || 0;
            const codCharges = parseFloat($('#codCharges').val()) || 0;
            const discount = parseFloat($('#discountAmount').val()) || 0;

            console.log(deliveryCharges, codCharges, discount);

            // Calculate additional charges and grand total
            const additionalCharges = deliveryCharges + codCharges - discount;
            const grandTotal = subtotal + additionalCharges;


            $('#subtotal').text(subtotal.toFixed(2));
            $('#totalCharges').text(additionalCharges.toFixed(2));
            $('#grandTotal').text(grandTotal.toFixed(2));
        }

        // Initialize
        $('#addProduct').click();
    });


</script>
@endpush
