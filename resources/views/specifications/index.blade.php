@extends('layouts.app')

@section('title', 'Specifications')

@section('content')
<div class="container">
    <h1>Specifications</h1>
    <a href="{{ route('specifications.create') }}" class="btn btn-primary">Add Specification</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                @php
                    $sortOrderToggle = $sortOrder === 'asc' ? 'desc' : 'asc';
                @endphp
                <th><a href="{{ route('specifications.index', ['sort_by' => 'id', 'sort_order' => $sortOrderToggle]) }}">ID</a></th>
                <th><a href="{{ route('specifications.index', ['sort_by' => 'name', 'sort_order' => $sortOrderToggle]) }}">Name</a></th>
                <th><a href="{{ route('specifications.index', ['sort_by' => 'description', 'sort_order' => $sortOrderToggle]) }}">Description</a></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($specifications as $specification)
            <tr>
                <td>{{ $specification->id }}</td>
                <td>{{ $specification->name }}</td>
                <td>{{ $specification->description }}</td>
                <td>
                    <a href="{{ route('specifications.edit', $specification->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('specifications.destroy', $specification->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
