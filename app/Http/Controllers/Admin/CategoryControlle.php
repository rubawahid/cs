<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryControlle extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index', ['title'=>'categories list', 'categories'=>$categories,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', [
            'category' => new Category(),
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
    public function store(Request $request)
    {
        $categories=new Category();
        $categories->name = $request->input('name');
        $categories->save();
        return redirect()->route('admin.categories.index');
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
