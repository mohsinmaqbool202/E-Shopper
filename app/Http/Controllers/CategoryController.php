<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();

            if(empty($data["status"])){
                $status = 0;
            }
            else
            {
                $status = 1;
            }

    		$category = new Category;
    		$category->name = $data['name'];
            $category->parent_id = $data['parent_id'];
    		$category->description = $data['description'];
    		$category->url = $data['url'];
            $category->meta_title  = $data['meta_title'];
            $category->meta_description  = $data['meta_description'];
            $category->meta_keywords  = $data['meta_keywords'];
            $category->status = $status;
    		$category->save();

    		return redirect('/admin/view-category')->with('flash_message_success', "Category Added.");
    	}

        $levels = Category::where('parent_id', 0)->get();
    	return view('admin.categories.add_category', compact('levels'));
    }

    public function viewCategories()
    {
    	$categories = Category::all();
    	return view('admin.categories.view_categories', compact('categories'));
    }

    public function editCategory(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            if(empty($request["status"])){
                $status = 0;
            }
            else{
                $status = 1;
            }
            
            $category              = Category::findOrFail($id);
            $category->name        = $request->name;
            $category->parent_id   = $request->parent_id;
            $category->description = $request->description;
            $category->url         = $request->url;
            $category->meta_title      = $data['meta_title'];
            $category->meta_description  = $data['meta_description'];
            $category->meta_keywords   = $data['meta_keywords'];
            $category->status      = $status;
            
            $category->save();
            return redirect('/admin/view-category')->with('flash_message_success', "Category Updated.");
        }

        $category = Category::findOrFail($id);
        $levels = Category::where('parent_id', 0)->get();
        return view('admin.categories.edit_category', compact('category', 'levels'));
    }


    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
        return redirect('/admin/view-category')->with('flash_message_success', "Sub Category Deleted.");
    }
}
