<!-- resources/views/purchase-orders/create.blade.php -->
@extends('layouts.master_template', ['title'=> 'Purchase'])
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
@section('title', 'Create Purchase')
@if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
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

        <form id="poForm" method="POST" action="{{ route('admin-purchase-store') }}">
            @csrf

            <!-- Supplier and PO Details Section -->
            <div class="section-card">
                <h4>Basic Details</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>PO Number</label>
                            <input type="text" class="form-control" name="po_number" required readonly value="{{ $poNumber }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Purchase Date</label>
                            <input type="date" class="form-control" name="purchase_date" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select class="form-control supplier-select" name="supplier_id" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->company_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Billing Details Section -->
            <div class="section-card">
                <h4>Billing Details</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Billing Name</label>
                            <input type="text" class="form-control" name="billing_name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Billing Contact</label>
                            <input type="text" class="form-control" name="billing_contact">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment Type</label>
                            <select class="form-control" name="payment_type" required>
                                <option value="Credit">Credit</option>
                                <option value="Half-payment">Half Payment</option>
                                <option value="Full-payment">Full Payment</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label>Billing Address</label>
                            <textarea class="form-control" name="billing_address" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="section-card">
                <h4>Products</h4>
                <div id="products-container">
                    <!-- Product rows will be added here -->
                </div>
                <button type="button" class="btn btn-success" id="addProduct">Add Product</button>
            </div>

            <!-- Additional Charges Section -->
            <div class="section-card">
                <h4>Additional Charges</h4>
                <div class="row">
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Tax Type</label>
                            <input type="text" class="form-control" name="tax_type">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tax Amount</label>
                            <input type="number" step="0.01" class="form-control charges" name="tax_amount" id="taxAmount" value="0.00">
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Transport Amount</label>
                            <input type="number" step="0.01" class="form-control charges" name="transport_amount" id="transportAmount" value="0.00">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Miscellaneous Amount</label>
                            <input type="number" step="0.01" class="form-control charges" name="miscellaneous_amount" id="miscAmount" value="0.00">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Discount Details</label>

                            <input type="number" step="0.01" class="form-control charges" name="discount_details" id="discountAmount" value="0.00">

                        </div>
                    </div>
                </div>
            </div>



           <!-- Payment Section -->
           <div class="section-card">
            <h4>Payment Details</h4>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select class="form-control" name="payment_type" id="paymentType" required>
                            <option value="Credit">Credit</option>
                            <option value="Half-payment">Half Payment</option>
                            <option value="Full-payment">Full Payment</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Credit Payment Details -->
            <div class="payment-details credit-details">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Credit Terms (Days)</label>
                            <input type="number" class="form-control" name="credit_terms" id="creditTerms">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Due Date</label>
                            <input type="date" class="form-control" name="due_date" id="dueDate">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Partial Payment Details -->
            <div class="payment-details partial-payment-details">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment Amount</label>
                            <input type="number" step="0.01" class="form-control" name="partial_payment_amount" id="partialPaymentAmount">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment Date</label>
                            <input type="date" class="form-control" name="payment_date" id="partialPaymentDate">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-control" name="payment_method">
                                <option value="cash">Cash</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Full Payment Details -->
            <div class="payment-details full-payment-details">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-control" name="full_payment_method">
                                <option value="cash">Cash</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment Date</label>
                            <input type="date" class="form-control" name="full_payment_date">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Updated Totals Section -->
        <div class="section-card">
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <table class="table">
                        <tr>
                            <td><strong>Subtotal:</strong></td>
                            <td class="text-end"><span id="subtotal">0.00</span></td>
                        </tr>
                        <tr>
                            <td><strong>Additional Charges:</strong></td>
                            <td class="text-end"><span id="totalCharges">0.00</span></td>
                        </tr>
                        <tr>
                            <td><strong>Discount:</strong></td>
                            <td class="text-end text-danger">-<span id="discountDisplay">0.00</span></td>
                        </tr>
                        <tr class="table-primary">
                            <td><strong>Bill Total:</strong></td>
                            <td class="text-end"><strong><span id="grandTotal">0.00</span></strong></td>
                        </tr>
                        <tr id="paidAmountRow" class="d-none">
                            <td><strong>Paid Amount:</strong></td>
                            <td class="text-end text-success"><strong><span id="paidAmount">0.00</span></strong></td>
                        </tr>
                        <tr id="outstandingRow" class="d-none table-warning">
                            <td><strong>Outstanding Amount:</strong></td>
                            <td class="text-end"><strong><span id="outstandingAmount">0.00</span></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

            <button type="submit" class="btn btn-primary">Create Purchase Order</button>
        </form>
    </div>


    <!-- Product Row Template -->
    <template id="product-row-template">
        <div class="product-row">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Product</label>
                        <select class="form-control product-select" name="products[]" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control quantity" name="quantities[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Unit Price</label>
                        <input type="number" step="0.01" class="form-control unit-price" name="unit_prices[]" required>
                    </div>
                </div>
            {{-- newly added --}}
            <div class="col-md-1">
                <div class="form-group">
                    <label>GST (%)</label>
                    <input type="text" class="form-control gst-percentage" name="gst_percentages[]" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>GST Amount</label>
                    <input type="number" step="0.01" class="form-control gst-amount" name="gst_amounts[]" readonly>
                </div>
            </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Total</label>
                        <input type="number" step="0.01" class="form-control total-price" name="total_prices[]" readonly>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-danger remove-product">×</button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
    @endsection
   @push('script')

   <script type="text/javascript">




        $(document).ready(function() {
            // Initialize Select2 for dropdowns
            $('.supplier-select').select2();

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


            // Fetch GST rate when a product is selected (newly added)
        $(document).on('change', '.product-select', function() {
            const row = $(this).closest('.product-row');
            const productId = $(this).val();

            if (productId) {
                $.ajax({
                    url: `/admin/products/gst/${productId}`, // Assuming a route to fetch GST
                    type: 'GET',
                    success: function(response) {
                        const gstRate = response.gst_rate || 0;
                        row.find('.gst-percentage').val(gstRate + '%');
                        row.find('.quantity').data('gst-rate', gstRate);
                        calculateRowTotal(row);
                        calculateTotals();
                    },
                    error: function() {
                        alert('Failed to fetch GST rate. Please try again.');
                    }
                });
            }
        });


            // Calculate row total
            $(document).on('input', '.quantity, .unit-price', function() {
                const row = $(this).closest('.product-row');
                // const quantity = parseFloat(row.find('.quantity').val()) || 0;
                // const unitPrice = parseFloat(row.find('.unit-price').val()) || 0;
                // const total = quantity * unitPrice;
                // row.find('.total-price').val(total.toFixed(2));
                calculateRowTotal(row);
                calculateTotals();
            });

             // Calculate row total including GST(newly added)
        function calculateRowTotal(row) {
            const quantity = parseFloat(row.find('.quantity').val()) || 0;
            const unitPrice = parseFloat(row.find('.unit-price').val()) || 0;
            const gstRate = parseFloat(row.find('.quantity').data('gst-rate')) || 0;

            const totalBeforeGST = quantity * unitPrice;
            const gstAmount = (totalBeforeGST * gstRate) / 100;
            const totalWithGST = totalBeforeGST + gstAmount;

            row.find('.total-price').val(totalWithGST.toFixed(2));
            row.find('.gst-amount').val(gstAmount.toFixed(2)); // Optional: Add a separate field for GST amount
        }

            // Calculate additional charges
            $('.charges').on('input', function() {
                calculateTotals();
            });


              // Handle payment type change
              $('#paymentType').change(function() {
                const paymentType = $(this).val();
                $('.payment-details').hide();
                $('#paidAmountRow, #outstandingRow').addClass('d-none');

                // Reset form
                // $('#poForm')[0].reset();
                $(this).val(paymentType); // Restore selected payment type

                // Show relevant payment details
                if (paymentType === 'Credit') {
                    $('.credit-details').show();
                    $('#outstandingRow').removeClass('d-none');
                } else if (paymentType === 'Half-payment') {
                    $('.partial-payment-details').show();
                    $('#paidAmountRow, #outstandingRow').removeClass('d-none');
                } else if (paymentType === 'Full-payment') {
                    $('.full-payment-details').show();
                    $('#paidAmountRow').removeClass('d-none');
                }

                calculateTotals();
            });



           // Update partial payment calculations
           $('#partialPaymentAmount').on('input', function() {
                calculateTotals();
            });

            // Enhanced calculateTotals function with gst(newly added)
            function calculateTotals() {

               let subtotal = 0;
               let totalGST = 0;

                $('.total-price').each(function() {
                    subtotal += parseFloat($(this).val()) || 0;
                });

                let additionalCharges = 0;
                $('.charges').each(function() {

                    let value = parseFloat($(this).val()) || 0; // Parse input value or default to 0

                        // If the field is the discount field, ensure it's treated as negative
                        if ($(this).attr('id') === 'discountAmount') {
                            value = value > 0 ? -value : 0; // Convert to negative if it's positive
                        }

                        additionalCharges += value; // Add or subtract from total


                });

                // Ensure no negative charges (discount might exceed total charges)
        additionalCharges = Math.max(0, additionalCharges);


//discount


    let discount = parseFloat( $('#discountAmount').val()) ;   // Parse to number
    //             console.log(discount);



                // Calculate grand total

                const grandTotal = subtotal + additionalCharges ;

                $('#subtotal').text(subtotal.toFixed(2));
                $('#totalCharges').text(additionalCharges.toFixed(2));
                $('#discountDisplay').text(discount.toFixed(2));
                $('#grandTotal').text(grandTotal.toFixed(2));



                // Handle payment calculations
                const paymentType = $('#paymentType').val();
                let paidAmount = 0;
                let outstandingAmount = grandTotal;

                if (paymentType === 'Full-payment') {
                    paidAmount = grandTotal;
                    outstandingAmount = 0;
                } else if (paymentType === 'Half-payment') {
                    paidAmount = parseFloat($('#partialPaymentAmount').val()) || 0;
                    outstandingAmount = grandTotal - paidAmount;
                }

                $('#paidAmount').text(paidAmount.toFixed(2));
                $('#outstandingAmount').text(outstandingAmount.toFixed(2));
            }

            // Initialize
            $('#paymentType').trigger('change');
            $('#addProduct').click();
        });
    </script>
    @endpush
