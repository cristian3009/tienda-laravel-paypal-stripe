<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartManager;
use App\Paypal;
use App\Models\Order;

use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function paypalPaymentRequest(CartManager $cart, Paypal $paypal)
    {
        return redirect()->away($paypal->paypalPaymentRequest($cart->getAmount()));
    }

    public function paypalCheckout(Request $request, Paypal $paypal, CartManager $cart, $status)
    {
        if ($status === 'success')
        {
            $response = $paypal->checkout($request);

            if (!is_null($response))
            {
                $response->shopping_cart_id = $cart->getCart()->id;
                Order::createFromResponse($response);
                session()->flash('message', 'Thank you for your purchase!');
                return redirect()->route('welcome');
            }
        }

        if ($status === 'failure')
        {
            session()->flash('message', 'Something went wrong!');
            return redirect()->route('welcome');
        }

        return abort(403, 'Unauthorized action.');
    }

    public function stripeCheckout(Request $request, CartManager $cart)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        Charge::create([
            'amount' => ($cart->getAmount()) * 100,
            'currency' => 'usd' ,
            'source' => $request->stripeToken
        ]);

        Order::create(['shopping_cart_id' => $cart->getCart()->id, 'email' => $request->email]);

        session()->flash('message', 'Thank you for your purchase!');
        return redirect()->route('welcome');
    }
}
