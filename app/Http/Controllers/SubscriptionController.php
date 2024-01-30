<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;

class SubscriptionController extends Controller
{
    public function createSubscription()
    {
        // Set up a plan in the PayPal Developer Dashboard and get its ID
        $planId = 'your-paypal-plan-id';

        // Create a new agreement
        $agreement = new Agreement();
        $agreement->setName('Subscription Agreement')
            ->setDescription('Monthly Subscription')
            ->setStartDate(date('Y-m-d\TH:i:s\Z', strtotime('+1 month')))
            ->setPlanId($planId);

        // Set payer details
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);

        // Redirect URLs after approval or cancellation
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('subscription.success'))
            ->setCancelUrl(route('subscription.cancel'));
        $agreement->setRedirectUrls($redirectUrls);

        // Create the subscription agreement
        $agreement->create($this->paypalApiContext);

        // Get the approval link
        $approvalLink = $agreement->getApprovalLink();

        // Redirect the user to PayPal for approval
        return redirect($approvalLink);
    }

    public function subscriptionSuccess(Request $request)
    {
        // Handle success callback from PayPal after user approval
        // Complete subscription setup or update your database accordingly
    }

    public function subscriptionCancel()
    {
        // Handle cancellation callback from PayPal
    }
    public function viewSubscription()
    {
        // Render the subscription Blade view
        return view('subscribe');
    }
}
