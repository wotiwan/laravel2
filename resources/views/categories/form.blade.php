@extends('layouts.app')

@section('content')
<h1>{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h1>

<form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
    @csrf
    @if(isset($category))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($category) ? 'Update' : 'Save' }}</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
