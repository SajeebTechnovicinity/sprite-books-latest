<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Community;
use App\Models\CommunityPost;
use App\Models\CommunityPostComment;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        $data['list'] = Community::where('community_status', 1)->orderBy('id', 'desc')->get();
        return view("backend.pages.community.index", $data);
    }
    public function edit_community($communityId){

        $community = Community::find($communityId);
        return view("backend.pages.community.edit", compact('community'));
    }
    public function edit_post($postId){

        $communityPost = CommunityPost::find($postId);
        return view("backend.pages.community.post-edit", compact('communityPost'));
    }
    public function update_community(Request $request,$communityId){

        $request->validate([
            'community_name' => 'required',
            'file_updoad' => 'nullable|mimes:jpg,png|max:512',
        ], [
            'community_name.required' => 'The community name field is required.',
            'file_updoad.mimes' => 'The community image must be a JPG or PNG file.',
            'file_updoad.max' => 'The community image must not exceed 512 KB in size.',
        ]);
    
        $community = Community::find($communityId);
        $community->community_name = $request->community_name;
        $community->community_description = $request->community_description;
    
        if($request->file_updoad){
    
    
            if (isset($request->file_updoad)) {
                $file = $request->file('file_updoad');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $community->community_cover_image = $data['path'];
            }
            $community->save();
        }
    
        $community->save();
    
        return redirect()->back()->with('success','Community updated successfully.');
    }
    public function update_post(Request $request,$communityPostId){

        $request->validate([
            'title' => 'required',
            'file_updoad' => 'nullable|mimes:jpg,png|max:512',
        ], [
            'community_name.required' => 'The community name field is required.',
            'file_updoad.mimes' => 'The community image must be a JPG or PNG file.',
            'file_updoad.max' => 'The community image must not exceed 512 KB in size.',
        ]);
    
        $community = CommunityPost::find($communityPostId);
        $community->post = $request->title;
    
        if($request->file_updoad){
    
    
            if (isset($request->file_updoad)) {
                $file = $request->file('file_updoad');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $community->post_image = $data['path'];
            }
            $community->save();
        }
    
        $community->save();
    
        return redirect()->back()->with('success','Post updated successfully.');
    }
    public function create_community(){
        $authors=Author::where('is_delete',0)->get();
        return view("backend.pages.community.create",compact('authors'));
    }
    public function store_community(Request $request){

        $request->validate([
            'community_name' => 'required',
            'file_updoad' => 'nullable|mimes:jpg,png|max:512',
        ], [
            'title.required' => 'The post field is required.',
            'file_updoad.mimes' => 'The community image must be a JPG or PNG file.',
            'file_updoad.max' => 'The community image must not exceed 512 KB in size.',
        ]);
    
        $community = new Community();
        $community->community_name = $request->community_name;
        $community->author_id = $request->author_id;
        $community->community_description = $request->community_description;
    
        if($request->file_updoad){
    
    
            if (isset($request->file_updoad)) {
                $file = $request->file('file_updoad');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $data['path'] = 'public/uploads/' . $filename;
                $community->community_cover_image = $data['path'];
            }
            $community->save();
        }
    
        $community->save();
    
        return redirect()->back()->with('success','Community created successfully.');
    }
    public function delete_community($communityId){

        $community = Community::find($communityId);
        $community->community_status = 0;
    
        $community->save();
    
        return redirect()->back()->with('success', 'Community delete successfully');
     }
     public function community_post($id)
     {
         $data['list'] = CommunityPost::where('community_id',$id)->orderBy('id', 'desc')->get();
         return view("backend.pages.community.post", $data);
     }
     public function community_comment($id)
     {
         $data['list'] = CommunityPostComment::where('post_id',$id)->orderBy('id', 'desc')->get();
         return view("backend.pages.community.comment", $data);
     }
     public function delete_post($communityPostId){

       CommunityPost::where('id',$communityPostId)->delete();
       CommunityPostComment::where('post_id',$communityPostId)->delete();
    
    
        return redirect()->back()->with('success', 'Post delete successfully');
     }
    public function edit_comment($commentId){

        $communityPostComment = CommunityPostComment::find($commentId);
        return view("backend.pages.community.comment-edit", compact('communityPostComment'));
    }
    public function update_comment(Request $request,$communityPostCommentId){

        $request->validate([
            'title' => 'required',
            'file_updoad' => 'nullable|mimes:jpg,png|max:512',
        ], [
            'title.required' => 'The comment field is required.',
            'file_updoad.mimes' => 'The community image must be a JPG or PNG file.',
            'file_updoad.max' => 'The community image must not exceed 512 KB in size.',
        ]);
    
        $community = CommunityPostComment::find($communityPostCommentId);
        $community->comment = $request->title;
    
    
        $community->save();
    
        return redirect()->back()->with('success','Comment updated successfully.');
    }
    public function delete_comment($communityPostCommentId){

        CommunityPostComment::where('id',$communityPostCommentId)->delete();
     
     
         return redirect()->back()->with('success', 'Comment delete successfully');
      }
}
