 <!-- Customer and Sale Details Section -->
 <div class="section-card">
    <h4>Customer Details</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Sale Number</label>
                <input type="text" class="form-control" name="sale_number" required readonly value="{{ $soOrderNumber }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Sale Date</label>
                <input type="date" class="form-control" name="sale_date"  required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Customer</label>
                <input type="text" class="form-control" name="customer_name" required>
            </div>
        </div>
    </div>
</div>

<!-- Billing Details Section -->
<div class="section-card">
    <h4>Billing Details</h4>
    <div class="row">
        <div class="col-md-4">
            <label>Billing Name</label>
            <input type="text" class="form-control" name="billing_name" required>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Billing Address</label>
                <textarea class="form-control" name="billing_address" rows="2"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" class="form-control" name="customer_contact" required>
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

<div id="delivery-section" class="mt-4 section-card">
    <h4>Delivery Details</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="delivery-type">Delivery Type</label>
                <select class="form-control" id="delivery-type" name="delivery_type" required>
                    <option value="home_delivery">Home Delivery</option>
                    <option value="pickup">Pickup</option>
                    <option value="courier">Courier</option>
                    <option value="home_delivery">Home Delivery</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="delivery-status">Delivery Status</label>
                <select class="form-control" id="delivery-status" name="delivery_status" required>
                 
                    <option value="pending">Pending</option>
                    <option value="in_transit">In Transit</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>
    </div>
</div>


<!-- Additional Charges Section -->
<div class="section-card">
    <h4>Additional Charges</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Delivery Charges</label>
                <input type="number" step="0.01" class="form-control delivery-charges" name="delivery_charges" id="deliveryCharges" value="0.00">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>COD Charges</label>
                <input type="number" step="0.01" class="form-control cod-charges" name="cod_charges" id="codCharges" value="0.00">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Discount</label>
                <input type="number" step="0.01" class="form-control discount" name="discount" id="discountAmount" value="0.00" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Payment Method</label>
                <select class="form-control" name="payment_method" id="paymentMethod">
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                    <option value="online">Online</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Totals Section -->
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
                <tr class="table-primary">
                    <td><strong>Total:</strong></td>
                    <td class="text-end"><strong><span id="grandTotal">0.00</span></strong></td>
                </tr>
            </table>
        </div>
    </div>
</div>
