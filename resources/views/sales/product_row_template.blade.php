 <!-- Product Row Template -->
 <template id="product-row-template">
    <div class="product-row">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Product&nbsp;&nbsp;&nbsp;<span style="font-size: 12px; color: blue"><input type="checkbox" name="is_gift[]" id="is_gift" value="0"/>Gift</span></label>
                    <select class="form-control product-select" name="products[]" id="product-select" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Cost Price</label>
                    <select class="form-control cost-price" name="cost_prices[]" required>
                        <option value="">Select Cost Price</option>
                    </select>

                </div>
            </div>



            <div class="col-md-2">
                <div class="form-group">
                    <label>Selling Price&nbsp;&nbsp;<span style="font-size: 12px; color: red"><input type="checkbox" name="is_custom[]" id="is_custom" value="0" />custom</span></label>
                    <div class="selling-price-container">
                        <select class="form-control selling-price" name="selling_prices[]" required>
                            <option value="">Select Selling Price</option>
                        </select>
                    </div>
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



