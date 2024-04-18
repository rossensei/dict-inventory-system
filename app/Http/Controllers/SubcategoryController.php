<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        return inertia('Category/NewSubcategory', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        $request->validate([
            'subcatname' => 'required|string|unique:subcategories',
            'code' => 'required|unique:subcategories'
        ], [
            'subcatname.required' => 'The subcategory name field is required.',
            'subcatname.unique' => 'The subcategory name is already taken.',
        ]);

        Subcategory::create($request->all());

        return redirect(route('category.index'))->with('success', 'Subcategory has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        //
    }
}
