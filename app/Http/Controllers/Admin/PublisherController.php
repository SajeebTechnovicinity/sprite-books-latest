<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\AuthorMembershipPlan;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PublisherController extends Controller
{
    public function index()
    {
    $data['list'] = Author::whereType('PUBLISHER')->where('is_delete',0)->orderBy('id','desc')->get();
    $data['country_list'] = Country::all();
    return view("backend.pages.publisher.index", $data);
    }



    public function store(Request $request)
    {
        // if(Auth::user()->can('add-author')) {
         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);
        $authorInfo= Author::where('author_email',$request->email)->first();
        if($authorInfo){
            return 'emailUsed';
        }

            $authorId = Author::orderBy('id','desc')->first()->id;

        $author = Author::create([
            'author_name' => $request->name,
            'author_code' => 10000+$authorId,
            'author_last_name' => $request->last_name,
            'type' => 'PUBLISHER',
            'author_country' => $request->country,
            'author_email_verification' => 1,
            'author_phone' => $request->phone,
            'author_email' => $request->email,
            'author_password' => Hash::make($request->password)
        ]);

        AuthorMembershipPlan::create([
            'author_id'=>$author->id,
            'membership_plan_id'=>3,
            'type'=>'PUBLISHER',
            'monthly_yearly'=>'1',
            'duration'=>"Yearly"
        ]);


        return ['data'=>$author,'status'=>1];
        // }
    }

}
