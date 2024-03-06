@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Edit Menu Item</h1>

    <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $menu->name }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ $menu->description }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="mt-4 btn btn-secondary">Update Menu Item</button>
    </form>
</div>
@endsection
