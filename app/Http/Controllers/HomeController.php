<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Transanction;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{

  /**
   * show list of instagram account in the home page
   */
  public function home()
  {
    $vendors = Vendor::orderBy('id', 'desc')->where('status', 2)->where('ig_account','!=',null)->where('access_token','!=',null)->get();

    foreach ($vendors as $vendor) {
      $username = User::select('user_name')->where('unique_id', $vendor->unique_id)->first();
      $vendor->username =  $username->user_name;
    }

    //return $vendors;
    return view('home', compact('vendors'));
  }
}
