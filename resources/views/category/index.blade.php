@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary">Add Category</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Menu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->menu->name }}</td>
                    <td>
                        <div class="btn-group">
                        <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" class="btn btn-secondary mr-3">Edit</a>
                        <form action="{{ route('admin.categories.destroy', ['category' => $category]) }}" method="POST">
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
