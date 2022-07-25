<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Postprice;
use App\Models\Transanction;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VendorController extends Controller
{
    protected $facebook;

    /**
     * constructor method
     */
    public function __construct(FacebookController $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * vendor dashboard
     */
    public function dashboard()
    {
        $vendor = Vendor::where('unique_id', Auth::user()->unique_id)->first();

        $instagram_profile_link =  $vendor->instagram_profile_link;
        $instagram_account_id_of_vendor =  $vendor->ig_account;

        //total post of vendor
        $total_post_of_vendor = Post::where('ig_account_owner_unique_id', Auth::user()->unique_id)->count();

        //total earning of vendor
        $total_earning = $this->totalEarningOfVendor();

        //total pending payment of vendor
        $pending_payment = $this->totalPendingPaymentOfVendor();

        //total widraw of vendor
        $total_widraw = $this->totalWidrawOfVendor();

        return view('vendor.dashboard', compact('instagram_profile_link', 'instagram_account_id_of_vendor', 'total_post_of_vendor', 'total_earning', 'pending_payment', 'total_widraw'));
    }

    /**
     * calculate total earning of vendor
     */
    protected function totalEarningOfVendor()
    {
        $total_earning_from_post = Transanction::select('amount')->where('ig_account_owner_unique_id', Auth::user()->unique_id)->get();
        $sum = 0;
        foreach ($total_earning_from_post as $total) {
            $sum += $total->amount;
        }
        return $total_earning = $sum - $sum * 0.1;
    }

    /**
     * total pending payment of vendor
     */
    protected function totalPendingPaymentOfVendor()
    {
        $total_pending_payment = Transanction::select('amount')->where('ig_account_owner_unique_id', Auth::user()->unique_id)->where('status', 0)->get();
        $sum = 0;
        foreach ($total_pending_payment as $total) {
            $sum += $total->amount;
        }
        return $total_pending = $sum - $sum * 0.1;
    }

    /**
     * total widraw of vendor 
     */
    protected function totalWidrawOfVendor()
    {
        $total_pending_payment = Transanction::select('amount')->where('ig_account_owner_unique_id', Auth::user()->unique_id)->where('status', 1)->get();
        $sum = 0;
        foreach ($total_pending_payment as $total) {
            $sum += $total->amount;
        }
        return $total_widraw = $sum - $sum * 0.1;
    }

    /**
     * vendor earning information
     */
    public function earning()
    {
        $vendor_earning_info = Transanction::where('ig_account_owner_unique_id', Auth::user()->unique_id)->get();
        return view('vendor.earning', compact('vendor_earning_info'));
    }

    /**
     * vendor profile
     */
    public function profile()
    {

        $instagram_account_info =  Vendor::select('ig_account', 'access_token')->where('unique_id', Auth::user()->unique_id)->first();
        $login_url = $this->facebook->facebookConnect();
        $vendor_profile_info = Vendor::select('ig_account', 'instagram_profile_link', 'facebook_email', 'facebook_profile_link', 'paypal_email', 'status', 'ig_profile_image', 'ig_username', 'image')->where('unique_id', Auth::user()->unique_id)->first();
        return view('vendor.profile', compact('vendor_profile_info', 'login_url', 'instagram_account_info'));
    }

    /**
     * vendor payment request
     */
    public function paymentRequest()
    {
        $vendor_pending_payment = Transanction::where('ig_account_owner_unique_id', Auth::user()->unique_id)->where('status', 0)->get();
        return view('vendor.payment_request', compact('vendor_pending_payment'));
    }

    /**
     * send payment request to admin to pay
     */
    public function sendPayRequestToAdmin($transanction_id)
    {
        $transanction = Transanction::where('id', $transanction_id)->update(['pay_request' => true]);
        return redirect()->back()->with('success', 'Request send successfully');
    }

    /**
     * vendor profile update page
     */
    public function profilePage()
    {
        $vendor = Vendor::where('unique_id', Auth::user()->unique_id)->first();
        return view('vendor.profile_update', compact('vendor'));
    }

    /**
     * vendor profile update
     */
    public function profileUpdate(Request $request)
    {

       

        $post_prices = Postprice::all();
        if (count($post_prices) != 0) {
            $max_post_price =  $post_prices[0]->post_price;
        } else {
            $max_post_price = 100;
        }

        $request->validate([
            'facebook_email' => 'required|email',
            'facebook_profile_link' => 'required',
            'paypal_email' => 'required|email',
            'instagram_profile_link' => 'required',
            'post_price' => 'required|numeric|max:' . $max_post_price,
            'image'=>"required_if:image_exit,==,null"
        ]);


        //return $request->all();

        $vendor =  Vendor::where('unique_id', Auth::user()->unique_id)->first();

        $image = $request->file('image');

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/uploads/vendorprofile')) {
                mkdir('public/uploads/vendorprofile', 0777, true);
            }
            if (!is_null($vendor->image)) {
                unlink('public/uploads/vendorprofile/' . $vendor->image);
            }
            $image->move('public/uploads/vendorprofile', $imagename);
        } else {
            $imagename = $vendor->image;
        }

        $vendor = Vendor::where('unique_id', Auth::user()->unique_id)
            ->update([
                'facebook_email' => $request->facebook_email,
                'facebook_profile_link' => $request->facebook_profile_link,
                'paypal_email' => $request->paypal_email,
                'instagram_profile_link' => $request->instagram_profile_link,
                'post_price' => $request->post_price,
                'image' => $imagename
            ]);

        return redirect('vendor/profile')->with('success', 'Profile Update Successfully');
    }


    /**
     * vendor app setting
     */
    public function appSetting()
    {
        $vendor = Vendor::where('unique_id', Auth::user()->unique_id)->first();
        return view('vendor/appsetting', compact('vendor'));
    }

    /**
     * update facebook app_id and app_secret
     */
    public function updateFacebookAppIdAppSecret(Request $request)
    {
        $request->validate([
            'app_id' => 'required',
            'app_secret' => 'required',
        ]);

        $vendor = Vendor::where('unique_id', Auth::user()->unique_id)
            ->update([
                'app_id' => $request->app_id,
                'app_secret' => $request->app_secret,
                'status' => 2
            ]);

        return redirect()->back()->with('success', 'App id and app secret updated successfully');
    }
}
