@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Add Stock</h1>
    <form action="{{ route('admin.stocks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User:</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" id="product_id" class="form-control">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control">
        </div>
        <button class="mt-4 btn btn-secondary">Add Stocks</button>
    </form>
</div>
@endsection
