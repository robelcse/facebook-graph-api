<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;
use App\Models\Transanction;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Post;

use App\Http\Controllers\PostController;

class PaymentController extends Controller
{

    private $gateway;
    public $instagram;
    public $post;

    public function __construct(InstagramController $instagram)
    {
        $this->instagram = $instagram;

        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    /**
     * Call a view.
     */
    public function index()
    {
        return view('payment');
    }

    /**
     * Initiate a payment on PayPal.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function charge($request)
    {

        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->post_price,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect(); // this will automatically forward the customer
            } else {
                // not successful
                return $response->getMessage();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Charge a payment and store the transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function success(Request $request)
    {

        // return $request->all();

        if ($request->details['status'] == "COMPLETED") {

            //transanction information save to databse

            $payment_id = $request->details['id'];
            $payer_id = $request->details['payer']['payer_id'];
            $payer_email = $request->details['payer']['email_address'];
            $amount = $request->details['purchase_units'][0]['amount']['value'];
            $currency = $request->details['purchase_units'][0]['amount']['currency_code'];
            $payment_status = $request->details['status'];


            $post_id = session()->get('post_id');
            
            $post = Post::where('id', $post_id)->where('status', 0)->latest('created_at')->first();
            $this->savePaypalTransanction($payment_id, $payer_email, $amount, $currency, $payment_status, $post);
            return PostController::postPublished();
        } else {
            return redirect()->route('home')->with('error', 'Transaction is declined!');
        }
    }

    /**
     * Error Handling.
     */
    public function error()
    {
        return 'User cancelled the payment.';
    }

    /**
     * Save paypal transanction information
     * 
     *
     */
    public function savePaypalTransanction($payment_id, $payer_email, $amount, $currency, $payment_status, $post)
    {

        $vendor = Vendor::select('post_price', 'paypal_email', 'ig_account', 'access_token')->where('unique_id', $post->ig_account_owner_unique_id)->first();

        $ig_account = $vendor->ig_account;

        $transanction = new Transanction();
        $transanction->user_paypal = $payer_email;
        $transanction->ig_account_owner_paypal = $vendor->paypal_email;
        $transanction->post_id = $post->id;
        $transanction->ig_account = $ig_account;
        $transanction->amount = $amount;
        $transanction->transanction_id = $payment_id;
        //$transanction->user_unique_id = Auth::user()->unique_id;
        $transanction->ig_account_owner_unique_id =  $post->ig_account_owner_unique_id;
        $transanction->save();
    }


    public function testmethod(Request $request)
    {
        return $request->all();
    }
}
