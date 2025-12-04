<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AllProductCategories()
    {
        $categories = ProductCategory::latest()->get();
        return view('admin.backend.category.all_categories', compact('categories'));
    }

    public function StoreProductCategory(Request $request){
        $request->validate([
            'cat_name' => 'required|unique:product_categories,name',
        ]);

        ProductCategory::create([
            'name' => $request->cat_name,
            'slug' => strtolower(str_replace(' ', '-', $request->cat_name)),
        ]);

        $notification = array(
            'message' => 'Product Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
