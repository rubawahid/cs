<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\categoryImage;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index()
    {

    }
    public function show($slug)
    {
      $category = category::active()
      ->withoutGlobalScope('owner')
      ->where('slug', '=', $slug)
      ->firstOrFail();

      $gallery = categoryImage::Where('category_id', '=', $category->id)->get();  


      return view('shop.categories.show', [
        'category' => $category,
        'gallery' => $gallery,
      ]);
    }
}
