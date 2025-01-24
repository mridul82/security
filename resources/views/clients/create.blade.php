@extends('layouts.master_template', ['title' => 'Clients'])

@section('title', 'Clients')
@section('header')
    <div class="pagetitle">
        <h1>Clients</h1>
        <nav>
            <ol class="breadcrumb
        ">
                <li class="breadcrumb
            -item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Clients</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add New Client</div>
                    <div class="card-body">
                        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="business_name">Business Name</label>
                                <input type="text" name="business_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" required></textarea>
                            </div>
                            <div class="documents-container mb-3">
                                <label>Documents (Max: 2MB each, Types: PDF, JPG, PNG)</label>
                                <div class="document-input-group mb-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="file" name="documents[]" class="form-control" accept=".pdf,image/jpeg,image/png">
                                            <small class="text-muted">Each document must be less than 2MB in size</small>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="document_titles[]" class="form-control" placeholder="Document Title">
                                        </div>
                                    </div>
                                </div>
                                @error('documents.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <i class="bi bi-plus-circle" onclick="addDocumentInput()" style="cursor: pointer;">
                                    Add More Documents
                                </i>
                                
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Add Client</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
<script>
    function addDocumentInput() {
    const container = document.querySelector('.documents-container');
    const newGroup = document.createElement('div');
    newGroup.className = 'document-input-group mb-2';
    newGroup.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <input type="file" name="documents[]" class="form-control" accept=".pdf,image/jpeg,image/png">
                <small class="text-muted">Each document must be less than 2MB in size</small>
            </div>
            <div class="col-md-6">
                <input type="text" name="document_titles[]" class="form-control" placeholder="Document Title">
            </div>
        </div>
    `;
    container.insertBefore(newGroup, container.lastElementChild);
}
// Add client-side file size validation
document.addEventListener('change', function(e) {
    if (e.target.type === 'file') {
        const file = e.target.files[0];
        if (file) {
            if (e.target.name === 'photo') {
                if (file.size > 700 * 1024) { // 700KB in bytes
                    alert('Photo size must not exceed 700KB');
                    e.target.value = ''; // Clear the input
                }
            } else if (e.target.name === 'documents[]') {
                if (file.size > 2 * 1024 * 1024) { // 2MB in bytes
                    alert('Document size must not exceed 2MB');
                    e.target.value = ''; // Clear the input
                }
            }
        }
    }
});
</script>

@endpush