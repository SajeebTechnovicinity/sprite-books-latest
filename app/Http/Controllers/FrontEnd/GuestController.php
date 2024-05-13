<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use App\Models\Newsteller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Sitemap\SitemapGenerator;

class GuestController extends Controller
{
    public function subscribe(Request $request)
    {
        // $request->validate([
        //     'email'=>'required|unique:newstellers'
        // ]);
        if (!$request->email || Newsteller::where('email', $request->email)->exists()) {
            //Session::flash('wrong','Email is required and Email is unique');
            return 'Email is required and Email is unique';
        }

        $newsletter = Newsteller::create([
            'email' => $request->email
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.brevo.com/v3/contacts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'email' => $request->email,
                'ext_id' => "{{ $newsletter->id }}",
                'attributes' => [
                    'FNAME' => 'Elly',
                    'LNAME' => 'Roger'
                ],
                'emailBlacklisted' => false,
                'smsBlacklisted' => false,
                'listIds' => [
                    $newsletter->id
                ],
                'updateEnabled' => false,
                'smtpBlacklistSender' => [
                    'user@example.com'
                ]
            ]),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                'api-key: ' . env('BREVO_KEY'),
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        

        $url = 'https://api.brevo.com/v3/contacts/lists/4/contacts/add';

        // Request headers
        $headers = array(
            'accept: application/json',
            'api-key: ' . env('BREVO_KEY'),
            'content-type: application/json'
        );
        // Request data
        $data = array(
            'emails' => array(
                $request->email
            )
        );

        // Initialize curl session
        $ch = curl_init();

        // Set curl options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute curl request
        $response = curl_exec($ch);

        //Session::flash('success','Successfully subscribed');
        return $response;
        return 'Successfully subscribed';
    }

    public function plan()
    {
        $data['membership_plans'] = MembershipPlan::whereMembershipPlanStatus(1)->whereType('AUTHOR')->get();
        return view('plan',$data);
    }   
    public function publisherPlan()
    {
        $data['membership_plans'] = MembershipPlan::whereMembershipPlanStatus(1)->whereType('PUBLISHER')->get();
        return view('publisher-plan',$data);
    }

    // Controller method to set session variable when GDPR is accepted
    public function acceptGDPR()
    {
        // Set session variable to indicate that the user has accepted GDPR
        session(['cookie_consent' => true]);

        return response()->json(['status' => 'success']);
    }

    public function sitemap_generate()
    {
        SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path('sitemap.xml'));

        return response('Sitemap generated successfully');
    }
    public function socket()
    {
        return view('socket');
    }
}
