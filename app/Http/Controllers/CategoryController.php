<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $categories = Category::where('user_id', Auth::user()->id)->get();
         $categoriesCount = $categories->count();
         return response()->json(['data'=> $categories, 'count'=> $categoriesCount], 200);
    }



     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'name' => 'required|max:255',
        ])->validate();


        $category = Category::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);
        return response()->json(['data' => $category], 201);
        /* $category = Category::create([
            'name' => $request->nombre
        ]) */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
        ])->validate();

        $category->update($request->all());

        return response()->json(['data' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('Ok');
    }
}
