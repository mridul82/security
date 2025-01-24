@extends('layouts.master_template', ['title'=> 'Edit GST'])

@section('title', 'Edit GST Rate')
@section('header')
<div class="pagetitle">
    <h1>Edit GST Rate</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin-gst') }}">GST</a></li>
        <li class="breadcrumb-item active">Edit GST</li>
      </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="col-lg-5">
    <div class="card">
        <div class="card-header">Edit GST</div>
        <div class="card-body">
            <form action="{{ route('admin-gst-update', $gst->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="hsn_code">HSN Code</label>
                    <input type="text" class="form-control" id="hsn_code" name="hsn_code"
                           value="{{ $gst->hsn_code }}" readonly>
                </div>

                <div class="form-group mb-3">
                    <label for="base_price">Base Price</label>
                    <input type="number" step="0.01" class="form-control" id="base_price" name="base_price"
                           value="{{ $base_price }}" readonly>
                </div>

                <div class="form-group mb-3">
                    <label for="gst_rate">GST Rate (%)</label>
                    <input type="number" step="0.01" class="form-control" id="gst_rate" name="gst_rate"
                           value="{{ $gst->gst_rate }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="mrp">MRP</label>
                    <input type="number" step="0.01" class="form-control" id="mrp" name="mrp"
                           value="{{ $gst->mrp }}" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update GST Rate</button>
                    <a href="{{ route('admin-gst') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#gst_rate').on('input', calculateMRP);

        function calculateMRP() {
            const basePrice = parseFloat($('#base_price').val()) || 0;
            const gstRate = parseFloat($('#gst_rate').val()) || 0;

            if (basePrice && gstRate) {
                const gstAmount = basePrice * (gstRate / 100);
                const mrpWithGst = basePrice + gstAmount;
                $('#mrp').val(mrpWithGst.toFixed(2));
            }
        }
    });
</script>
@endpush
