@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Menus</h1>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-secondary">Add Menu</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->description }}</td>
                    <td>
                        <div class="btn-group">
                        <a href="{{ route('admin.menus.edit', ['menu' => $menu]) }}" class="btn btn-secondary mr-3">Edit</a>
                        <form action="{{ route('admin.menus.destroy', ['menu' => $menu]) }}" method="POST">
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
