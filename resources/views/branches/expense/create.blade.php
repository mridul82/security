@extends('layouts.master_template', ['title'=> 'Expenses'])

@section('title', 'Expenses')

@section('header')
<div class="pagetitle">
    <h1>Add Expenses</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Add Expenses</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Add Expenses</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin-expense-store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="branch_id">Branch</label>
                        <select name="branch_id" id="branch_id" class="form-control" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="category">Category</label>
                        <select id="expenseDropdown" class="form-control mb-3 select2" name="category">
                            <option value="all">Select Expenses</option>
                            <option value="salary">Salary</option>
                            <option value="rent">Rent</option>
                            <option value="food">Food</option>
                            <option value="misc">Miscellaneous</option>
                            <option value="electricity">Electricity</option>
                            <option value="other">Other</option>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description', $expense->description ?? '') }}" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" name="amount" value="{{ old('amount', $expense->amount ?? '') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="expense_date">Expense Date</label>
                        <input type="date" class="form-control" name="expense_date" value="{{ old('expense_date', $expense->expense_date ?? '') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="payment_status">Payment Status</label>
                        <select name="payment_status" class="form-control" required>
                            <option value="pending" {{ old('payment_status', $expense->payment_status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="partial" {{ old('payment_status', $expense->payment_status ?? '') == 'partial' ? 'selected' : '' }}>Partial</option>
                            <option value="paid" {{ old('payment_status', $expense->payment_status ?? '') == 'paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="paid_amount">Paid Amount</label>
                        <input type="number" step="0.01" class="form-control" name="paid_amount" value="{{ old('paid_amount', $expense->paid_amount ?? '') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="balance">Balance</label>
                        <input type="number" step="0.01" class="form-control" name="balance" value="{{ old('balance', $expense->balance ?? '') }}" required>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 text-right mt-3">
                        <button type="submit" class="btn btn-primary">Save Expense</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
