<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clarify;
use App\Models\Connect;
use App\Models\Faq;
use App\Models\App;
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

    /**
     * Connect
     */
    public function GetConnect(){
        $connects = Connect::latest()->get();
        return view('admin.backend.connect.all_connect', compact('connects'));
    }
    public function AddConnect(){
        return view('admin.backend.connect.add_connect');
    }
    public function StoreConnect(Request $request){
        Connect::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $notif = array(
            'message' => 'Connect Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('get.connects')->with($notif);
    }
    public function EditConnect($id){
        $connect = Connect::find($id);
        return view('admin.backend.connect.edit_connect', compact('connect'));
    }
    public function UpdateConnect(Request $request){
        $connect_id = $request->id;
        $connect = Connect::find($connect_id);

        $connect->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $notif = array (
            'message' => 'Connect updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('get.connects')->with($notif);
    }
    public function DeleteConnect($id){
        Connect::find($id)->delete();

        $notif = array(
            'message' => 'Connect deleted successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notif);
    }
    public function ModifyConnect(Request $request, $id){
        $connect = Connect::findOrFail($id);

        $connect->update($request->only(['title', 'description']));
        return response()->json(['success'=>true, 'message'=>'Updated successfully']);
    }
    /**End Connect */

    /**
     * Faq Section
     */
    public function GetFaqs(){
        $faqs = Faq::latest()->get();

        return view('admin.backend.faqs.get_faqs', compact('faqs'));
    }
    public function AddFaq(){
        return view('admin.backend.faqs.add_faq');
    }
    public function StoreFaq(Request $request){
        Faq::create([
            'title'=>$request->title,
            'description'=>$request->description
        ]);

        $notif = array(
            'message'=> 'Faq added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('get.faqs')->with($notif);
    }

    public function EditFaq($id){
        $faq = Faq::find($id);

        return view('admin.backend.faqs.edit_faq', compact('faq'));
    }

    public function UpdateFaq(Request $request){
        $faq = Faq::find($request->id);

        $faq->update($request->only(['title', 'description']));

        $notif = array(
            'message'=>'Faq updated with success',
            'alert-type' => 'success'
        );

        return redirect()->route('get.faqs')->with($notif);
    }

    public function DeleteFaq($id){
        Faq::find($id)->delete();

        $notif = array(
            'message'=>'Faq delete with success',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif);
    }
    /**End Faq */

    /**
     * App Section
     */
    public function ModifyApp(Request $request, $id){
        $app = App::find($id);

        $app->update($request->only(['title', 'description']));

        return response()->json(
            [
                'success' => true,
                'message' => 'Updated successfully'
            ]
        );
    }

    public function UpdateAppImage(Request $request, $id){
        $app = App::findOrFail($id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(306, 481)->save(public_path('upload/apps/'.$name_gen));
            $save_url = 'upload/apps/'.$name_gen;

            if(file_exists(public_path($app->image))){
                @unlink(public_path($app->image));
            }

            $app->update([
                'image'=>$save_url
            ]);

            return response()->json([
                'success' => true,
                'image_url' => asset($save_url),
                'message' => 'Image updated successfully',
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Image updated failed',
        ], 400);
    }
    /**End App */
}
