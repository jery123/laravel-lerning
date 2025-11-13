<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clarify;
use App\Models\Feature;
use App\Models\Financial;
use App\Models\Usability;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeController extends Controller
{

    public function AllFeatures(){
        $features = Feature::latest()->get();
        return view('admin.backend.feature.all_feature', compact('features'));
    }

    public function AddFeature(){
        return view('admin.backend.feature.add_feature');
    }
    public function StoreFeature(Request $request){
        Feature::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description
        ]);

        $notif = array(
            'message' => 'Feature inserted successfuly !',
            'alert-type' => 'success'
        );

        return redirect()->route('all.features')->with($notif);
    }

    public function EditFeature($id){
        $feature = Feature::find($id);
        return view('admin.backend.feature.edit_feature', compact('feature'));
    }

    public function UpdateFeature(Request $request){
        $feature_id = $request->id;

        Feature::find($feature_id)->update(
            [
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description
            ]
            );

            $notif = array(
                'message' => 'Feature updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.features')->with($notif);
    }

    public function DeleteFeature($id){
        Feature::find($id)->delete();

        $notif = array(
            'message' => 'Feature deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.features')->with($notif);
    }

    public function GetClarifies(){
        $clarify = Clarify::find(1);
        return view('admin.backend.clarify.get_clarify', compact('clarify'));
    }
    //End Method

     public function UpdateClarify(Request $request){
        $clarify_id = $request->id;
        $clarify = Clarify::find($clarify_id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(302,618)->save(public_path('upload/clarify/'.$name_gen));
            $save_url = 'upload/clarify/'.$name_gen;

            if(file_exists(public_path($clarify->image))){
                @unlink(public_path($clarify->image));
            }

            Clarify::find($clarify_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Clarify Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }else{
            Clarify::findOrFail($clarify_id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Clarify Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function GetFinancial(){
        $financial = Financial::find(1);
        return view('admin.backend.financial.get_financial', compact('financial'));
    }
    //End Method

     public function UpdateFinancial(Request $request){
        $financial_id = $request->id;
        $financial = Financial::find($financial_id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(307,619)->save(public_path('upload/financial/'.$name_gen));
            $save_url = 'upload/financial/'.$name_gen;

            if(file_exists(public_path($financial->image))){
                @unlink(public_path($financial->image));
            }

            Financial::find($financial_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'unified' => $request->unified,
                'real_time' => $request->real_time,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Financial Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }else{
            Financial::findOrFail($financial_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'unified' => $request->unified,
                'real_time' => $request->real_time,
            ]);

            $notification = array(
                'message' => 'Financial Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function GetUsability(){
        $usability = Usability::find(1);
        return view('admin.backend.usability.get_usability', compact('usability'));
    }
    //End Method

     public function UpdateUsability(Request $request){
        $usability_id = $request->id;
        $usability = Usability::find($usability_id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(560,height: 400)->save(public_path('upload/usability/'.$name_gen));
            $save_url = 'upload/usability/'.$name_gen;

            if(file_exists(public_path($usability->image))){
                @unlink(public_path($usability->image));
            }

            Usability::find($usability_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'youtube' => $request->youtube,
                'link' => $request->link,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Usability Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }else{
            Usability::findOrFail($usability_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'youtube' => $request->youtube,
                'link' => $request->link,
            ]);

            $notification = array(
                'message' => 'Usability Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }

    }
}
