<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\AuthorMembershipPlan;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Subscription as CashierSubscription;
use Laravel\Cashier\SubscriptionItem;
use Stripe\Subscription;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Session;
use Stripe\PaymentIntent as PaymentIntentC;

class MemberShipController extends Controller
{

    public function __construct() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }


    public function show(MembershipPlan $plan,$duration, Request $request)
    {
        // dd($plan);
    //    echo '<pre>'; print_r($plan);die;



    //  User can't downgrade plan

    if(session('waiting_for_author_membership_id')){
        $userId = session('waiting_for_author_membership_id');
     }elseif (session('author_id')) {
        $userId = session('author_id');
     }

     $user = Author::find($userId);

     $check_user_has_previous_plan = AuthorMembershipPlan::whereAuthorId($user->id)->whereType($user->type)->latest()->take(1)->get();
    //  echo '<pre>';

    //  if(count($check_user_has_previous_plan) <= 0){

    //  }


     if(count($check_user_has_previous_plan) != 0){
        $previousPrice = '';
        //return $duration;
        if($duration == 'Monthly'){
            $pressentPrice = $plan->membership_plan_monthly_price;
            $previousPrice = $check_user_has_previous_plan[0]->MembershipPlan->membership_plan_monthly_price;
        }else{

            $pressentPrice = $plan->membership_plan_yearly_price;
            $previousPrice = $check_user_has_previous_plan[0]->MembershipPlan->membership_plan_yearly_price;
        }

        if(($previousPrice >= $pressentPrice)){
            // echo 1;
            return redirect()->back()->with('msg',"You can't downgrade your current plan!");
        }
     }


    //  die;

// For Free Membership

        if($plan->membership_plan_monthly_price == 0 && $plan->membership_plan_yearly_price == 0){

         $membershipPlan = new AuthorMembershipPlan;
         $membershipPlan->type = session('type');
         if(session('waiting_for_author_membership_id')){
            $user = Author::find(session('waiting_for_author_membership_id'));

            session()->flush();
            $membershipPlan->author_id = $user->id;

            $snData = [
                'author_name'=>$user->author_name,
                'author_phone'=>$user->author_phone,
                'type'=>$user->type,
                'author_code'=>$user->author_code,
                'author_email'=>$user->author_email,
                'author_id'=>$user->id
            ];
            session()->put($snData);

         }elseif (session('author_id')) {
            $membershipPlan->author_id = session('author_id');
         }


         $membershipPlan->membership_plan_id = $plan->id;
         $membershipPlan->save();

         $check_has_subscription = DB::table('subscriptions')->where('author_id',session('author_id'))->latest()->take(1)->get();
        //  dd($check_has_subscription);
         if(count($check_has_subscription)){
            $subscription = $check_has_subscription[0];
            Cashier::useCustomerModel(Author::class);
            $sub = Subscription::retrieve($subscription->stripe_id);
            $sub = Subscription::update($subscription->stripe_id, [
                'cancel_at_period_end' => true
             ]);

             return redirect()->back()->with('msg','Your membership plan will be cancalled after the grace period');
         }

         if(session('type') == 'AUTHOR'){
            return redirect('author/profile');
        }elseif(session('type') == 'USER'){
            return redirect('user/profile');
        }elseif(session('type') == 'PUBLISHER'){
            return redirect('publisher/profile');
        }

        }else{


            // Premium Membership

            if(session('waiting_for_author_membership_id')){
                $user = Author::find(session('waiting_for_author_membership_id'));
            }else{
                $user = Author::find(session('author_id'));
            }

            if($user->stripe_id){

            $get_current_plan = AuthorMembershipPlan::whereAuthorId($user->id)->whereType(session('type'))->latest()->take(1)->get();

            if($get_current_plan){
                if($get_current_plan[0]->status == 1){

                    $priceId = '';
                if($duration == 'Monthly'){
                    $priceId = $plan->membership_plan_monthly_stripe_plan;
                }else{
                    $priceId = $plan->membership_plan_yearly_stripe_plan;
                }
                // echo '<pre>';print_r($priceId);die;


                $check_has_subscription = DB::table('subscriptions')->where('author_id',session('author_id'))->latest()->take(1)->get();
         if(count($check_has_subscription) != 0){
            $subscription = $check_has_subscription[0];

            // echo $subscription->stripe_id;die;
            Cashier::useCustomerModel(Author::class);
            $sub = Subscription::retrieve($subscription->stripe_id);
            $sub->cancel();

            AuthorMembershipPlan::whereAuthorId(session('author_id'))->whereType(session('type'))->orderBy('id','desc')->first()->update([
                'status' => 0,'active_status'=>0
             ]);

            // echo '<pre>';print_r($sub->items->data[0]->id);die;
            // $sub = Subscription::update($subscription->stripe_id, [
            //     'price' => $priceId
            //  ]);

            //  $stripe = new \Stripe\StripeClient('sk_test_51JegAwLRDA80gOtfIEEMcWH30khtaHybq7B6ZzHPgZtnQvUPSmqF5naQfQmVX0wrmQVwT3bUtm5D0YjFAQWJ3LSf00agQCVYpV');
            // $stripe->subscriptionItems->update($sub->items->data[0]->id, ['price' => 'price_1Nzy3XLRDA80gOtfrHcSaeLC']);
            // $stripe->subscriptions->update(
            //     $subscription->stripe_id,
            //     [
            //       'items' => [
            //         [
            //           'id' => $sub->items->data[0]->id,
            //           'deleted' => true,
            //         ],
            //         ['price' => $priceId],
            //       ],
            //     ]
            //   );
            //  if($stripe){
            //     return redirect()->back()->with('msg','Your membership plan has been switched successfully');
            // }


                // $stripe = new \Stripe\StripeClient('sk_test_51JegAwLRDA80gOtfIEEMcWH30khtaHybq7B6ZzHPgZtnQvUPSmqF5naQfQmVX0wrmQVwT3bUtm5D0YjFAQWJ3LSf00agQCVYpV');

                // $stripe->subscriptionItems->update('si_xxxxxxxxx', ['price' => $priceId]);

                //     // $subscription_result = $user->subscription('current_plan')->swap($priceId);
                //     if($subscription_result){
                //         return redirect()->back()->with('msg','Your membership plan will be switched after the grace period');
                //     }
                }
            }
            }
            $intent = $user->createSetupIntent();

            return view("frontend.pages.membership_plan_details", compact("plan","duration", "intent"));

        }else{
            $intent = $user->createSetupIntent();

            return view("frontend.pages.membership_plan_details", compact("plan","duration", "intent"));
        }
    }
}
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function subscription(Request $request)
    {

        $plan = MembershipPlan::find($request->plan);

        if($request->duration == 'Monthly'){
            $stripePlan = $plan->membership_plan_monthly_stripe_plan;
        }else{
            $stripePlan = $plan->membership_plan_yearly_stripe_plan;
        }


        // $user = Author::find(session('waiting_for_author_membership_id'));
        if(session('waiting_for_author_membership_id')){
            $user = Author::find(session('waiting_for_author_membership_id'));
        }else{
            $user = Author::find(session('author_id'));
        }
        // $subscription = $user->newSubscription($user->author_name, $stripePlan)
        //                 ->create($request->token,[
        //                     'email' => $user->author_email,
        //                     'name' => $user->author_name,
        //                     'phone' => $user->author_phone,
        //                 ]);


                        $sData = [
                            'waiting_for_payment_success_plan_id'=>$plan->id
                        ];
                        session()->put($sData);

                        $session = \Stripe\Checkout\Session::create([
                            'subscription_data' => [
                                'items' => [[
                                  'plan' =>  $stripePlan,
                                ]],
                              ],
                              'mode' => 'subscription',
                              "customer_email"=> $user->author_email,
                              "metadata"=> ['price_id'=>$stripePlan],
                            'success_url' => route('membership.checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                            'cancel_url' => route('membership.checkout.cancel', [], true),
                        ]);

                        $membershipPlan = new AuthorMembershipPlan;
                        $membershipPlan->type = session()->get('type');
                        $membershipPlan->author_id =  $user->id;
                        // $membershipPlan->membership_plan_id =session()->get('waiting_for_payment_success_plan_id');
                        $membershipPlan->membership_plan_id =$plan->id;
                        $membershipPlan->session_id = $session->id;
                        $membershipPlan->duration=$request->duration;
                        $membershipPlan->status = 0;
                        $membershipPlan->save();

                        return redirect($session->url);






    }

    public function success(Request $request)
    {
        // return 1;
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if (!$session) {
                throw new NotFoundHttpException;
            }
            $customer = \Stripe\Customer::retrieve($session->customer);




            $plan = AuthorMembershipPlan::where('session_id','=', $session['id'])->first();





            if (!$plan) {
                throw new NotFoundHttpException();
            }
            if ($plan->status == 0) {
                $plan->status = 1;
                $plan->save();
            }

            $user = Author::find($plan->author_id);




            $user->stripe_id = $session->customer;
            $user->save();

            $subscriptionData = [
                'author_id'=>$user->id,
                'name'=>$user->author_name,
                'stripe_id'=>$session['subscription'],
                'stripe_status'=>'active',
                'stripe_price'=>$session->metadata->price_id,
                'quantity'=>1,
                'ends_at'=>$session->expires_at
            ];

            // echo '<pre>';print_r($subscriptionData);die;

            DB::table('subscriptions')->insert($subscriptionData);

            session()->flush();

        $snData = [
            'author_name'=>$user->author_name,
            'author_phone'=>$user->author_phone,
            'type'=>$user->type,
            'author_code'=>$user->author_code,
            'author_email'=>$user->author_email,
            'author_id'=>$user->id,
        ];
        session()->put($snData);




        if($user->type == 'AUTHOR'){
            return redirect('author/profile')->with('msg','Your membership plan has been activated successfully');
         }else if($user->type == 'PUBLISHER'){
            return redirect('publisher/profile')->with('msg','Your membership plan has been activated successfully');
         }

            // return view('product.checkout-success', compact('customer'));
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }

    public function cancel()
    {

    }


    public function successPayment(){
        $membershipPlan = new AuthorMembershipPlan;
        $membershipPlan->type = session()->get('type');
        $membershipPlan->author_id = session()->get('waiting_for_author_membership_id');
        $membershipPlan->membership_plan_id =session()->get('waiting_for_payment_success_plan_id');
        $membershipPlan->save();

        $user = Author::find(session()->get('waiting_for_author_membership_id'));

        $snData = [
            'author_name'=>$user->author_name,
            'author_phone'=>$user->author_phone,
            'type'=>$user->type,
            'author_code'=>$user->author_code,
            'author_email'=>$user->author_email,
            'author_id'=>$user->id,
        ];
        session()->put($snData);


        // if(session('type') == 'AUTHOR'){
        //     return redirect('author/profile')->with('msg','Your membership plan has been activated successfully');
        //  }else if(session('type') == 'PUBLISHER'){
        //     return redirect('publisher/profile')->with('msg','Your membership plan has been activated successfully');
        //  }

    }

    public function webhook(){

           // This is your Stripe CLI webhook secret for testing your endpoint locally.
           $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

           $payload = @file_get_contents('php://input');
           $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
           $event = null;

           try {
               $event = \Stripe\Webhook::constructEvent(
                   $payload, $sig_header, $endpoint_secret
               );
           } catch (\UnexpectedValueException $e) {
               // Invalid payload
               return response('', 400);
           } catch (\Stripe\Exception\SignatureVerificationException $e) {
               // Invalid signature
               return response('', 400);
           }

   // Handle the event
           switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = AuthorMembershipPlan::where('session_id', $session->id)->first();
                if ($order && $order->status === '0') {
                    $order->status = '1';
                    $order->save();
                    // Send email to customer
                }
                   echo 'Received unknown event type ' . $event->type;
           }

           return response('');



        // \Stripe\Stripe::setApiKey($stripeSecretKey);
        // Replace this endpoint secret with your endpoint's unique secret
        // If you are testing with the CLI, find the secret by running 'stripe listen'
        // If you are using an endpoint defined with the API or dashboard, look in your webhook settings
        // at https://dashboard.stripe.com/webhooks
        // $endpoint_secret = 'whsec_f9d43b9a9d76edc9122f9a82f27de4f55089677d5ace56a77a42b4a5994b6db2';

        // $payload = @file_get_contents('php://input');
        // $event = null;

        // try {
        //   $event = \Stripe\Event::constructFrom(
        //     json_decode($payload, true)
        //   );
        // } catch(\UnexpectedValueException $e) {
        //   // Invalid payload
        //   echo '⚠️  Webhook error while parsing basic request.';
        //   http_response_code(400);
        //   exit();
        // }
        // if ($endpoint_secret) {
        //   // Only verify the event if there is an endpoint secret defined
        //   // Otherwise use the basic decoded event
        //   $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        //   try {
        //     $event = \Stripe\Webhook::constructEvent(
        //       $payload, $sig_header, $endpoint_secret
        //     );
        //   } catch(\Stripe\Exception\SignatureVerificationException $e) {
        //     // Invalid signature
        //     echo '⚠️  Webhook error while validating signature.';
        //     http_response_code(400);
        //     exit();
        //   }
        // }

        // // Handle the event
        // switch ($event->type) {
        //   case 'payment_intent.succeeded':


        //     // contains a \Stripe\PaymentIntent
        //     // Then define and call a method to handle the successful payment intent.
        //     // handlePaymentIntentSucceeded($paymentIntent);
        //     break;
        //   case 'payment_method.attached':
        //     $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
        //     // Then define and call a method to handle the successful attachment of a PaymentMethod.
        //     // handlePaymentMethodAttached($paymentMethod);
        //     break;
        //     case 'charge.succeeded':


        //         $this->successPayment();

        //         // contains a \Stripe\PaymentIntent
        //         // Then define and call a method to handle the successful payment intent.
        //         // handlePaymentIntentSucceeded($paymentIntent);
        //         break;
        //   default:
        //     // Unexpected event type
        //     error_log('Received unknown event type');
        // }

        // http_response_code(200);
    }



    public function cancel_current_membership_plan(){
        $subscription= DB::table('subscriptions')->where('author_id', session('author_id'))->where('stripe_status','active')->latest()->take(1)->get()[0];



        if($subscription->stripe_id)
        {
            $sub = Subscription::retrieve($subscription->stripe_id);
            $sub = Subscription::update($subscription->stripe_id, [
                'cancel_at_period_end' => true
             ]);

            DB::table('subscriptions')->where('id', $subscription->id)->update([
                'stripe_status'=>'inactive'
            ]);
        }

         if(session('type') == 'AUTHOR'){
            return redirect('author/profile')->with('msg','Your membership plan will be cancalled after the grace period');
         }else if(session('type') == 'PUBLISHER'){
            return redirect('publisher/profile')->with('msg','Your membership plan will be cancalled after the grace period');
         }


// $sub->cancel();


        // $author->subscription('default')->cancel();



        // print_r($author);die;
        // $author = Cashier::findBillable($subscription->stripe_id);
        // $subscription = DB::table('subscriptions')->where('author_id', session('author_id'))->first();
        // $user = Author::find(session('author_id'));
        // $sub_id = $subscription->stripe_id;
        // $sub = $user->CashierSubscription::retrieve($sub_id);
        // CashierSubscription::where('stripe_id', $sub->id)
        // ->update([
        //     'trial_ends_at' => Carbon::now()->toDateTimeString(),
        //  ]);
        // print_r( $subscription);die;
    }
}
