<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('admin'); // Controlador solo para los administradores del sitio
    }

    public function index() {
        return view('admin.control-panel');
    }

    public function createTag() {
        return view('admin.create-tag');
    }

    public function createTagP(Request $request) {

        return back()->with('message', 'Tag added!');
    }
    
}
