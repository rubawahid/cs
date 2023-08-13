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
    <x-form.input lable="category Name" id="name" name="name" value="{{ $category->name }}" />

    <x-form.input lable="URL slug" id="slug" name="slug" value="{{ $category->slug }}" />


    <x-form.textarea id="description" name="desription" lable="Desription" value="{{ $category->desription }}" />
    <x-form.textarea id="short_description" name="short_desription" lable="Short Desription" value="{{ $category->short_desription }}" />

  <div class="mb-3">
    <label for="image">category Image</label>
    <div>
      <input type="file" class="form-control" id="gallery" name="gallery[]" multiple placeholder="category Gallery">
    </div>
  </div>
</div>
@if($gallery ?? false)
<div class="row">
  @foreach($gallery as $image)
  <div class="col-md-3">
    <img src=" {{ $image->url }} " class="img-fluid" alt="">
  </div>
  @endforeach
</div>
@endif
<div class="col md-4">
  <div class="form-floating mb-3">
    <label for="status">status</label>
    <div>
      @foreach ($status_options as $value => $label)
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="status_{{ $value }}" @checked($value==old('status', $category->status))>
        <label class="form-check-label" for="status_{{ $value }}">
          {{$label}}
        </label>
      </div>
      @endforeach

    </div>
  </div>
  <x-form.select  name="category_id" id="category_id" lable="Category" :value="$category->category_id" :options="$categories->pluck('name', 'id')" />
  
  <x-form.input type="number" lable="price" id="price" name="price" value="{{ $category->price }}" />

  <x-form.input type="number" lable="Compare price" id="Compare_price" name="Compare_price" value="{{ $category->Compare_price }}" />


  <div class="form-floating mb-3">
    <img src="{{  $category->image_url }}" width="100" alt="">

    <input type="file" class="form-control" id="image" name="image" placeholder="Compare category Image">
    <label for="image">category Image</label>
  </div>
</div>
</div>


<button type="submit" class="btn btn-primary">{{ $submit_label ?? 'save' }}</button>