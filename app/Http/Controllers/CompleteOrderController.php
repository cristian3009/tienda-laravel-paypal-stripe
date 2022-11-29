<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CompleteOrderController extends Controller
{
    public function completeForm(Request $request, Order $order)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        return view('complete', compact('order'));
    }

    public function completeOrder(Request $request, Order $order)
    {

    }
}
