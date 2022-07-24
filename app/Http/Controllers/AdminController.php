<?php

namespace App\Http\Controllers;

use App\Models\Postprice;
use App\Models\Transanction;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * admin dashboard
     */
    public function dashboard()
    {
        $vendors = Vendor::orderBy('id', 'desc')->where('ig_account','!=',null)->where('access_token','!=',null)->get();
        //total sell of system
        $total_sell =  $this->calculateTotalSell();
        // total earning of admin
        $total_earning =  $this->calculateTotalEarning();
        //total widhraw of admin
        $withdraw_amount = $this->calculateWithdrawlAmount();
        //total pending amount
        $pending_amount = $this->totalPendingAmount();
        return view('admin.dashboard', compact('vendors', 'total_sell', 'total_earning', 'withdraw_amount', 'pending_amount'));
    }

    /**
     * calculate total sell
     */
    protected function calculateTotalSell()
    {
        $total_sell = Transanction::select('amount')->get();
        $sum = 0;
        foreach ($total_sell as $total) {
            $sum += $total->amount;
        }
        return $sum;
    }

    /**
     * calculate total earning of admin
     */
    protected function calculateTotalEarning()
    {
        $total_sell = $this->calculateTotalSell();
        return $total_earning = 0.1 * $total_sell;
    }

    /**
     * calculate total widhraw of admin
     */
    protected function calculateWithdrawlAmount()
    {
        $amounts = Transanction::select('amount')->where('status', 1)->get();
        $sum = 0;
        foreach ($amounts as $amount) {
            $sum += $amount->amount;
        }

        return $total_widraw = $sum - $sum * 0.1;
    }

    /**
     * calcule total pending amount of vendor(which need to pay vendor)
     */
    protected function totalPendingAmount()
    {
        $amounts = Transanction::select('amount')->where('status', 0)->get();
        $sum = 0;
        foreach ($amounts as $amount) {
            $sum += $amount->amount;
        }

        return $total_pending =  $sum - $sum * 0.1;
    }

    /**
     * show overview of total sell and total earning of this system
     */
    public function earning()
    {
        $transanctions = Transanction::orderBy('id', 'desc')->get();
        $total_sell = $this->calculateTotalSell();
        $total_earning = $this->calculateTotalEarning();
        return view('admin.earning', compact('transanctions', 'total_sell', 'total_earning'));
    }

    /**
     * to show requested payment which request send by vendor
     */
    public function paymentRequest()
    {
        $vender_requests = Transanction::where('pay_request', 1)->where('status', 0)->get();
        return view('admin.payment_request', compact('vender_requests'));
    }

    /**
     * pay vendor money which is earn from post
     */
    public function payNow($transanction_id)
    {
        $transanction = Transanction::where('id', $transanction_id)->update(['status' => 1]);
        return redirect()->back()->with('success', 'Payment successfully done.');
    }

    /**
     * Pending peayment of vendor
     */
    public function paymentPending()
    {
        $pening_payments = Transanction::where('status', 0)->get();
        return view('admin.pending_payment', compact('pening_payments'));
    }

    /**
     * show page to update post price
     */
    public function postPrice()
    {
        $post_price = null;
        $post_prices = Postprice::all();
        if (count($post_prices) != 0) {
            $post_price =  $post_prices[0]->post_price;
        }

        return view('admin.set_post_price',compact('post_price'));
    }

    /**
     * update post price
     */
    public function updatePostPrice(Request $request)
    {
        $request->validate([
            'post_price' => 'required'
        ]);


        $data = [];
        $data['post_price'] = $request->post_price;

        $postprice = Postprice::updateOrCreate(['id' => 1], $data);
        return redirect()->back()->with('success', 'Postprice updated successfully');
    }
}
