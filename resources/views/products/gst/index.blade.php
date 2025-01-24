@extends('layouts.master_template', ['title'=> 'GST'])

@section('title', 'GST Register')
@section('header')
<div class="pagetitle">
    <h1>GST Register</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">GST</li>
      </ol>
    </nav>
</div>
@endsection

<style>
    #searchResults {
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    #searchResults .list-group-item {
        border-left: none;
        border-right: none;
    }

    #searchResults .list-group-item:first-child {
        border-top: none;
    }

    #searchResults .list-group-item:last-child {
        border-bottom: none;
    }
    </style>
@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">Add GST</div>

                <div class="card-body">
                    <form action="{{ route('admin-gst-store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="search">Search Book/HSN</label>
                            <input type="text" class="form-control" id="search"
                                   placeholder="Search by book name or HSN code">
                            <div id="searchResults" class="list-group mt-2" style="display:none; position: absolute; z-index: 1000; width: 100%;"></div>
                        </div>

                            <div class="form-group mb-3">
                                <label for="hsn_code">HSN Code</label>
                                <input type="text" class="form-control" id="hsn_code" name="hsn_code"
                                    value="{{ old('hsn_code') }}" required readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="base_price">Base Price</label>
                                <input type="number" step="0.01" class="form-control" id="base_price" name="base_price"
                                       value="{{ old('base_price') }}" required readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="gst_rate">GST Rate (%)</label>
                                <input type="number" step="0.01" class="form-control" id="gst_rate" name="gst_rate"
                                    value="{{ old('gst_rate') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="mrp">MRP</label>
                                <input type="number" step="0.01" class="form-control" id="mrp" name="mrp"
                                    value="{{ old('mrp') }}" required>
                            </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save GST Rate</button>
                            <a href="{{ route('admin-gst') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">GST Rates</h5>
                    <a href="{{ route('admin-gst-create') }}" class="btn btn-primary">Add New GST Rate</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>HSN Code</th>
                                <th>GST Rate (%)</th>
                                <th>MRP</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gstRates as $gst)
                            <tr>
                                <td>{{ $gst->product->name }}</td>
                                <td>{{ $gst->hsn_code }}</td>
                                <td>{{ $gst->gst_rate }}%</td>
                                <td>₹{{ number_format($gst->mrp, 2) }}</td>
                                <td>{{ $gst->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin-gst-edit', $gst->id) }}" ><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('admin-gst-destroy', $gst->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" onclick="return confirm('Are you sure you want to delete this GST rate?')"><i class="bi bi-trash"></i></a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">

$(document).ready(function() {
    let searchTimeout;
    const searchResults = $('#searchResults');

    // Search products as user types
    $('#search').on('input', function() {
        const searchTerm = $(this).val();
        clearTimeout(searchTimeout);

        if (searchTerm.length < 2) {
            searchResults.hide();
            return;
        }

        searchResults.html('<div class="list-group-item">Searching...</div>').show();

        searchTimeout = setTimeout(function() {
            $.get('{{ route("admin-gst-product-search") }}', { search: searchTerm })
                .done(function(data) {
                    if (data.length === 0) {
                        searchResults.html('<div class="list-group-item">No results found</div>');
                        return;
                    }

                    let html = '';
                    data.forEach(function(item) {
                        console.log(item);
                        html += `<a href="#" class="list-group-item list-group-item-action"
                                  data-hsn="${item.hsn_code}"
                                  data-price="${item.selling_price}">
                                ${item.name} (HSN: ${item.hsn_code}) - ₹${item.selling_price}
                               </a>`;
                    });
                    searchResults.html(html);
                })
                .fail(function() {
                    searchResults.html('<div class="list-group-item">Error searching products</div>');
                });
        }, 300);
    });

    // Handle selection from search results
    searchResults.on('click', '.list-group-item-action', function(e) {
        e.preventDefault();
        const hsnCode = $(this).data('hsn');
        const basePrice = $(this).data('price');

        // Set HSN code and base price
        $('#hsn_code').val(hsnCode);
        $('#base_price').val(basePrice);
        searchResults.hide();
        $('#search').val($(this).text());

        // Fetch GST details
        $.get(`{{ url('admin/gst/check') }}/${hsnCode}`)
            .done(function(response) {
                if (response.status === 'success') {
                    $('#gst_rate').val(response.data.gst_rate);
                    calculateMRP();
                } else {
                    $('#gst_rate').val('').prop('readonly', false);
                    $('#mrp').val('');
                }
            })
            .fail(function() {
                $('#gst_rate').val('').prop('readonly', false);
                $('#mrp').val('');
            });
    });

    // Close search results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#search, #searchResults').length) {
            searchResults.hide();
        }
    });

    // Calculate MRP when GST rate changes
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
