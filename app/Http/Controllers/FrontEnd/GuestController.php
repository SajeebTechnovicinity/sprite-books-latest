<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Newsteller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    public function subscribe(Request $request)
    {
        // $request->validate([
        //     'email'=>'required|unique:newstellers'
        // ]);
        if(!$request->email || Newsteller::where('email',$request->email)->exists())
        {
            //Session::flash('wrong','Email is required and Email is unique');
            return 'Email is required and Email is unique';
        }

        Newsteller::create([
            'email'=>$request->email
        ]);
       //Session::flash('success','Successfully subscribed');
        return 'Successfully subscribed';
    }
}
