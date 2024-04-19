<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $data['list'] = Blog::all();
    return view('backend.pages.blog.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
    return view('backend.pages.blog.create');
    }
    public function approve($id)
    {    
        Blog::find($id)->update([
            'status'=>1
        ]);
        return redirect()->back()->with('success','Blog approved successfully.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'blog_name' => 'required',
            'blog_full_description' => 'required'
        ]);
    
        // echo '<pre>';print_r($request->all());die;
        $blog = new Blog;
        $blog->blog_name = $request->blog_name;
        $blog->author_id = session('author_id');
        $blog->blog_short_description = $request->blog_short_description;
        $blog->blog_full_description = $request->blog_full_description;
        $blog->meta_title=$request->meta_title;
        $blog->meta_description=$request->meta_description;
        $blog->meta_keyword=$request->meta_keyword;

        

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['blog'] = Blog::find($id);       
//        echo '<pre>';print_r($data);die;
        return view("backend.pages.blog.show", $data);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blog'] = Blog::find($id);
//        echo '<pre>';print_r($data);die;
        return view("backend.pages.blog.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'blog_name' => 'required'
        ]);
    
        // echo '<pre>';print_r($request->all());die;
        $blog = Blog::find($request->blog_id);
        $blog->blog_name = $request->blog_name;
        $blog->author_id = session('author_id');
        $blog->blog_short_description = $request->blog_short_description;
        $blog->blog_full_description = $request->blog_full_description;
        $blog->meta_title=$request->meta_title;
        $blog->meta_description=$request->meta_description;
        $blog->meta_keyword=$request->meta_keyword;

        

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
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete();
        return redirect()->back()->with('msg','Blog permanently  deleted successfully.');
    }
}
