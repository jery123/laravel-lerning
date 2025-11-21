<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function BlogCategory(){
        $category = BlogCategory::latest()->get();
        return view('admin.backend.blogcategory.blog_category', compact('category'));
    }
    // End Method

    public function StoreBlogCategory(Request $request){
        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);

        $notif = array(
            'message' => "Blog Category inserted successfull",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notif);
    }
    // End Method

    public function EditBlogCategory($id){
        $category = BlogCategory::find($id);

        return response()->json($category);
    }
    // End Method

    public function UpdateBlogCategory(Request $request){
        $cat_id = $request->cat_id;

        BlogCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);

        return redirect()->back()->with([
            'message' => 'Blog Category Updated Successfully!',
            'alert-type' => 'success'
        ]);
    }
    // End Method

    public function DeleteBlogCategory($id){
        BlogCategory::find($id)->delete();
        return redirect()->back()->with([
            'message' => 'BlogCategory Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
    // End Method

    public function AllBlogPost(){
        $posts = BlogPost::latest()->get();
        return view('admin.backend.post.all_post', compact('posts'));
    }
    // End Method

    public function AddBlogPost() {
        $blogcat = BlogCategory::latest()->get();
        return view('admin.backend.post.add_post', compact('blogcat'));
    }
    // End Method

    public function StoreBlogPost(Request $request){
        if($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(746, 500)->save(public_path('upload/post/'. $name_gen));
            $save_url = 'upload/post/' . $name_gen;

            BlogPost::create([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_description' => $request->long_description,
                'image' => $save_url
            ]);
        }

        return redirect()->route('all.blog.post')->with([
            'message' => 'Blog Post Added Succefully',
            'alert-type' => 'success',
        ]);
    }
    // End Method

    public function EditBlogPost($id){
        $blogcat = BlogCategory::latest()->get();
        $post = BlogPost::find($id);
        return view('admin.backend.post.edit_post', compact('post', 'blogcat'));
    }
    // End Method

    public function UpdateBlogPost(Request $request){
        $post_id = $request->id;

        $post = BlogPost::find($post_id);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(746, 500)->save(public_path('upload/post/' . $name_gen));
            $save_uri = 'upload/post/' . $name_gen;

            if(file_exists(public_path($post->image))){
                @unlink(public_path($post->image));
            }
            
            $post->update([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' =>strtolower(str_replace(' ', '-', $request->post_title)),
                'long_description' => $request->long_description,
                'image' => $save_uri
            ]);

        }else{
            $post->update([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' =>strtolower(str_replace(' ', '-', $request->post_title)),
                'long_description' => $request->long_description,
            ]);
        }
        $notif = array(
            'message' => 'Post updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notif);
    }
    // End Method

    public function DeleteBlogPost($id) {
        $post = BlogPost::find($id); 
        @unlink($post->image);

        $post->delete();

        return redirect()->back()->with([
            'message' => 'Blog Post deleted successfully',
            'alert-type' => 'success'
        ]);
    }

}
