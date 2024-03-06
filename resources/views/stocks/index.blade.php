@extends('layouts.adminapp')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Products and Stocks</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Product Name</th>
                <th>In Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->user->name }}</td>
                    <td>{{ optional($stock->product)->name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.stocks.edit', $stock->id) }}" class="btn btn-secondary mr-3">Edit</a>
                            <form action="{{ route('admin.stocks.destroy', ['stock' => $stock]) }}" method="POST">
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
