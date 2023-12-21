<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Community;
use App\Models\CommunityMembers;
use Illuminate\Http\Request;
use App\Models\CommunityPost;

class CommunityController extends Controller
{
 public function index(){
    $data['communities'] = Community::whereAuthorId(session('author_id'))->get();
    $data['latest_communities'] = Community::orderBy('id','desc')->get();
    return view('frontend.pages.author.community.index',$data);
 }
 public function create_community(Request $request){

    $request->validate([
        'community_name' => 'required'
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



    return redirect()->back()->with('msg','Community added successfully.');
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
}
