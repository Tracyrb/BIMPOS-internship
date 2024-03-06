@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Edit Stock</h1>
    <form action="{{ route('admin.stocks.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" id="product_id" class="form-control">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $stock->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $stock->quantity }}">
        </div>
        <button class="mt-4 btn btn-secondary">Update Stock</button>
    </form>
</div>
@endsection
