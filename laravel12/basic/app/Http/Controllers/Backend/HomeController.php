<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

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
            'title' = $request->title,
            'icon' => $request->icon,
            'description' => $request->description
        ]);

        $notif = array(
            'message' => 'Feature inserted successfuly !',
            'alert-type' => 'success'
        );

        return redirect()->route('all.features')->with($notif)
    }

}
