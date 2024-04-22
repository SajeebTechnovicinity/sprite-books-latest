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

        Newsteller::create([
            'email' => $request->email
        ]);

        $apiKey = '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';

        $data = array(
            'tag' => 'Books Tree',
            'sender' => array(
                'name' => 'Mary from MyShop',
                'email' => $request->email,
                'id' => 3
            ),
            'name' => 'Newsletter - May 2017',
            'htmlContent' => '<!DOCTYPE html> <html> <body> <h1>Confirm you email</h1> <p>Please confirm your email address by clicking on the link below</p> </body> </html>',
            'htmlUrl' => 'https://technovicinity.com/development/shahed/spirit/',
            'templateId' => 0,
            'scheduledAt' => '2017-06-01T12:30:00+02:00',
            'subject' => 'Discover the New Collection !',
            'previewText' => 'Thanks for your order!',
            'replyTo' => 'support@myshop.com',
            'toField' => '{FNAME} {LNAME}',
            'recipients' => array(
                'exclusionListIds' => array(8),
                'listIds' => array(32),
                'segmentIds' => array(23)
            ),
            'attachmentUrl' => 'https://attachment.domain.com',
            'inlineImageActivation' => true,
            'mirrorActive' => true,
            'footer' => '[DEFAULT_FOOTER]',
            'header' => '[DEFAULT_HEADER]',
            'utmCampaign' => 'NL_05_2017',
            'params' => array(
                'FNAME' => 'Joe',
                'LNAME' => 'Doe'
            ),
            'sendAtBestTime' => true,
            'abTesting' => true,
            'subjectA' => 'Discover the New Collection!',
            'subjectB' => 'Want to discover the New Collection?',
            'splitRule' => 50,
            'winnerCriteria' => 'open',
            'winnerDelay' => 50,
            'ipWarmupEnable' => true,
            'initialQuota' => 3000,
            'increaseRate' => 70,
            'unsubscriptionPageId' => '62cbb7fabbe85021021aac52',
            'updateFormId' => '6313436b9ad40e23b371d095'
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.brevo.com/v3/emailCampaigns');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $headers = array(
            'accept: application/json',
            'content-type: application/json',
            'Authorization: Bearer ' . $apiKey // Add the Authorization header
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        //Session::flash('success','Successfully subscribed');
        //return $response;
        return 'Successfully subscribed';
    }
}
