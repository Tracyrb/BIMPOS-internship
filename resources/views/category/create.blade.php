@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" id="category_name" class="form-control">
            @error('category_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="menu_id">Menu:</label>
            <select name="menu_id" id="menu_id" class="form-control">
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="mt-4 btn btn-secondary">Add Category</button>
    </form>
</div>
@endsection
