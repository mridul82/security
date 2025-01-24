<div class="row mb-3">
    <div class="col-md-4">
        <strong>Supplier Code:</strong>
        <p>{{ $supplier->supplier_code }}</p>
    </div>
    <div class="col-md-4">
        <strong>Company Name:</strong>
        <p>{{ $supplier->company_name }}</p>
    </div>
    <div class="col-md-4">
        <strong>Contact Person:</strong>
        <p>{{ $supplier->contact_person }}</p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <strong>Email:</strong>
        <p>{{ $supplier->email }}</p>
    </div>
    <div class="col-md-4">
        <strong>Phone:</strong>
        <p>{{ $supplier->phone }}</p>
    </div>
    <div class="col-md-4">
        <strong>Mobile:</strong>
        <p>{{ $supplier->mobile }}</p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <strong>Website:</strong>
        <p>{{ $supplier->website ?? 'N/A' }}</p>
    </div>
    <div class="col-md-4">
        <strong>Tax Number:</strong>
        <p>{{ $supplier->tax_number ?? 'N/A' }}</p>
    </div>
    <div class="col-md-4">
        <strong>Address Line 1:</strong>
        <p>{{ $supplier->address_line1 }}</p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <strong>Address Line 2:</strong>
        <p>{{ $supplier->address_line2 ?? 'N/A' }}</p>
    </div>
    <div class="col-md-4">
        <strong>City:</strong>
        <p>{{ $supplier->city }}</p>
    </div>
    <div class="col-md-4">
        <strong>State:</strong>
        <p>{{ $supplier->state ?? 'N/A' }}</p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <strong>Postal Code:</strong>
        <p>{{ $supplier->postal_code }}</p>
    </div>
    <div class="col-md-4">
        <strong>Country:</strong>
        <p>{{ $supplier->country }}</p>
    </div>
    <div class="col-md-4">
        <strong>Payment Terms:</strong>
        <p>{{ $supplier->payment_terms ?? 'N/A' }}</p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <strong>Credit Limit:</strong>
        <p>{{ number_format($supplier->credit_limit, 2) }}</p>
    </div>
    <div class="col-md-4">
        <strong>Payment Method:</strong>
        <p>{{ $supplier->payment_method ?? 'N/A' }}</p>
    </div>
    <div class="col-md-4">
        <strong>Bank Name:</strong>
        <p>{{ $supplier->bank_name ?? 'N/A' }}</p>
    </div>
</div>
