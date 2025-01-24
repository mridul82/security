@extends('layouts.master_template', ['title'=> 'Expenses'])

@section('title', ' Expenses')
@section('header')
<div class="pagetitle">
    <h1>Expenses</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Expenses</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="container">
    <a href="{{ route('admin-expense-create') }}" class="btn btn-primary" style="margin-bottom: 10px; margin-left: 15px">
        <i class="bi bi-plus-circle"></i>
        Add Expenses</a>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Branch Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Payment Status</th>
                <th>Paid Amount</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->id }}</td>
                <td>{{ $expense->branch->name }}</td>
                <td>{{ $expense->category }}</td>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->expense_date }}</td>
                <td>{{ $expense->payment_status }}</td>
                <td>{{ $expense->paid_amount }}</td>
                <td>{{ $expense->balance }}</td>
                <td>


                    <a href="{{ route('admin-expense-edit', $expense->id) }}" class="text-primary me-2">
                        <i class="bi bi-pencil-square"></i>
                    </a>


                    <form action="{{ route('admin-expense-destroy', $expense->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this expense?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if (count($expenses) == 0)
            <tr>
                <td colspan="10" class="text-center">No expenses found.</td>
            </tr>
            @endif


        </tbody>
    </table>
                    </div>
                </div>
    </div>
        </div>
</div>
@endsection
