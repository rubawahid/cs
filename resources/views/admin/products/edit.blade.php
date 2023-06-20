@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3">Edit product</h2>
<form action="{{ route('products.update', $product->id) }}" method="post">
 @csrf
 <input type="hidden" name="_method" value="put">
 @method('put')

  @include('admin.products._form', [
    'submit_label' => 'Update',
    ])
</form>

@endsection