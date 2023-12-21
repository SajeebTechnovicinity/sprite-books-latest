<?php

namespace App\Http\Controllers;

use App\Models\AuthorMembershipPlan;
use App\Models\AuthorMembershipPlanPayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripeController extends Controller
{
    public function payment()
    {

        $data['membership_plan'] = AuthorMembershipPlan::whereAuthorId(session('author_id'))->whereType(session('type'))->latest()->take(1)->get();
        // echo '<pre>';print_r($data['membership_plan']);die;
        return view('frontend.pages.payment',$data);
    }

    public function stripePost(Request $request)
    {
        $membership_plan = AuthorMembershipPlan::whereAuthorId(session('author_id'))->whereType(session('type'))->latest()->take(1)->get();

        // print_r($membership_plan[0]->MembershipPlan->membership_plan_yearly_price);die;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $membership_plan[0]->MembershipPlan->membership_plan_yearly_price,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of Spirit Books",
        ]);

        $savePayment = new AuthorMembershipPlanPayments;
        $savePayment->membership_plan_id = $membership_plan[0]->MembershipPlan->id;
        $savePayment->type = session('type');
        $savePayment->author_id = $membership_plan[0]->author_id;
        $savePayment->amount = $membership_plan[0]->MembershipPlan->membership_plan_yearly_price;
        $savePayment->strype_token = $request->stripeToken;
        $savePayment->save();

        Session::flash('success', 'Payment Successfull!');

        return back();
    }
}
