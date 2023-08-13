@extends('layouts.admin')

@section('content')
<header class="mb-4 d-flex">
<h2 class="mb-4 fs-3">{{ $title }}</h2>
<div class="ml-auto">
<a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">+ Create category</a>
<a href="{{ route('categories.trashed') }}" class="btn btn-sm btn-danger"><i class="fas fa-trash">View Trash</a>
</div>
</header>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Catogery</th>
            <th>Price</th>
            <th>status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>
                <a href="{{  $category->image_url }}">
                <img src="{{ $category->image_url }}" width="60" alt="">
                </a>
            </td>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->category_name }}</td>
            <td>{{ $category->price_formatted }}</td>
            <td>{{ $category->status }}</td>
            <td> <a href="{{ route('categories.edit', ['category' => $category->id, 'action' => 'edit']) }}" class="btn btn-sm btn-outline-dark"><i class="far fa-edit"></i>Edit</a>></td>
            <td>
                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $categories->links() }}
@endsection