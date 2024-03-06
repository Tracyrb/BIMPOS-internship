@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-secondary">Add Product</a>
    <a href="{{ route('admin.stocks.create') }}" class="btn btn-secondary">Add Stock</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ optional($product->category)->category_name }}</td>
                    <td>
                        <div class="btn-group">
                        <a href="{{ route('admin.stocks.index', ['product_id' => $product->id]) }}" class="btn btn-secondary mr-3">View Stocks</a>
                        <a href="{{ route('admin.products.edit', ['product' => $product]) }}" class="btn btn-secondary mr-3">Edit</a>
                        <form action="{{ route('admin.products.destroy', ['product' => $product]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
