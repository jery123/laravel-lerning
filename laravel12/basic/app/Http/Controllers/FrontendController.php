<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FrontendController extends Controller
{
    public function OurTeam()
    {
        return view('home.team.team_page');
    }
    // End Method

    public function AboutUs()
    {
        return view('home.about.about_us');
    }
    // End Method

    public function GetAboutUs()
    {
        $about = About::find(1);

        if($about){
            return view('admin.backend.about.get_about', compact('about'));
        }

        return view('admin.backend.about.get_about');
    }

    public function UpdateAboutUs(Request $request)
    {
        // Reading inputs
        $id = $request->id;
        $title = $request->title;
        $description = $request->description;

        // Handle the image
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver);
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(526, 550)->save(public_path('upload/about/'.$name_gen));
            $save_url = 'upload/about/'.$name_gen;
        }

        // check for the id input
        if (!$id) {
            //  Check if the image has been uploaded
            if(isset($save_url)){
                About::create([
                    'title' => $title,
                    'description' => $description,
                    'image' => $save_url,
                ]);
                $message = 'About Added with successfully!';
            }else{
                About::create([
                    'title' => $title,
                    'description' => $description,
                ]);
                $message = 'About Added without successfully!';
            }
        } else {
            $about = About::find($id);

            if(isset($save_url)){
                $about->update([
                    'title' => $title,
                    'description' => $description,
                    'image' => $save_url,
                ]);

                $message = 'About Updated with successfully!';
            }else{
                $about->update([
                    'title' => $title,
                    'description' => $description,
                ]);

                $message = 'About Updated without successfully!';
            }
        }

        $notif = array(
            'message' => $message,
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);
    }

}
