<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        ]);

        return view('admin.products.index', ['title' => 'Products list', 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // SELECT * FROM products
       return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->slug = $request->input('slug1');
        $product->description = $request->input('description');
        $product->short_description = $request->input('short_description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        //$product->save();
         // prg: post redirect get
        return redirect()->route('products.index'); // GET



        


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
