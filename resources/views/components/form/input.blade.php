@props([
    'id', 'name', 'lable', 'value', 'type' => 'text'
    ])
<div class="mb-3">
      <label for="{{ $name }}">{{ $lable }}</label>
      <div>
        <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $lable }}">
        <x-form.error name="{{ $name }}" />
      </div>
    </div>