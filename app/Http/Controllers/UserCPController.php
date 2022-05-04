<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    /**
     * Llevamos al usuario a un formulario para que edite la dirección,
     * comprobamos antes que la dirección que ha pasado esté entre las suyas
     */
    public function editAddress(Request $request) {

        $request->validate([
            'address_id' => 'required'
        ]);

        $address = Address::where('user_id', Auth::user()->id)->where('id', $request->address_id)->first();
        $userName = Auth::user()->name;
        $countries = Shipping::all();

        return view('user.edit-address', compact('address', 'userName', 'countries'));

    }

    /**
     * Borramos la dirección con el id pasado por el parámetro
     */
    public function deleteAddress(Request $request) {
        $request->validate([
            'address_id' => 'required'
        ]);
        //Comprobamos también el usuario para evitar que se borre una dirección que no sea la suya
        $address = Address::where('user_id', Auth::user()->id)->where('id', $request->address_id)->first();

        $address->delete();

        return back()->with('message', 'Address deleted');

    }

    /**
     * Actualizamos la dirección recibida como parámetro
     */
    public function editAddressP(Request $request) {

            $request->validate([
                'fullName' => 'required',
                'phone' => 'required',
                'line1' => 'required',
                'line2' => 'required',
                'postalCode' => 'required',
                'province' => 'required',
                'city' => 'required',
                'country' => 'required',
                'address_id' => 'required',
                'email' => 'required'
            ]);

            $address = Address::where('user_id', Auth::user()->id)->where('id', $request->address_id)->first();
            DB::beginTransaction();
            $address->line1 = $request->line1;
            $address->line2 = $request->line2;
            $address->postal_code = $request->postalCode;
            $address->city = $request->city;
            $address->full_name = $request->fullName;
            $address->email = $request->email;
            $address->phone = $request->phone;
            $address->province = $request->province;
            $address->shipping_id = $request->country;
            $address->save();
            
            DB::commit();


         $request->session()->flash('successMsg', 'Address Updated');

        $user = Auth::user();
        $userName = Auth::user()->name;
        $addresses = $user->addresses;

        return view('user.user-addresses', compact('userName', 'addresses'))->with('message', 'Address updated');

    }
}
