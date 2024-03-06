@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="mt-4 btn btn-secondary">Update Product</button>
    </form>
</div>
@endsection
