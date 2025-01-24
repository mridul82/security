@extends('layouts.master_template', ['title'=> 'Products'])
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Add Product')
@section('header')
<div class="pagetitle">
    <h1>Add Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Add Product</li>
      </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create New Product</h4>
                </div>
                <div class="card-body">
                    <form id="productForm" action="{{ route('admin-product-store') }}" method="POST">
                        @csrf
                        
                       
                        <div class="mb-3">
                            <label for="type" class="form-label">Product Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                id="productType" name="type" required>
                                <option value="">Select Type</option>
                                <option value="mobile" {{ old('type') == 'mobile' ? 'selected' : '' }}>Mobile</option>
                                <option value="accessory" {{ old('type') == 'accessory' ? 'selected' : '' }}>Accessory</option>
                                <option value="parts" {{ old('type') == 'parts' ? 'selected' : '' }}>Parts</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dynamic Fields for Mobile/Accessory -->
                        <div id="mobileAccessoryFields" class="d-none">
                            <div class="mb-3">
                                <div class="d-flex gap-2">
                                    <div class="flex-grow-1">
                                        <label for="brandSelect" class="form-label">Brand</label>
                                        <select class="form-select @error('brand_id') is-invalid @enderror" name="brand_id" id="brandSelect">
                                            <option value="">Select a Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" 
                                                    {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                    <div class="align-self-end">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" 
                                            data-bs-target="#quickAddBrandModal">
                                            + Add Brand
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex gap-2">
                                    <div class="flex-grow-1">
                                        <label for="modelSelect" class="form-label">Model</label>
                                        <select class="form-select @error('model_id') is-invalid @enderror" 
                                            id="modelSelect" name="model_id">
                                            <option value="">Select Model</option>
                                        </select>
                                        @error('model_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="align-self-end">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" 
                                            data-bs-target="#quickAddModelModal">
                                            + Add Model
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div id="variantField" class="mb-3">
                                <div class="d-flex gap-2">
                                    <div class="flex-grow-1">
                                        <label for="variantSelect" class="form-label">Variant</label>
                                        <select class="form-select @error('variant_id') is-invalid @enderror" 
                                            id="variantSelect" name="variant_id">
                                            <option value="">Select Variant</option>
                                        </select>
                                        @error('variant_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="align-self-end">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" 
                                            data-bs-target="#quickAddVariantModal">
                                            + Add Variant
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <!-- Parts Compatibility Field -->
<div id="partsField" class="d-none">
    <div class="mb-3">
        <label class="form-label">Select Brand</label>
        <select class="form-select @error('part_brand_id') is-invalid @enderror" 
                                            id="brandSelectallmodel" name="part_brand_id">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" 
                                                    {{ old('part_brand_id') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Compatible Models</label>
        <div id="compatibleModels" class="row row-cols-3 g-3">
            <!-- Will be populated dynamically -->
        </div>
        @error('compatible_models')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
                         <!-- Basic Product Information -->
                         <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="hsn_code" class="form-label">HSN code</label>
                                <input type="text" class="form-control @error('hsn_code') is-invalid @enderror" 
                                    id="hsn_code" name="hsn_code" value="{{ old('hsn_code') }}" required>
                                @error('hsn_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                         </div>
                         

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mrp" class="form-label">MRP</label>
                                    <input type="number" step="0.01" class="form-control @error('mrp') is-invalid @enderror" 
                                        id="mrp" name="mrp" value="{{ old('mrp') }}" required>
                                    @error('mrp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="selling_price" class="form-label">Selliing Price</label>
                                    <input type="number" class="form-control @error('selling_price') is-invalid @enderror" 
                                        id="selling_price" name="selling_price" value="{{ old('selling_price') }}" required>
                                    @error('selling_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>


                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Add Brand Modal -->
<div class="modal fade" id="quickAddBrandModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="brandName" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" id="brandName" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveBrand()">Save Brand</button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Add Model Modal -->
<div class="modal fade" id="quickAddModelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="modelName" class="form-label">Model Name</label>
                    <input type="text" class="form-control" id="modelName" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveModel()">Save Model</button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Add Variant Modal -->
<div class="modal fade" id="quickAddVariantModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Variant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="variantName" class="form-label">Variant Name</label>
                    <input type="text" class="form-control" id="variantName" required>
                </div>
                <div class="mb-3">
                    <label for="specifications" class="form-label">Specifications (JSON)</label>
                    <textarea class="form-control" id="specifications" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveVariant()">Save Variant</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

<script>
$(document).ready(function() {
    
    // Cache jQuery selectors for better performance
    const $productType = $('#productType');
    const $mobileFields = $('#mobileAccessoryFields');
    const $accessoryFields = $('#mobileAccessoryFields'); // New separate section for accessories
    const $partsField = $('#partsField');
    const $mobileVariantField = $('#variantField');
    const $brandSelect = $('#brandSelect');
    const $modelSelect = $('#modelSelect');
    const $variantSelect = $('#variantSelect');
    const $brandSelectallmodel = $('#brandSelectallmodel');

    // Handle product type changes
    $productType.on('change', function() {
        toggleFields($(this).val());
    });

    // Handle brand selection for both mobile and accessory
    $brandSelect.on('change', function() {
        loadModels($(this).val());
    });

    // Handle model selection for mobile
    $modelSelect.on('change', function() {
        if ($productType.val() === 'mobile') {
            loadVariants($(this).val());
        }
    });

    // Set initial state based on old input
    if ($productType.val()) {
        toggleFields($productType.val());
    }

    function toggleFields(productType) {
        $mobileFields.addClass('d-none');
        $accessoryFields.addClass('d-none');
        $partsField.addClass('d-none');
        $mobileVariantField.addClass('d-none');

        switch (productType) {
            case 'mobile':
                $mobileFields.removeClass('d-none');
                $mobileVariantField.removeClass('d-none');
                break;
            case 'accessory':
                $accessoryFields.removeClass('d-none');
                $mobileVariantField.removeClass('d-none');
                break;
            case 'parts':
                $partsField.removeClass('d-none');
                //loadAllModels();
                break;
        }
    }
});

//handle brand selection
$('#brandSelectallmodel').on('change', function() {
        loadAllModels($(this).val());
    });

//load all brands
function loadBrands() {
        $.ajax({
            url: '/admin/all-brands',
            type: 'GET',
            dataType: 'json',
            success: populateBrands,
            error: handleError('Error loading brands')
        });
    }

// Load models for selected brand
function loadModels(brandId) {
    if (!brandId) return;

    $.ajax({
        url: `/admin/models/${brandId}`,
        type: 'GET',
        dataType: 'json',
        success: populateModels,
        error: handleError('Error loading models')
    });
}

// Load variants for selected model
function loadVariants(modelId) {
    if (!modelId) return;

    $.ajax({
        url: `/admin/variants/${modelId}`,
        type: 'GET',
        dataType: 'json',
        success: populateVariants,
        error: handleError('Error loading variants')
    });
}

// Load all models for parts
function loadAllModels($brandId) {
    //alert($brandId);
    if (!$brandId) return;

    $.ajax({
        url: `/admin/all-models/${$brandId}`,
        type: 'GET',
        dataType: 'json',
        success: populateCompatibleModels,
        error: handleError('Error loading compatible models')
    });
}

// Helper functions
function populateBrands(brands) {
    const $brandSelect = $('#brandSelect');
    $brandSelect.html('<option value="">Select Brand</option>');
    brands.forEach(brand => {
        $brandSelect.append($('<option>', {
            value: brand.id,
            text: brand.name
        }));
    });
}

function populateModels(models) {
    const $modelSelect = $('#modelSelect');
    $modelSelect.html('<option value="">Select Model</option>');
    models.forEach(model => {
        $modelSelect.append($('<option>', {
            value: model.id,
            text: model.name
        }));
    });
}

function populateVariants(variants) {
    const $variantSelect = $('#variantSelect');
    $variantSelect.html('<option value="">Select Variant</option>');
    variants.forEach(variant => {
        $variantSelect.append($('<option>', {
            value: variant.id,
            text: variant.name
        }));
    });
}

function populateCompatibleModels(models) {
    console.log(models);
    const $container = $('#compatibleModels');
    $container.empty();

    models.forEach(model => {
        $container.append(`
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                        name="compatible_models[]" value="${model.id}" 
                        id="model${model.id}">
                    <label class="form-check-label" for="model${model.id}">
                        ${model.brand.name} - ${model.name}
                    </label>
                </div>
            </div>
        `);
    });
}

$('#name').on('input', function() {
    const name = $('#modelSelect').val() ? $('#modelSelect option:selected').text() : $('#name').off('input');;
    $('#name').val(name);
});

function handleError(message) {
    return function(xhr, status, error) {
        console.error(`${message}:`, error);
        alert(message);
    };
}


// Save new brand
function saveBrand() {
    const name = $('#brandName').val();
    if (!name) return;

    $.ajax({
        url: '/admin/brands',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: name
        },
        success: function(brand) {
            const brandSelect = $('#brandSelect');
            brandSelect.append(`<option value="${brand.id}">${brand.name}</option>`);
            brandSelect.val(brand.id);
            
            $('#quickAddBrandModal').modal('hide');
            $('#brandName').val('');
            
            brandSelect.trigger('change');
        },
        error: function() {
            alert('Error adding brand');
        }
    });
}

// Save new model
function saveModel() {
    const name = $('#modelName').val();
    const brandId = $('#brandSelect').val();
    
    if (!name || !brandId) {
        alert('Please select a brand and enter a model name');
        return;
    }

    $.ajax({
        url: '/admin/models',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: name,
            brand_id: brandId
        },
        success: function(model) {
            console.log(model);
            const modelSelect = $('#modelSelect');
            modelSelect.append(`<option value="${model.id}">${model.name}</option>`);
            modelSelect.val(model.id);
            
            $('#quickAddModelModal').modal('hide');
            $('#modelName').val('');
            
            modelSelect.trigger('change');
        },
        error: function() {
            alert('Error adding model');
        }
    });
}


// Save new variant
function saveVariant() {
    const name = $('#variantName').val();
    const modelId = $('#modelSelect').val();
    const specifications = $('#specifications').val();
    
    if (!name || !modelId) {
        alert('Please select a model and enter a variant name');
        return;
    }

    $.ajax({
        url: '/admin/variants',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: name,
            model_id: modelId,
            specifications: specifications ? JSON.parse(specifications) : null
        },
        success: function(variant) {
            const variantSelect = $('#variantSelect');
            variantSelect.append(`<option value="${variant.id}">${variant.name}</option>`);
            variantSelect.val(variant.id);
            
            $('#quickAddVariantModal').modal('hide');
            $('#variantName').val('');
            $('#specifications').val('');
        },
        error: function() {
            alert('Error adding variant');
        }
    });
}


</script>
@endpush