<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('admin.backend.brand.all_brand', compact('brands'));
    }

    public function AddBrand()
    {
        return view('admin.backend.brand.add_brand');
    }

    public function StoreBrand(Request $request){
        if($request->file('image')){
            $image = $request->file('image');

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image)->resize(100, 90)
            ->save(public_path('upload/brands/'.$name_gen));
            $save_url = 'upload/brands/'.$name_gen;

            Brand::create([
                'name' => $request->name,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand Inserted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        }
    }

    // Edit Brand
    public function EditBrand($id){
        $brand = Brand::findOrFail($id);
        return view('admin.backend.brand.edit_brand', compact('brand'));
    }

    // Update Brand
    public function UpdateBrand(Request $request){
        $brand_id = $request->id;
        $brand = Brand::findOrFail($brand_id);

        if($request->file('image')){
            $image = $request->file('image');

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            $img = $manager->read($image)->resize(100, 90);
            $img->save(public_path('upload/brands/'.$name_gen));
            $save_url = 'upload/brands/'.$name_gen;

            if(file_exists($brand->image)){
                @unlink($brand->image);
            }
            $brand->image = $save_url;
            $message = 'Brand Updated with Image Successfully';
        }

        $brand->name = $request->name;
        $brand->save();

        $notif = array(
            'message' => isset($message) ? $message : 'Brand Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notif);

    }

    // Delete Brand
    public function DeleteBrand($id){
        $brand = Brand::findOrFail($id);
        if(file_exists($brand->image)){
            @unlink($brand->image);
        }
        $brand->delete();

        $notif = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif);
    }
}
