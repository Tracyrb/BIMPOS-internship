@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Categories</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Menu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->menu->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
