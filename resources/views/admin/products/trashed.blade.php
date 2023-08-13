@extends('layouts.admin')

@section('content')
<header class="mb-4 d-flex">
<h2 class="mb-4 fs-3">Trashed categories</h2>
<div class="ml-auto">
<a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">categories list</a>
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
            <th>Delete At</th>
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
            <td>{{ $category->deleted_at }}</td>
            <td> 
            <form action="{{ route('categories.restore', $category->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-trash-restore"></i> Restore</button>
                </form>
            </td>
            <td>
                <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Force Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $categories->links() }}
@endsection