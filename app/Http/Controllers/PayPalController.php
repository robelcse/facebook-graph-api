<?php

namespace App\Http\Controllers;
 
use Omnipay\Omnipay;
use App\Models\Post;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Transanction;

class PayPalController extends Controller
{


    public $gateway;
    public $instagram;
    public function __construct(InstagramController $instagram)
    {
        $this->instagram = $instagram;

        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('CLIENT_ID'));
        $this->gateway->setSecret(env('CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live

    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {


        try {
            $response = $this->gateway->purchase(array(
                'amount' => env('AMOUNT'),
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => env('PAYPAL_RETURN_URL'),
                'cancelUrl' => env('PAYPAL_CANCEL_URL'),
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect(); // this will automatically forward the customer
            } else {
                // not successful
                echo $response->getMessage();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $_GET['PayerID'],
                'transactionReference' => $_GET['paymentId'],
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {

                //transanction information save to databse
                $arr_body = $response->getData();
                $payment_id = $arr_body['id'];
                $payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payer_email = $arr_body['payer']['payer_info']['email'];
                $amount = $arr_body['transactions'][0]['amount']['total'];
                $currency = $arr_body['transactions'][0]['amount']['currency'];
                $payment_status = $arr_body['state'];

                $post = Post::where('user_unique_id', Auth::user()->unique_ud)->where('status', 0)->latest('created_at')->first();
                $this->savePaypalTransanction($payment_id, $payer_id, $payer_email, $amount, $currency, $payment_status, $post);

                //post publish on instagram feed
                $post_to_instagram =  $this->instagram->instagramPostDescesionMaker($post);
                return redirect()->route('home')->with('success', 'Post published successfully to instagram feed.');
            } else {
                echo $response->getMessage();
            }
        } else {
            return redirect()->route('home')->with('error', 'Transaction is declined!');
        }
    }


    /**
     * Save paypal transanction information
     * 
     *
     */
    public function savePaypalTransanction($payment_id, $payer_id, $payer_email, $amount, $currency, $payment_status, $post)
    {

        $vendor = Vendor::select('post_price', 'paypal_email', 'ig_account', 'access_token')->where('unique_id', $post->ig_account_owner_unique_id)->first();

        $ig_account = $vendor->ig_account;

        $transanction = new Transanction();
        $transanction->user_paypal = $payer_email;
        $transanction->ig_account_owner_paypal = $vendor->paypal_email;
        $transanction->post_id = $post->id;
        $transanction->ig_account = $ig_account;
        $transanction->amount = $amount;
        $transanction->transanction_id = Carbon::now()->toDateString() . uniqid();
        $transanction->user_unique_id = Auth::user()->unique_id;
        $transanction->ig_account_owner_unique_id =  $post->ig_account_owner_unique_id;
        $transanction->save();
    }
}
