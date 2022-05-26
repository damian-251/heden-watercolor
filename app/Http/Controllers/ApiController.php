<?php

namespace App\Http\Controllers;

use App\Models\Colour;
use App\Models\Colour_tr;
use App\Models\Location_tr;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Tag;
use App\Models\Tag_tr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * Devuelve los datos de una etiqueta dado su id
     */
    public function tag($id = 1) {
        $tag = Tag_tr::select('name', 'language_code')->where('tag_id', $id)->get();
        return $tag;
    }

    /**
     * Devuelve los datos de un color dado el id
     */
    public function colour($id = 1) {
        $colour = Colour_tr::select('name', 'language_code')->where('colour_id', $id)->get();
        return $colour;
    }

    /**
     * Devuelve los datos de de una localización dado el id
     */
    public function location($id = 1) {
        $location = Location_tr::select('name', 'language_code')->where('location_id', $id)->get();
        return $location;
    }

    public function shipping($id) {

        $price = [];

            $shipping = Shipping::findOrFail($id);
            $price['eur'] = $shipping->price_eur;
            $price['nok'] = $shipping->price_nok;
            
        
        return $price;
    }

    public function products () {
        $products = Product::select('id', 'price_eur')->where('stock', '>' ,0)->orderBy('creation_date', 'desc')->paginate(10);
        return $products;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
