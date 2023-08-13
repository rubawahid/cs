@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3">Edit category</h2>
<form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
 @csrf
 <input type="hidden" name="_method" value="put">
 @method('put')

  @include('admin.categories._form', [
    'submit_label' => 'Update',
    ])
</form>

@endsection