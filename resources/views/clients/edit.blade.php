@extends('layouts.master_template', ['title'=> 'Clients'])

@section('title', 'Clients')
@section('header')
<div class="pagetitle">
    <h1>Clients</h1>
    <nav>
        <ol class="breadcrumb
        ">
            <li class="breadcrumb
            -item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Clients</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
@section('content')
<div class="container">
    <h1>Edit Client: {{ $client->business_name }}</h1>
    <form action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="business_name">Business Name</label>
            <input type="text" name="business_name" class="form-control" 
                   value="{{ old('business_name', $client->business_name) }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" 
                   value="{{ old('phone_number', $client->phone_number) }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" class="form-control" required>{{ old('address', $client->address) }}</textarea>
        </div>
        <div class="form-group">
            <label>Current Files</label>
            <div class="list-group">
                @foreach($client->files as $file)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $file->description }}
                        <a href="{{ asset($file->file_path) }}" 
                           target="_blank" 
                           class="btn btn-sm btn-primary">
                            Download
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="files">Upload Additional Files</label>
            <input type="file" name="documents[]" multiple class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Update Client</button>
    </form>
</div>
@endsection