@extends('layouts.master_template', ['title'=> 'Inventory Categories'])

@section('title', 'Inventory Categories')
@section('header')
<div class="pagetitle">
    <h1>Inventory Categories</h1>
    <nav>
        <ol class="breadcrumb
        ">
            <li class="breadcrumb
            -item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Inventory Categories</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <div class="card">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                    <form action="{{ route('inventory.add-category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Add Sub-Category</div>
                <div class="card-body">
                    <form action="{{ route('inventory.add-sub-category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select name="inventory_category_id" class="form-control" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub-Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Sub-Category</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h2>Inventory Categories Overview</h2>
            <div class="accordion" id="categoriesAccordion">
                @foreach($categories as $index => $category)
                    <div class="card">
                        <div class="card-header" id="heading{{ $category->id }}">
                            <h2 class="mb-0">
                                <button class="btn" type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{ $category->id }}">
                                    {{ $category->name }} 
                                    ({{ $category->subCategories->count() }} Sub-Categories)
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{ $category->id }}" 
                             class="collapse {{ $index === 0 ? 'show' : '' }}" 
                             data-bs-parent="#categoriesAccordion">
                            <div class="card-body">
                                <h4>Sub-Categories:</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Products Count</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category->subCategories as $subCategory)
                                            <tr>
                                                <td>{{ $subCategory->name }}</td>
                                                <td>{{ $subCategory->products->count() }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-warning">Edit</button>
                                                        <button class="btn btn-danger">Delete</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</div>
@endsection