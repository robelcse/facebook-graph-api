<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        if (Auth::check() && Auth::user()->role == 1) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::check() && Auth::user()->role == 2) {
            return redirect()->route('vendor.dashboard');
        }
        $this->middleware('guest')->except('logout');
    }

    /**
     * show register page
     */
    public function showRegisterPage()
    {
        return view('auth.register');
    }

    /**
     * vendor/admin registration
     * 
     */
    public function registration(Request $request)
    {

        $request->validate([
            'user_name'  => 'required',
            'user_email' => 'required',
            'password'   => 'required|min:8',
            'role'       =>  'required|not_in:0'
        ]);

        //  return $request->all();

        $unique_id = uniqid();

        if ($request->role == 2) {
            $this->storeVendorInfo($unique_id);
        }

        $user = new User();
        $user->user_name = $request->user_name;
        $user->user_email = $request->user_email;
        $user->role = $request->role;
        $user->unique_id = $unique_id;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('showLoginPage')->with('success', 'registration successfull');
    }

    /**
     * store vendor information
     */
    public function storeVendorInfo($unique_id)
    {
        $vendor = new Vendor();
        $vendor->unique_id = $unique_id;
        $vendor->save();
    }

    /**
     * show login page
     */
    public function showLoginPage()
    {
        return view('auth.login');
    }

    /**
     * 
     * User login
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return Boolen
     * 
     */
    public function login(Request $request)
    {
        $login_credential =  $request->validate([
            'user_email' => 'required|email',
            'password' => 'required'
        ]);

        $user =  User::where('user_email', $request->user_email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'credentials does not match our records!');
        } else {

            $user = User::where('user_email', $request->user_email)->first();
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->role == 1) {
                return redirect()->route('admin.dashboard')->with('success', 'Login success!');
            } elseif ($user->role == 2) {
                return redirect()->route('vendor.dashboard')->with('success', 'Login success!');
            }
        }
    }

    /**
     * user logout
     * 
     * @param  @param \Illuminate\Http\Request
     * 
     * @return reidrect login page
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
