<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Supplier;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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

    public function EditProductCategory($id){
        $category = ProductCategory::findOrFail($id);
        return response()->json($category);
    }

    public function UpdateProductCategory(Request $request){
        $category_id = $request->id;

        $request->validate([
            'cat_name' => 'required|unique:product_categories,name,'.$category_id,
        ]);

        ProductCategory::findOrFail($category_id)->update([
            'name' => $request->cat_name,
            'slug' => strtolower(str_replace(' ', '-', $request->cat_name)),
        ]);

        $notification = array(
            'message' => 'Product Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteProductCategory($id){
        ProductCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Product Methods
     */
    public function AllProduct(){
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.backend.product.all_products', compact('products'));
    }

    public function AddProduct(){
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        return view('admin.backend.product.add_product', compact('categories', 'brands', 'suppliers', 'warehouses'));
    }

    public function StoreProduct(Request $request){
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'supplier_id' => $request->supplier_id,
            'warehouse_id' => $request->warehouse_id,
            'code' => $request->code,
            'price' => $request->price,
            'stock_alert' => $request->stock_alert,
            'note' => $request->note,
            'product_qty' => $request->product_qty,
            // 'discount' => $request->discount,
            'status' => $request->status,
            // 'active' => $request->active,
            'created_at' => now()
        ]);

        $product_id = $product->id;

        //  Multiple image
        if($request->hasFile('image')){
            foreach($request->file('image') as $img) {
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                $image = $manager->read($img)->resize(150, 150)->save(public_path('upload/product/'.$name_gen));
                $saved_url = 'upload/product/'.$name_gen;

                ProductImage::create([
                    'product_id' => $product_id,
                    'name' => $saved_url,
                    'created_at' => now(),
                ]);


                $notif = array(
                    'message' => 'Product Inserted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.product')->with($notif);


            }
        }
    }

    public function EditProduct($id){
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        $images = ProductImage::where('product_id', $id)->get();
        return view('admin.backend.product.edit_product', compact('product', 'categories', 'brands', 'suppliers', 'warehouses', 'images'));
    }

    public function UpdateProduct(Request $request){
        $product_id = $request->id;

        $product = Product::findOrFail($product_id);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'supplier_id' => $request->supplier_id,
            'warehouse_id' => $request->warehouse_id,
            'code' => $request->code,
            'price' => $request->price,
            'stock_alert' => $request->stock_alert,
            'note' => $request->note,
            'product_qty' => $request->product_qty,
            // 'discount' => $request->discount,
            'status' => $request->status,
            // 'active' => $request->active,
            'updated_at' => now()
        ]);

        if($request->hasFile('image')){
            foreach($request->file('image') as $img) {
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                $image = $manager->read($img)->resize(150, 150)->save(public_path('upload/product/'.$name_gen));

                $product->images()->create([
                    'name' => 'upload/product/'.$name_gen
                ]);
            }
        }

        if($request->has('remove_image')){
            foreach($request->remove_image as $removeImageId){
                $image = ProductImage::findOrFail($removeImageId);
                if($image && file_exists(public_path($image->name))){
                    unlink(public_path($image->name));
                }
                $image->delete();
            }
        }

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function DeleteProduct($id){
        $product = Product::findOrFail($id);

        $images = ProductImage::where('product_id', $id)->get();
        foreach($images as $img){
            if(file_exists(public_path($img->name))){
                unlink(public_path($img->name));
            }
            $img->delete();
        }

        $product->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DetailsProduct($id){
        $product = Product::findOrFail($id);
        $images = ProductImage::where('product_id', $id)->get();
        return view('admin.backend.product.details_product', compact('product', 'images'));
    }
}
