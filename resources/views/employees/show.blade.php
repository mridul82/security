@extends('layouts.master_template', ['title'=> 'Employees Details'])

@section('title', 'Employees Details')
@section('header')
<div class="pagetitle">
    <h1>Employees Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb
            -item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('employees') }}">Employees</a></li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <h1>Employee Details</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h2>{{ $employee->name }}</h2>
            <p><strong>Father's Name:</strong> {{ $employee->father_name }}</p>
            <p><strong>Phone Number:</strong> {{ $employee->phone_number }}</p>
            <p><strong>Relative's Phone Number:</strong> {{ $employee->relative_phone_number }}</p>
            <p><strong>Permanent Address:</strong> {{ $employee->permanent_address }}</p>
            <p><strong>Present Address:</strong> {{ $employee->present_address }}</p>
            <p><strong>District:</strong> {{ $employee->district }}</p>
            <p><strong>Date of Joining:</strong> {{ $employee->date_of_joining }}</p>
            @if($employee->date_of_leaving)
            <p><strong>Date of Leaving:</strong> {{ $employee->date_of_leaving }}</p>
            @endif
            <p><strong>Registration Fee:</strong> {{ number_format($employee->registration_fee, 2) }}</p>
            <p><strong>Employee Code:</strong> {{ $employee->employee_code }}</p>
        </div>
    </div>

    <div class="mb-4">
        <h3>Photo</h3>
        @php
            $photo = $employee->documents->where('type', 'photo')->first();
        @endphp
        @if ($photo)
            <img src="{{ asset('storage/' . $photo->file_path) }}" alt="Employee Photo" class="img-thumbnail" style="max-width: 200px;">
        @else
            <p>No photo available.</p>
        @endif
    </div>

    <div>
        <h3>Documents</h3>
        @if ($employee->documents->where('type', 'document')->count() > 0)
            <ul class="list-group">
                @foreach ($employee->documents->where('type', 'document') as $document)
                    <li class="list-group-item">
                        <strong>{{ $document->title ?? 'Document' }}</strong>
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-primary btn-sm float-end">View</a>
                        <p class="mb-0"><small>{{ $document->file_name }} ({{ round($document->file_size / 1024, 2) }} KB)</small></p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No documents available.</p>
        @endif
    </div>
</div>
@endsection