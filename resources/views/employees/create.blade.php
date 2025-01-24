@extends('layouts.master_template', ['title'=> 'Employees'])

@section('title', 'Employees')
@section('header')
<div class="pagetitle">
    <h1>Employees</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('employees') }}">Employees</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add New Employee</div>
                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Father's Name</label>
                                    <input type="text" name="father_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label>Relative's Phone Number</label>
                                    <input type="text" name="relative_phone_number" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label>Permanent Address</label>
                                    <textarea name="permanent_address" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Present Address</label>
                                    <textarea name="present_address" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label>District</label>
                                    {{-- <select name="district" class="form-control" required> --}}
                                        {{-- Add districts dynamically --}}
                                    {{-- </select> --}}
                                    <input type="text" name="district" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Joining</label>
                                    <input type="date" name="date_of_joining" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                
                                
                                <div class="form-group">
                                    <label>Registration Fee</label>
                                    <input type="number" name="registration_fee" class="form-control" required step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                
                                <div class="form-group mb-3">
                                    <label>Photo (Max: 700KB, Types: JPG, PNG)</label>
                                    <input type="file" name="photo" class="form-control" required accept="image/jpeg,image/png">
                                    <small class="text-muted">Please ensure your photo is less than 700KB in size</small>
                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create Employee</button>
                                </div>
                                
                            </div>
                        </div>
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