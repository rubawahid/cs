@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3">New product</h2>
<form action="{{ route('products.store') }}" method="post">
  {{ csrf_field() }}

  @include('admin.products._form', [
    'submit_label' => 'create',
    ])
</form>

@endsection