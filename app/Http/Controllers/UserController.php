<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * show list of instagram account of vendor
     * 
     */
    public function home()
    {
        $vendors = Vendor::orderBy('id', 'desc')->where('status', 2)->get();
        return view('user.dashboard', compact('vendors'));
    }
}
