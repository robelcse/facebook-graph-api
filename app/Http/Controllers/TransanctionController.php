<?php

namespace App\Http\Controllers;

use App\Models\Transanction;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Carbon\Carbon;

class TransanctionController extends Controller
{
    protected $instagram;
    public function __construct(InstagramController $instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * transacntion for post publish
     * 
     */
    public  function transanction($post, $ig_account_owner_unique_id)
    {

        $vendor = Vendor::select('post_price', 'paypal_email', 'ig_account', 'access_token')->where('unique_id', $ig_account_owner_unique_id)->first();

        $ig_account = $vendor->ig_account;
        $access_token = $vendor->access_token;

        $transanction = new Transanction();
        $transanction->user_paypal = 'jhondoe@gmail.com';
        $transanction->ig_account_owner_paypal = $vendor->paypal_email;
        $transanction->post_id = $post->id;
        $transanction->ig_account = $ig_account;
        $transanction->amount = $vendor->post_price;
        $transanction->transanction_id = Carbon::now()->toDateString() . uniqid();
        $transanction->user_unique_id = Auth::user()->unique_id;
        $transanction->ig_account_owner_unique_id =  $ig_account_owner_unique_id;
        $transanction->save();
        $post_to_instagram =  $this->instagram->instagramPostDescesionMaker($post, $ig_account, $access_token);
        return redirect()->back()->with('success', 'Post published successfully to instagram feed.');
    }
}
