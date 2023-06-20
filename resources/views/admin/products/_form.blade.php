@if($errors->any())
<div class="alert alert-danger">
  You have some errors:
  <ul>
    @foreach($errors->all() as $error)
    <li>
      {{ $error }}
    </li>
    @endforeach
  </ul>
</div>
@endif

<div class="row">
  <div class="col md-8">
  <div class="mb-3">
  <label for="name">Product name</label>
  <div>
    <input type="text" class="form-control @error( 'name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Product name">
    @error('name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
  </div>
</div>
<div class="mb-3">
  <label for="slug">URL slug</label>
  <div>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ old ('slug', $product->slug) }}" placeholder="URL slug">
    @error('slug')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
</div>

<div class="form-floating mb-3">
  <label for="Desription">Desription</label>
  <textarea class="form-control" id="description" name="Desription" placeholder="Desription">{{ old ('Desription', $product->Desription) }}</textarea>
</div>
<div class="form-floating mb-3">
  <label for="short_Desription">Short Desription</label>
  <textarea class="form-control" id="short_Description" name="short_Desription" placeholder="short_Desription">{{ old ('short_Description', $product->short_Description) }}</textarea>
</div>
  </div>
  <div class="col md-4">
  <div class="form-floating mb-3">
  <label for="status">status</label>
  <div>
  
    @foreach ($status_options as $value => $label)
    <div class="form-check">
  <input class="form-check-input" @checked($label == old('status', $product->status)) type="radio" name="status" id="status_{{ $value }}" value="{{ $value }}" >
  <label class="form-check-label" for="status_{{ $value }}">
    {{$label}}
  </label>
</div>
    @endforeach
  
</div>
  </div>
  <div class="form-floating mb-3">
  <label for="category_id">Category</label>
  <div>
  <select name="category_id" id="category_id" class="form-select form-control">
    @foreach ($categories as $category)
    <option></option>
    <option @selected($category->id == old('category_id', $product->category_id))  value="{{ $category->id}}">{{ $category->name }}</option>
    @endforeach
  </select>

</div>
  </div>
  <div class="form-floating mb-3">
  <label for="Price">Product Price</label>
  <input type="number" step="0.1" min="0" class="form-control" id="price" name="price" value="{{ old ('price', $product->price) }}" placeholder="Product Price">
</div>
<div class="form-floating mb-3">
  <label for="compare_Price">Compare Price</label>
  <input type="number" step="0.1" min="0" class="form-control" id="compare_price" name="compare_price" value="{{ old('compare_price', $product->compare_price) }}" placeholder="Compare Price">
</div>
<div class="form-floating mb-3">
  <label for="image">Product Image</label>
  <input type="file" class="form-control" id="image" name="image" placeholder="Compare Product Image">
</div>
  </div>
</div>


<button type="submit" class="btn btn-primary">{{ $submit_label ?? 'save' }}</button>