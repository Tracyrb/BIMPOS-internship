@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 h1">Menus</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nameeeeeeeeee</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
