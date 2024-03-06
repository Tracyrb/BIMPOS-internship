@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Products</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Number Of Stocks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ optional($product->category)->category_name }}</td>
                <td>{{ $stocks->where('product_id', $product->id)->first()->quantity}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
