<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\categoryRequest;
use App\Models\Category;
use App\Models\category;
use App\Models\categoryImage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class categoriesController extends Controller
{
    public function __construct(Request $request)
    {
        if ($request->method() == 'GET') {
        $categories = Category::all(); // Collection (array)
       View::share([
        'categories' => $categories,
        'status_options' => Product::statusOptions(),
       ]);
    }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $categories= DB::table('categories')
        // ->leftJoin('categories', 'categories.id', '=', 'categories.category_id')
        //->select([
        // 'categories.*',
        // 'categories.name as category_name',
        // ])
        // ->get(); //array
        // SELECT * FROM categories
        $products = Product::leftJoin('categories', 'categories.id', '=', 'categories.category_id')
            ->select([
                'product.*',
                'categories.name as category_name',
            ])
            ->filter($request->query())
            ->paginate(2); //collection of Product model


        return view('admin.categories.index', ['title' => 'categories list', 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create', [
            'product' => new Product(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(categoryRequest $request)
    {

        //$rules = $this->rules();
        // $messages = $this->messages();
        // $request->validate($rules, $messages);

        // mass assignment
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // return UploadedFile object
            $path = $file->store('uploads', 'public'); //return file path after store
            $data['image'] = $path;
        }
        $date['user_id'] = Auth::id();
        $product = product::create($data);

        if ($request->hasfile('gallery')) {
            //array of UploadFile
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', 'public'),
                ]);
            }
        }

        // $category = new category();
        // $category->name = $request->input('name');
        // $category->slug = $request->input('slug1');
        // $category->category_id = $request->input('category_id');
        // $category->description = $request->input('description');
        // $category->short_descriptions = $request->input('short_Description');
        // $category->price = $request->input('price');
        // $category->compare_price = $request->input('compare_price');
        // $category->status = $request->input('status', 'active');
        // $category->save();
        // prg: post redirect get
        return redirect()
            ->route('categories.index')
            ->with('success', "category({$category->name}) created");  // Add flash message with name=success






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
    public function edit(category $category)
    {
        //$category = category::where('id', '=', $id)->first(); // return Model
        // if (!$category) {
        // abort(404);
        // }
        // $category = category::findOrfail($id); // return Model object or Null
        //$gallery = ProductImage::Where('product_id', '=', $product->id)->get();
        return view('admin.categories.edit', [
            'product' => $product,
            'gallery' => $product->gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoryRequest $request, string $id)
    {
        //$rules = $this->rules($id);
        // $messages = $this->messages();
        //$request->validate($rules, $messages);




        $category = category::findOrfail($id);
        // Mass assignment
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // return UploadedFile object
            $path = $file->store('uploads', 'public'); //return file path after store
            $data['image'] = $path;
        }
        $old_image = $category->image;
        $category->update($data);
        if ($old_image && $old_image != $category->image) {
            Storage::disk('public')->delete($old_image);
        }

        if ($category->hasfile('gallery')) {
            //array of UploadFile
            foreach ($request->file('gallery') as $file) {
                categoryImage::create([
                    'category_id' => $category->id,
                    'image' => $file->store('uploads/images', 'public'),
                ]);
            }
        }
        // $category->name = $request->input('name');
        // $category->slug = $request->input('slug1');
        //$category->category_id = $request->input('category_id');
        // $category->description = $request->input('description');
        //$category->short_description = $request->input('short_description');
        // $category->price = $request->input('price');
        //$category->compare_price = $request->input('compare_price');
        // $category->status = $request->input('status', 'active');
        // $category->save();
        // prg: post redirect get
        return redirect()
            ->route('categories.index')
            ->with('success', "category({$category->name}) update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        // category::where('id', '=', $id)->delete();
        // category::destroy($id);

        //  $category = category::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', "category({$category->name}) deleted");
    }

    public function trashed()
    {
        $categories = $category = category::onlyTrashed()->paginate();
        return view('admin.categories.trashed', [
            'categories' => $categories
        ]);
    }
    public function restore($id)
    {
        $category = category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()
            ->route('categories.index')
            ->with('success', "category ({$category->name}) restored");
    }

    public function forceDelete($id)
    {
        $category = category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()
        ->route('categories.index')
        ->with('success', "category ({$category->name}) deleted forover!");
    }

    protected function messages()
    {
        return [
            'required' => ':attribute field is required!!',
            'unique' => 'The value alredy exists!',
            'name.required' => 'The category name is mandatory!',

        ];
    }

    protected function rules($id = 0)
    {
        return [
            'name' => 'required|max:255|min:3',
            'slug' => 'required|unique:categories,slug',
            'category_id' => 'nullable|int|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gt:price',
            'image' => 'nullable|image|max:1024',
            'status' => 'required|in:active,draft,archived',

        ];
    }
}
