<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $products= DB::table('products')
       // ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
        //->select([
           // 'products.*',
           // 'categories.name as category_name',
       // ])
       // ->get(); //array
        // SELECT * FROM products
        $products = Product::leftJoin('categories', 'categories.id', '=', 'products.category_id')
        ->select([
            'products.*',
            'categories.name as category_name',
        ])->get();
        

        return view('admin.products.index', ['title' => 'Products list', 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories = Category::all(); // Collection (array)
       return view('admin.products.create', [
        'product' => new Product(),
        'categories' => $categories,
        'status_options' => [
            'active' => 'Active',
            'draft' => 'Draft',
            'archived' => 'Archived',
        ],
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        //$rules = $this->rules();
       // $messages = $this->messages();
       // $request->validate($rules, $messages);


        $product = new Product();
        $product->name = $request->input('name');
        $product->slug = $request->input('slug1');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->short_descriptions = $request->input('short_Description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->status = $request->input('status', 'active');
        $product->save();
         // prg: post redirect get
        return redirect()
        ->route('products.index')
        ->with('success', "product({$product->name}) created");  // Add flash message with name=success



        


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       //$product = Product::where('id', '=', $id)->first(); // return Model
       // if (!$product) {
        // abort(404);
      // }
       $product = Product::findOrfail($id); // return Model object or Null
       $categories = Category::all();
       return view('admin.products.edit', [
        'product' => $product,
        'categories' => $categories,
        'status_options' => [
            'active' => 'Active',
            'draft' => 'Draft',
            'archived' => 'Archived',
        ],
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $rules = $this->rules($id);
        $messages = $this->messages();
        $request->validate($rules, $messages);

       


          $product = Product::findOrfail($id);
        $product->name = $request->input('name');
        $product->slug = $request->input('slug1');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->short_description = $request->input('short_description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->status = $request->input('status', 'active');
        $product->save();
         // prg: post redirect get
        return redirect()
        ->route('products.index')
        ->with('success', "product({$product->name}) update"); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Product::where('id', '=', $id)->delete();
       // product::destroy($id);

        $product = Product::findOrFail($id);
        $product->delete();

        

        return redirect()
        ->route('products.index')
        ->with('success', "product({$product->name}) deleted"); 
    }

    protected function messages()
    {
        return [
            'required' => ':attribute field is required!!',
            'unique' => 'The value alredy exists!',
            'name.required' => 'The product name is mandatory!',

        ];
    }

    protected function rules($id = 0)
    {
        return [
            'name' => 'required|max:255|min:3',
             'slug' => 'required|unique:products,slug',
             'category_id' => 'nullable|int|exists:categories,id',
             'description' => 'nullable|string',
             'short_description' => 'nullable|string|max:500',
             'price' => 'required|numeric|min:0',
             'compare_price' => 'nullable|numeric|min:0|gt:price',
             'image' => 'nullable|image|dimensions:min_width=400,min_height=300|max:1024',
             'status' => 'required|in:active,draft,archived',
  
        ];
    }
}
