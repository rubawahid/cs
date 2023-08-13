@props([
    'id', 'name', 'lable', 'value' => '' 
    ])
<div class="mb-3">
      <label for="{{ $id }}">{{ $lable }}</label>
      <div>
        <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}" placeholder="{{ $lable }}">{{ old($name, $value) }}</textarea>
        <x-form.error name="{{ $name }}" />
      </div>
    </div>