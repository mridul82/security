@extends('layouts.master_template', ['title' => 'Free Gifts'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Free Gifts</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sale ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Cost Price</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($freeGifts as $gift)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $gift->sale_id }}</td>
                    @if(isset($gift->productOrder))
                    <td>{{ $gift->productOrder->name  }}</td>
                    @elseif(isset($gift->product))
                    <td>{{  $gift->product->name  }}</td>
                    @endif
                    
                    <td>{{ $gift->quantity }}</td>
                    <td>{{ number_format($gift->product->unit_price, 2) }}</td>
                    <td>{{ number_format($totalCost, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total Cost of Free Gifts: {{ number_format($totalCost, 2) }}</h4>
    </div>
</div>
@endsection
