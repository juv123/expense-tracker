<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('category.index',['categories'=>$categories]);
    }
    public function fetch(){
        try {
            $categories = Category::all();
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch categories'], 500);
        }
    }
    
    public function create(){
        return view('category.create');
    }
    public function save(Request $request)
{
    // Validate the request
    $request->validate([
        'category_name' => [
            'required',
            'string',
            'max:255',
            function ($attribute, $value, $fail) {
                if (\App\Models\Category::whereRaw('LOWER(category_name) = ?', [strtolower($value)])->exists()) {
                    $fail('The category name has already been taken.Please use other name');
                }
            },
        ],
        'description' => 'required|max:255|string',
    ]);

    // Create a new category
    Category::create([
        'category_name' => $request->category_name,
        'description' => $request->description,
    ]);

    // Redirect with a success message
    return redirect('categories/create')->with('status', 'A new Category has been added');
}

public function edit(int $id){
    $category=Category::findOrFail($id);
    return view('category.edit',["category"=>$category]);
}
public function update(Request $request,int $id){
    $request->validate([
        'category_name'=>'required|max:255|string',
        'description'=>'required|max:255|string'
    ]);
    Category::findOrFail($id)->update([
        'category_name'=>$request->category_name,
        'description'=>$request->description
    ]);
    return redirect()->back()->with('status','Category has been Updated');
}
public function delete(int $id){
    $category=Category::findOrFail($id);
    $category->delete();
    return redirect()->route('categories.index')->with('status','The Category has been Removed'); 

}
    
}
