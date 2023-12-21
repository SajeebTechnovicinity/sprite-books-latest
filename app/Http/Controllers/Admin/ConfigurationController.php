<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRecipient;
use App\Models\CityList;
use App\Models\ConditionMessageSetting;
use App\Models\CountryList;
use App\Models\Recipient;
use App\Models\withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function countryView()
    {
        $countryList=CountryList::get();
        return view('backend.pages.configuration.countryList')->with(compact('countryList'));
    }

    public function cityView()
    {
         $cityList = CityList::with('country')->get();
        $countryList=CountryList::get();
        return view('backend.pages.configuration.cityList')->with(compact('cityList','countryList'));
    }

    public function recipientView()
    {
        $recipientList=AdminRecipient::get();
        return view('backend.pages.configuration.recipients')->with(compact('recipientList'));
    }

    public function withdrawalView()
    {
        $withdrawal=withdrawal::get();
        return view('backend.pages.configuration.withdrawal')->with(compact('withdrawal'));
    }
    public function countryViewStore(Request $request)
    {
        $imgPath = '';
        if (!empty($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/flag'), $filename);
            $imgPath = 'public/uploads/flag/' . $filename;
        }
        $country = new CountryList();
        $country->name = $request->name;
        if ($request->image) {
            $country->img = $imgPath;
        }
        $country->code = strtotime(Carbon::now());
        $country->save();

        return redirect()->back()->with('success', 'Successfully country Created');
    }

    public function cityViewStore(Request $request)
    {
        if($request->id){
            $city =CityList::find($request->id);
            $city->name = $request->city;
            $city->country_id = $request->country;
            $city->save();
            return redirect()->back()->with('success', 'Successfully city Updated');
        }

        $city = new CityList();
        $city->name = $request->city;
        $city->country_id = $request->country;
        $city->code = strtotime(Carbon::now());
        $city->save();
        return redirect()->back()->with('success', 'Successfully city Created');

    }

    public function recipientViewStore(Request $request)
    {
        if($request->id){
            $recipient =AdminRecipient::find($request->id);
            $recipient->name = $request->name;
            $recipient->save();
            return redirect()->back()->with('success', 'Successfully recipient Updated');
        }
        $recipient = new AdminRecipient();
        $recipient->name = $request->name;
        $recipient->code = strtotime(Carbon::now());
        $recipient->save();
        return redirect()->back()->with('success', 'Successfully recipient Created');
    }

    public function withdrawalViewStore(Request $request)
    {
        if($request->id){
            $recipient = withdrawal::find($request->id);
            $recipient->name = $request->name;
            $recipient->save();
            return redirect()->back()->with('success', 'Successfully recipient Updated');
        }

        $recipient = new withdrawal();
        $recipient->name = $request->name;
        $recipient->code = strtotime(Carbon::now());
        $recipient->save();
        return redirect()->back()->with('success', 'Successfully recipient Created');
    }

    public function getCityList(Request $request){
        $cityList=  CityList::where('country_id',$request->id)->get();
        return view('backend.pages.configuration._getCityList')->with(compact('cityList'))->render();
    }


    public function update_condition_message(Request $request){
        // print_r($request->all());
        $msg = ConditionMessageSetting::find($request->id);
        $msg->title = $request->title;
        $msg->message = $request->message;
        if($request->is_show){
            $msg->is_show = 1;
        }else{
            $msg->is_show = 0;   
        }
        $msg->save();
        return redirect()->back()->with('success', 'Successfully Updated');
    }
}
