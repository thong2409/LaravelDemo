<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\CartService;
use App\Models\Cart;
use App\Models\Customer;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartService $cart){
        $this->cart = $cart;
    }
    public function index(){
        return view('admin.carts.customer',[
            'customers' => $this->cart->getCustomer(),
        ]);
    }

    public function showCustomer(Customer $customer){
        return view('admin.carts.detail',[
            'customer' => $customer,
            'carts'=>$customer->carts()
                                ->with(['product'=>function($query){
                                    $query->select('id','name','image');
                                    }]
                                )->get(),
        ]);
    }
    public function showOrder(){
        $payments = Cart::with('customer')
                        ->selectRaw('customer_id, SUM(qty) as total_qty, SUM(price * qty) as total_price')
                        ->groupBy('customer_id')
                        ->get();
        return view('admin.carts.order',compact('payments'));
    }
}
