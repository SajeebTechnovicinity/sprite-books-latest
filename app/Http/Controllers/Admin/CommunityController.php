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
    public function edit_community($communityId){

        $community = Community::find($communityId);
        return view("backend.pages.community.edit", compact('community'));
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
    public function delete_community($communityId){

        $community = Community::find($communityId);
        $community->community_status = 0;
    
        $community->save();
    
        return redirect()->back()->with('success', 'Community delete successfully');
     }
}
