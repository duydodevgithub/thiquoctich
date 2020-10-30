<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{    
    public function getCategory() {
        $result = Category::all();
        // return Response::json($result);
        return view('admin.category',['category' => $result]);
    }

    public function addCategory(Request $request) {
        $category = new Category();
        $category->name = $request->category_name;
        $category->save();

        return redirect()->route('admin.category');
    }

    public function deleteCategory($id) {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.category')->with('info', 'Category deleted');
    }
}
