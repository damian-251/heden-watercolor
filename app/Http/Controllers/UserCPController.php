<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserCPController extends Controller
{
    /**
     * El usuario debe de haber confimado el correo electrónico
     */
    public function __construct()
    {
        //Verfied
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Muestra la vista principal del panel de control del usuario
     */
    public function controlPanel() {
        $userName = auth()->user()->name;
        return view('user.control-panel', compact('userName'));
    }

    public function myData() {
        $user = Auth::user();
        $userName = Auth::user()->name;
        return view ('user.user-data', compact('user', 'userName'));

    }

    public function myAddresses() {
        $user = Auth::user();
        $userName = Auth::user()->name;
        $addresses = $user->addresses;
        return view('user.user-addresses', compact('user', 'userName', 'addresses'));
    }

    public function myOrders() {
        $user = Auth::user();
        $userName = Auth::user()->name;

        $orders = Order::whereIn("orders.address_id", function($query) {
            $query->select('addresses.id')->from('addresses')->where('addresses.user_id', Auth::user()->id);
        })->with('payment')->get();
        //SELECT * FROM `orders` WHERE address_id in (select id from addresses where user_id =usuarioactivo); 
        //Log::channel('custom')->debug($orders);
        return view ('user.user-orders', compact('user', 'userName', 'orders'));
    }
}
