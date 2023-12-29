<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $data['author'] = Author::find(session('author_id'));
        $data['blogs'] = Blog::whereAuthorId(session('author_id'))->get();
        return view('frontend.pages.author.blog.index',$data);
    }
    
    public function show($id){
        $data['blog'] = Blog::find($id);
    //   print_r($data['event']);die;
      return view('frontend.pages.author.blog.edit',$data);
    }
    
    public function store(Request $request){

        $request->validate([
            'blog_name' => 'required',
            'blog_full_description' => 'required',
            'blog_image' => 'nullable|mimes:jpg,png|max:512',
        ], [
            'blog_name.required' => 'The blog name field is required.',
            'blog_full_description.required' => 'The blog full description field is required.',
            'blog_image.mimes' => 'The blog image must be a JPG or PNG file.',
            'blog_image.max' => 'The blog image must not exceed 512 KB in size.',
        ]);

        // echo '<pre>';print_r($request->all());die;
        $blog = new Blog;
        $blog->blog_name = $request->blog_name;
        $blog->author_id = session('author_id');
        $blog->blog_short_description = $request->blog_short_description;
        $blog->blog_full_description = $request->blog_full_description;
        $blog->usertype =session('type');
        $blog->author_id =session('author_id');
        $blog->status =0;
        
        if($request->blog_image){

            if (isset($request->blog_image)) {
                $file = $request->file('blog_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $blog->blog_image = $data['path'];
            }
           
        }
    
        
        $blog->save();
    
        return redirect()->back()->with('msg','Blog added successfully.');
     }
    
     public function update_blog(Request $request){
        $request->validate([
            'blog_name' => 'required',
            'blog_full_description' => 'required',
            'blog_image' => 'nullable|mimes:jpg,jpeg,png|max:512',
        ], [
            'blog_name.required' => 'The blog name field is required.',
            'blog_full_description.required' => 'The blog full description field is required.',
            'blog_image.mimes' => 'The blog image must be a JPG or PNG file.',
            'blog_image.max' => 'The blog image must not exceed 512 KB in size.',
        ]);
    
        // echo '<pre>';print_r($request->all());die;
        $blog = Blog::find($request->blog_id);
        $blog->blog_name = $request->blog_name;
        $blog->author_id = session('author_id');
        $blog->blog_short_description = $request->blog_short_description;
        $blog->blog_full_description = $request->blog_full_description;

        

        if($request->blog_image){

            if (isset($request->blog_image)) {
                $file = $request->file('blog_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $blog->blog_image = $data['path'];
            }
           
        }
        $blog->save();
    
        return redirect()->back()->with('msg','Blog Updated successfully.');
    
     }

     public function delete_blog($id){
        if(session('author_id') && session('type') == 'AUTHOR')
        {
        Blog::find($id)->delete();
        return redirect()->back()->with('msg','Blog permanently  deleted successfully.');
        }
     }
    
}
