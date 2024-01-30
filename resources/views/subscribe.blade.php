<!-- resources/views/subscribe.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe</title>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}"></script>
</head>
<body>
    <h1>Subscribe Now</h1>

    <!-- Subscription Button -->
    <div id="paypal-button-container">kk</div>

    <script>
        paypal.Buttons({
            createSubscription: function (data, actions) {
                return actions.subscription.create({
                    'plan_id': 'your-paypal-plan-id'
                });
            },
            onApprove: function (data, actions) {
                // Handle the subscription approval
                // You can redirect the user or perform other actions here
                alert('Subscription Approved!');
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>