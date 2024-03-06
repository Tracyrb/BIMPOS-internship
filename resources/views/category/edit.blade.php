@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category_name">Name:</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ old('category_name', $category->category_name) }}">
            @error('category_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="menu_id">Menu:</label>
            <select name="menu_id" id="menu_id" class="form-control">
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}" {{ $menu->id == $category->menu_id ? 'selected' : '' }}>
                        {{ $menu->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="mt-4 btn btn-secondary">Update Category</button>
    </form>
</div>
@endsection
