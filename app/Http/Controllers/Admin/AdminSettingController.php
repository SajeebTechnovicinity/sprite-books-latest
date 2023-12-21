<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConditionMessageSetting;
use App\Models\Newsteller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminSettingController extends Controller
{
    public function clientConditionSetting(){
        $message=ConditionMessageSetting::first();
        return view('backend.pages.settings.conditionMessageSetting')->with(compact('message'));
    }
    public function subscribeList()
    {
        $list=Newsteller::orderBy('id','desc')->get();
        return view('backend.pages.newsletter.index')->with(compact('list'));
    }
    public function clientConditionStore(Request $request){

        $msg=ConditionMessageSetting::first();
        if($msg){
            $condition=$msg;
        }else{
            $condition=new ConditionMessageSetting();
        }

        $condition->title=$request->title;
        $condition->message=$request->message;
        if(isset($request->is_show)){
            $condition->is_show=1;
        }else{
            $condition->is_show=0;
        }
        $condition->save();
       return redirect()->back()->with('success','successfully Saved');
    }
    public function configurationEdit()
    {
        return view('backend.pages.configuration.edit');
    }
    public function configurationUpdate(Request $request)
    {
        $request->validate([
            'app_name'=>'required|max:50',
            'app_logo'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section1_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section2_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section3_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section2_icon1'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section2_icon2'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section2_icon3'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section2_icon4'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $settings = Setting::first();

        if ($request->hasFile('app_logo')) {
            if ($settings->app_logo) {
                $pathToDelete = $settings->app_logo;
                if (file_exists($pathToDelete) && $settings->app_logo != 'public/frontend_asset/imgs/header-logo.png') {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('app_logo');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->app_logo = 'public/assets/backend/settings/' . $newname;
        }
        if ($request->hasFile('hero_image')) {
            if ($settings->hero_image) {
                $pathToDelete = $settings->hero_image;
                if (file_exists($pathToDelete)) {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('hero_image');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->hero_image = 'public/assets/backend/settings/' . $newname;
        }
        if ($request->hasFile('section1_image')) {
            if ($settings->section1_image) {
                $pathToDelete = $settings->section1_image;
                if (file_exists($pathToDelete)) {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('section1_image');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->section1_image = 'public/assets/backend/settings/' . $newname;
        }
        if ($request->hasFile('section2_image')) {
            if ($settings->section2_image) {
                $pathToDelete = $settings->section2_image;
                if (file_exists($pathToDelete)) {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('section2_image');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->section2_image = 'public/assets/backend/settings/' . $newname;
        }
        if ($request->hasFile('section3_image')) {
            if ($settings->section3_image) {
                $pathToDelete = $settings->section3_image;
                if (file_exists($pathToDelete)) {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('section3_image');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->section3_image = 'public/assets/backend/settings/' . $newname;
        }
        if ($request->hasFile('section2_icon1')) {
            if ($settings->section2_icon1) {
                $pathToDelete = $settings->section2_icon1;
                if (file_exists($pathToDelete)) {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('section2_icon1');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->section2_icon1 = 'public/assets/backend/settings/' . $newname;
        }
        if ($request->hasFile('section2_icon2')) {
            if ($settings->section2_icon2) {
                $pathToDelete = $settings->section2_icon2;
                if (file_exists($pathToDelete)) {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('section2_icon2');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->section2_icon2 = 'public/assets/backend/settings/' . $newname;
        }
        if ($request->hasFile('section2_icon3')) {
            if ($settings->section2_icon3) {
                $pathToDelete = $settings->section2_icon3;
                if (file_exists($pathToDelete)) {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('section2_icon3');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->section2_icon3 = 'public/assets/backend/settings/' . $newname;
        }
        if ($request->hasFile('section2_icon4')) {
            if ($settings->section2_icon4) {
                $pathToDelete = $settings->section2_icon4;
                if (file_exists($pathToDelete)) {
                    File::delete($pathToDelete);
                }
            }
            $uploadedfile = $request->file('section2_icon4');
            $newname = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('assets/backend/settings'), $newname);
            $settings->section2_icon4 = 'public/assets/backend/settings/' . $newname;
        }
        $settings = Setting::where('id', $settings->id)->update([
            'app_name' => $request->app_name,
            'app_logo'=> $settings->app_logo,
            'terms_and_condition' => $request->terms_and_condition,
            'privacy_policy' => $request->privacy_policy,
            'facebook_link'=>$request->facebook_link,
            'instagram_link'=>$request->instagram_link,
            'twitter_link'=>$request->twitter_link,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'hero_title'=>$request->hero_title,
            'hero_description'=>$request->hero_description,
            'refund_policy'=>$request->refund_policy,

            'hero_image'=>$settings->hero_image,

            'section1_text'=>$request->section1_text,

            'section1_image'=>$settings->section1_image,

            'section2_heading'=>$request->section2_heading,

            'section2_image'=>$settings->section2_image,
            'section2_icon1'=>$settings->section2_icon1,
            'section2_icon2'=>$settings->section2_icon2,
            'section2_icon3'=>$settings->section2_icon3,
            'section2_icon4'=>$settings->section2_icon4,

            'section2_icon1_text'=>$request->section2_icon1_text,
            'section2_icon2_text'=>$request->section2_icon2_text,
            'section2_icon3_text'=>$request->section2_icon3_text,
            'section2_icon4_text'=>$request->section2_icon4_text,
            'section3_heading'=>$request->section3_heading,

            'section3_image'=>$settings->section3_image,

            'section3_details'=>$request->section3_description,
            'section4_text'=>$request->section4_text,
            'section4_details'=>$request->section4_description,
            'section4_button_text'=>$request->section4_button_text,
            'section4_button_url'=>$request->section4_button_url,
            'section2_icon1_details'=>$request->section2_icon1_details,
            'section2_icon2_details'=>$request->section2_icon2_details,
            'section2_icon3_details'=>$request->section2_icon3_details,
            'section2_icon4_details'=>$request->section2_icon4_details,

        ]);

        Session::flash('success','Configuration update successfully');
        return back();

    }
}
