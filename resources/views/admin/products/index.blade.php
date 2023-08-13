@extends('layouts.admin')

@section('content')
<header class="mb-4 d-flex">
<h2 class="mb-4 fs-3">categories</h2>
<div class="ml-auto">
<a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">+ Create category</a>
</div>
</header>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ URL::current() }} " method="get" class="form-inline">
    <input type="text" name="search" value="{{ request('search') }}" class="form_control mb-2 mr-2" placeholder="search...">
    <select name="category_id" class="form_control mb-2 mr-2">
        <option value="">All categories</option>
        @foreach ($categories as $category)
        <option value="{{ $category_id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
      @endforeach
    </select>
    <select name="status" class="form_control mb-2 mr-2">
        <option value="">Status</option>
        @foreach ($status_options as $value => $text)
        <option value="{{ $value }}" @selected(request('status') == $value)>{{ $text }}</option>
      @endforeach
    </select>
    <input type="number" name="price_min" value="{{ request('price_min') }}" class="form_control mb-2 mr-2" placeholder="Min Price">
    <input type="number" name="price_max" value="{{ request('price_max') }}" class="form_control mb-2 mr-2" placeholder="Max Price">
    <button type="submit" class="btn btn-dark">Filter</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Products #</th>
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
            <td>{{ $category->Products_count }}</td>
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