<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\ValueObjects\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view("orders.index", [
            'orders' => Order::where('user_id', Auth::id())->paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $cart = Session::get('cart', new Cart());
        if ($cart->hasItems()) {
            $order = new Order();
            $order->amount = $cart->getQuantity();
            $order->price = $cart->getSum();
            $order->user_id = Auth::id();
            $order->save();
            // jeszcze obsługa błędów
            $productIds = $cart->getItems()->map(function($item) {
                return ['product_id' => $item->getProductId()];
            });
            $order->products()->attach($productIds); // powiązanie po id order i product
            // jeszcze obsługa błędów
            Session::put('cart', new Cart()); // cleaning basket
            return redirect(route('orders.index'))->with('status', 'Zamówienie zrealizowane');
        } else {
            return back(); // page refresh
        }

    }

}
