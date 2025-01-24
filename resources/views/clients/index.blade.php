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
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Clients</h1>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            Add New Client
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            
    <table class="table table-striped table-hover table-bordered datatable"> 
        <thead>
            <tr>
                <th>Business Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Files</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td>{{ $client->business_name }}</td>
                    <td>{{ $client->phone_number }}</td>
                    <td>{{ Str::limit($client->address, 50) }}</td>
                    <td>
                        {{ $client->files()->count() }} 
                        <a href="#" data-bs-toggle="modal" data-bs-target="#clientFilesModal{{ $client->id }}">
                            View Files
                        </a>

                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateSalaryModal">
                            Update Salary
                        </button> --}}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this client?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Client Files Modal -->
                <div class="modal fade" id="clientFilesModal{{ $client->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Files for {{ $client->business_name }}</h5>
                                <button type="button" class="close" data-bs-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if($client->files->count() > 0)
                                    <ul class="list-group">
                                        @foreach($client->files as $file)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $file->description }}
                                                <a href="{{ asset($file->file_path) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-primary">
                                                    Download
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No files uploaded for this client.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        No clients found. 
                        <a href="{{ route('clients.create') }}">Add a new client</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
        </div>
    </div>
</div>

@endsection