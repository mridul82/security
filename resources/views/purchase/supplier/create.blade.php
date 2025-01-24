{{-- Create/Edit Form --}}
{{-- resources/views/suppliers/form.blade.php --}}
@extends('layouts.master_template')

@section('title', isset($supplier) ? 'Edit Supplier' : 'Create New Supplier')
@section('header')
<div class="pagetitle">
    <h1>{{ isset($supplier) ? 'Edit Supplier' : 'Create New Supplier' }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin-suppliers') }}">Suppliers</a></li>
        <li class="breadcrumb-item active">{{ isset($supplier) ? 'Edit Supplier' : 'Create New Supplier' }}</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="container-fluid py-4">


    <div class="card">
        <div class="card-body">
            <form action="{{ isset($supplier) ? route('admin-supplier-update', $supplier) : route('admin-supplier-store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($supplier))
                    @method('PUT')
                @endif

                <div class="row">
                    {{-- Basic Information --}}
                    <div class="col-md-12">
                        <h5 class="card-title">Basic Information</h5>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Supplier Code *</label>
                        <input type="text" name="supplier_code"
                               class="form-control @error('supplier_code') is-invalid @enderror"
                               value="{{ old('supplier_code', $supplier->supplier_code ?? '') }}" required>
                        @error('supplier_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Company Name *</label>
                        <input type="text" name="company_name"
                               class="form-control @error('company_name') is-invalid @enderror"
                               value="{{ old('company_name', $supplier->company_name ?? '') }}" required>
                        @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="col-md-2">
                        <label class="form-label">Tax Number</label>
                        <input type="text" name="tax_number"
                               class="form-control @error('tax_number') is-invalid @enderror"
                               value="{{ old('tax_number', $supplier->tax_number ?? '') }}">
                        @error('tax_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Website</label>
                        <input type="text" name="website"
                               class="form-control @error('website') is-invalid @enderror"
                               value="{{ old('website', $supplier->website ?? '') }}">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    {{-- Contact Information --}}
                    <div class="col-md-12 mt-4">
                        <h5 class="card-title">Contact Information</h5>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Contact Person *</label>
                        <input type="text" name="contact_person"
                               class="form-control @error('contact_person') is-invalid @enderror"
                               value="{{ old('contact_person', $supplier->contact_person ?? '') }}" required>
                        @error('contact_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $supplier->email ?? '') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="mobile"
                               class="form-control @error('mobile') is-invalid @enderror"
                               value="{{ old('mobile', $supplier->mobile ?? '') }}" required>
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Address</label>
                        <textarea name="address_line1" class="form-control @error('address_line1') is-invalid @enderror" rows="1">{{ old('address_line1', $supplier->address ?? '') }}</textarea>
                        @error('address_line1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city"
                               class="form-control @error('city') is-invalid @enderror"
                               value="{{ old('city', $supplier->city ?? '') }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">State</label>
                        <input type="text" name="state"
                               class="form-control @error('state') is-invalid @enderror"
                               value="{{ old('state', $supplier->state ?? '') }}">
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Postal Code</label>
                        <input type="text" name="postal_code"
                               class="form-control @error('postal_code') is-invalid @enderror"
                               value="{{ old('postal_code', $supplier->postal_code ?? '') }}">
                        @error('postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country"
                               class="form-control @error('country') is-invalid @enderror"
                               value="{{ old('country', $supplier->country ?? '') }}">
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


               {{-- Bank Information --}}
                    <div class="col-md-12 mt-4">
                        <h5 class="card-title">Bank Information</h5>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Bank Name</label>
                        <input type="text" name="bank_name"
                               class="form-control @error('bank_name') is-invalid @enderror"
                               value="{{ old('bank_name', $supplier->bank_name ?? '') }}">
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Bank Account Number</label>
                        <input type="text" name="bank_account_number"
                               class="form-control @error('bank_account_number') is-invalid @enderror"
                               value="{{ old('bank_account_number', $supplier->bank_account_number ?? '') }}">
                        @error('bank_account_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">IBAN</label>
                        <input type="text" name="bank_iban"
                               class="form-control @error('bank_iban') is-invalid @enderror"
                               value="{{ old('bank_iban', $supplier->bank_iban ?? '') }}">
                        @error('bank_iban')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">SWIFT Code</label>
                        <input type="text" name="bank_swift"
                               class="form-control @error('bank_swift') is-invalid @enderror"
                               value="{{ old('bank_swift', $supplier->bank_swift ?? '') }}">
                        @error('bank_swift')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                             {{-- Additional Financial Information --}}
                             <div class="col-md-3">
                                <label class="form-label">Payment Terms</label>
                                <input type="text" name="payment_terms"
                                       class="form-control @error('payment_terms') is-invalid @enderror"
                                       value="{{ old('payment_terms', $supplier->payment_terms ?? '') }}">
                                @error('payment_terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Credit Limit</label>
                                <input type="number" step="0.01" name="credit_limit"
                                       class="form-control @error('credit_limit') is-invalid @enderror"
                                       value="{{ old('credit_limit', $supplier->credit_limit ?? '') }}">
                                @error('credit_limit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                    {{-- Other Information --}}
                    {{-- <div class="col-md-12 mt-4">
                        <h5 class="mb-3">Additional Information</h5>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Product Type</label>
                        <select name="supplier_product_type" class="form-select @error('supplier_product_type') is-invalid @enderror">
                            <option value="">Select Product Type</option>
                            <option value="book" {{ old('supplier_product_type', $supplier->supplier_product_type ?? '') == 'book' ? 'selected' : '' }}>Book</option>
                            <option value="instrument" {{ old('supplier_product_type', $supplier->supplier_product_type ?? '') == 'instrument' ? 'selected' : '' }}>Instrument</option>
                        </select>
                        @error('supplier_product_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status', $supplier->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $supplier->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-2">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                            <option value="">Select Payment Method</option>
                            <option value="bank_transfer" {{ old('payment_method', $supplier->payment_method ?? '') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="cash" {{ old('payment_method', $supplier->payment_method ?? '') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="credit" {{ old('payment_method', $supplier->payment_method ?? '') == 'credit' ? 'selected' : '' }}>Credit</option>
                            <option value="cheque" {{ old('payment_method', $supplier->payment_method ?? '') == 'cheque' ? 'selected' : '' }}>Cheque</option>
                            <option value="other" {{ old('payment_method', $supplier->payment_method ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Currency</label>
                        <select name="currency" class="form-select @error('currency') is-invalid @enderror">
                            <option value="">Select Currency</option>
                            <option value="inr" {{ old('currency', $supplier->currency ?? '') == 'inr' ? 'selected' : '' }}>INR</option>
                            <option value="eur" {{ old('currency', $supplier->currency ?? '') == 'eur' ? 'selected' : '' }}>EUR</option>
                            <option value="usd" {{ old('currency', $supplier->currency ?? '') == 'usd' ? 'selected' : '' }}>USD</option>
                            <option value="other" {{ old('currency', $supplier->currency ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('currency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tax Rate</label>
                        <input type="number" step="0.01" name="tax_rate"
                               class="form-control @error('tax_rate') is-invalid @enderror"
                               value="{{ old('tax_rate', $supplier->tax_rate ?? '') }}">
                        @error('tax_rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    {{-- Notes --}}

                    <div class="col-md-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $supplier->notes ?? '') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($supplier) ? 'Update Supplier' : 'Create Supplier' }}
                        </button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
