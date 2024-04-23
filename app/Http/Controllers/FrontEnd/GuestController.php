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
        if (!$request->email || Newsteller::where('email', $request->email)->exists()) {
            //Session::flash('wrong','Email is required and Email is unique');
            return 'Email is required and Email is unique';
        }

        $newsletter=Newsteller::create([
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
                "api-key: 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",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);

        //Session::flash('success','Successfully subscribed');
        return $response;
        return 'Successfully subscribed';
    }

    public function plan()
    {
        return view('plan');
    }
}
