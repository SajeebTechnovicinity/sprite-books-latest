<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Community;
use App\Models\CommunityMembers;
use Illuminate\Http\Request;
use App\Models\CommunityPost;
use Illuminate\Support\Facades\Redirect;

class CommunityController extends Controller
{
 public function index(){
    $data['communities'] = Community::whereAuthorId(session('author_id'))->where('community_status',1)->get();
    $data['latest_communities'] = Community::where('community_status',1)->orderBy('id','desc')->get();
    return view('frontend.pages.author.community.index',$data);
 }
 public function create_community(Request $request){

    $request->validate([
        'community_name' => 'required',
        'file_updoad' => 'nullable|mimes:jpg,png|max:2048',
    ], [
        'community_name.required' => 'The community name field is required.',
        'file_updoad.mimes' => 'The community image must be a JPG or PNG file.',
        'file_updoad.max' => 'The community image must not exceed 2 MB in size.',
    ]);

    $community = new Community;
    $community->community_name = $request->community_name;
    $community->author_id = session('author_id');
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



    return redirect()->back()->with('success','Community added successfully.');
 }

 public function view_community($id){
    $data['community'] = Community::find($id);
    $data['community_post'] = CommunityPost::whereCommunityId($id)->latest()->paginate(10);
    $data['community_members'] = CommunityMembers::whereCommunityId($id)->latest()->get();
    $data['current_user'] = Author::find(session('author_id'));
    return view('frontend.pages.community.index',$data);
 }

 public function join_community($communityId){
    if(session('author_id')){
        $newMember = new CommunityMembers;
        $newMember->type = 'USER';
        $newMember->community_id = $communityId;
        $newMember->joined_by = session('author_id');
        $newMember->user_id = session('author_id');
        $newMember->save();

        return redirect('community/'.$communityId);
    }
 }
 public function update_community(Request $request,$communityId){

    $request->validate([
        'community_name' => 'required',
        'file_updoad' => 'nullable|mimes:jpg,png|max:2048',
    ], [
        'community_name.required' => 'The community name field is required.',
        'file_updoad.mimes' => 'The community image must be a JPG or PNG file.',
        'file_updoad.max' => 'The community image must not exceed 2 MB in size.',
    ]);

    $community = Community::find($communityId);
    $community->community_name = $request->community_name;
    $community->author_id = session('author_id');
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
 public function delete_community($communityId){

    $community = Community::find($communityId);
    $community->community_status = 0;

    $community->save();

    return Redirect::to('author/community')->with('success', 'Community deleted successfully.');
 }

}
