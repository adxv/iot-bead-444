@extends('layouts.app')

@section('title', 'Specification Details')

@section('content')
<div class="container">
    <h1>Specification Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $specification->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text">{{ $specification->description }}</p>
            <a href="{{ route('specifications.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
