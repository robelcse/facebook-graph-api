<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Facebook\Facebook as Facebooksdk;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Vendor;

class FacebookController extends Controller
{

    protected $helper;
    protected $facebook;
    protected $oAuth2Client;

    public function loadSdkResource()
    {

        $app_id_app_secret = Vendor::select('app_id', 'app_secret')->where('unique_id', Auth::user()->unique_id)->first();
        if (is_null($app_id_app_secret->app_id) && is_null($app_id_app_secret->app_secret)) {

            // facebook credentials array
            $credentials = array(
                'app_id' =>  env('FACEBOOK_APP_ID'),
                'app_secret' =>   env('FACEBOOK_APP_SECRET'),
                'default_graph_version' => 'v13.0'
            );
        } else {
            // facebook credentials array
            $credentials = array(
                'app_id' =>  $app_id_app_secret->app_id,
                'app_secret' =>  $app_id_app_secret->app_secret,
                'default_graph_version' => 'v13.0'
            );
        }



        // create Object of Facebook SDK
        $this->facebook = new Facebooksdk($credentials);
        // helper
        $this->helper = $this->facebook->getRedirectLoginHelper();
        //oAuth2Client
        $this->oAuth2Client = $this->facebook->getOAuth2Client();
    }


    /**
     * Get login url to connect with facebook
     * 
     * @return String
     * 
     */
    public function facebookConnect()
    {
        $this->loadSdkResource();
        //get permission from facebook
        $permissions = [
            'email',
            'ads_management',
            'public_profile',
            'instagram_basic',
            'pages_show_list',
            'instagram_content_publish',
            'pages_read_engagement',
            'business_management'
        ];

        $facebook_login_url = $this->helper->getLoginUrl(env('FACEBOOK_REDIRECT_URI'), $permissions);
        // return "<a href='{{ $facebook_login_url }}'>Login with facebook</a>";
        return $facebook_login_url;
    }

    /**
     * Generate facebook user access token
     * 
     * @return String
     * 
     */
    public function generateAccessToken()
    {

        $this->loadSdkResource();

        if (request('state')) {
            $this->helper->getPersistentDataHandler()->set('state', request('state'));
        }

        if (isset($_GET['code'])) {
            try {
                $accessToken = $this->helper->getAccessToken();
            } catch (Facebook\Exceptions\FacebookResponseException $e) { // graph error
                echo 'Graph returned an error ' . $e->getMessage;
            } catch (Facebook\Exceptions\FacebookSDKException $e) { // validation error
                echo 'Facebook SDK returned an error ' . $e->getMessage;
            }

            if (!$accessToken->isLongLived()) { // exchange short for long
                try {
                    $accessToken = $this->oAuth2Client->getLongLivedAccessToken($accessToken);
                } catch (Facebook\Exceptions\FacebookSDKException $e) {
                    echo 'Error getting long lived access token ' . $e->getMessage();
                }
            }
            $access_token = (string) $accessToken;
            return $this->getFacebookPages($access_token);
        }
    }

    /**
     * Get authenticated facebook pages
     * 
     * @param String $access_token
     * 
     * @return Array
     */
    public function getFacebookPages($access_token)
    {
        $feed_url = "https://graph.facebook.com/v13.0/me/accounts?fields=name,id,access_token&access_token=" . $access_token;
        $fb_pages =  Http::get($feed_url);
        return $this->getIgAccountInfo($access_token, $fb_pages);
    }

    /**
     * Get instagram account info
     * 
     * @return Array
     */
    public function getIgAccountInfo($access_token, $facebook_pages)
    {

        // return  $facebook_pages['data'][0]['id'];

        $arr_of_instagram_account_info = [];
        foreach ($facebook_pages['data'] as $page) {

            $feed_url = "https://graph.facebook.com/v13.0/" . $page['id'] . "?fields=instagram_business_account,id,access_token,instagram_accounts{username,profile_pic}&access_token=" . $page['access_token'];
            $response = Http::get($feed_url);

            if (isset($response["instagram_business_account"])) {
                //instagram account id which is connect to facebook page
                $ig_business_account =     $response["instagram_business_account"]["id"];
                //facebook page id where instagram account id connected
                $facebook_page_id =     $response["id"];
                $facebook_access_token =     $response["access_token"];
                $username = $response["instagram_accounts"]["data"][0]["username"];
                $profile_pic = $response["instagram_accounts"]["data"][0]["profile_pic"];

                $arr_of_instagram_account_info['ig_business_account'] =  $ig_business_account;
                $arr_of_instagram_account_info['facebook_page_id'] =  $facebook_page_id;
                $arr_of_instagram_account_info['facebook_access_token'] =  $facebook_access_token;
                $arr_of_instagram_account_info['username'] =  $username;
                $arr_of_instagram_account_info['profile_pic'] =  $profile_pic;

                // $arr_of_instagram_account_info[] = [$ig_business_account, $facebook_page_id, $facebook_access_token, $username, $profile_pic];
            }
        }

        if (!is_null($arr_of_instagram_account_info)) {
            return $this->storeIgAccountInfo($access_token, $arr_of_instagram_account_info);
        } else {
            return redirect()->route('home')->with('error', 'Please connect your instagram account with your facebook page');
        }
    }

    /**
     * Store ig account info
     * 
     * @param Array
     * 
     * @return \Illuminate\Http\Response
     */
    public function storeIgAccountInfo($access_token, $igAccountInfo)
    {

        $vendor = Vendor::where('unique_id', Auth::user()->unique_id)
            ->update([
                'ig_account' => $igAccountInfo['ig_business_account'],
                'ig_username' => $igAccountInfo['username'],
                'ig_profile_image' => $igAccountInfo['profile_pic'],
                'access_token' => $access_token,
                'status' => 2
            ]);

        return redirect('vendor/profile')->with('success', 'You are now successfully connected via facebook');
    }
}
