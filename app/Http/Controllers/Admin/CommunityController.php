<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        $data['list'] = Community::where('community_status', 1)->orderBy('id', 'desc')->get();
        return view("backend.pages.community.index", $data);
    }
    public function delete_community($communityId){

        $community = Community::find($communityId);
        $community->community_status = 0;
    
        $community->save();
    
        return redirect()->back()->with('success', 'Community delete successfully');
     }
}
