<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{


    protected $instagram;
    protected $transanction;
    protected $payment;

    public function __construct(InstagramController $instagram, TransanctionController $transanction, PaymentController $payment)
    {
        $this->instagram = $instagram;
        $this->transanction = $transanction;
        $this->payment = $payment;
    }

    /**
     * Display form to create post
     * 
     * @return \Illuminate\View\View
     */
    public function create($unique_id)
    {
        $vendor = Vendor::where('unique_id', $unique_id)->first();
        $ig_account = $vendor->ig_account;
        $ig_account_owner_unique_id = $vendor->unique_id;
        $access_token = $vendor->access_token;
        $post_price = $vendor->post_price;
        return view('post.create-new', compact('ig_account', 'ig_account_owner_unique_id', 'access_token', 'post_price'));
    }

    /**
     * Store new post into DB
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        //validate request
        $request->validate([

            'images' => 'required',
            // 'content'=>'required'
        ]);

        $ig_account_owner_unique_id = $request->ig_account_owner_unique_id;
        $ig_account = $request->ig_account;
        $access_token = $request->access_token;
        $post_price = $request->post_price;

        $img_urls = null;
        $img_flug = null;
        if ($request->hasFile('images')) {

            $images_urls = $this->myImageUpload($request);
            $img_urls =   json_encode($images_urls);
            $img_flug = count($images_urls);
        }
        $post = new Post();
        $post->image = $img_urls;
        $post->content = str_replace("#", "", $request->content);
        $post->image_flug =  $img_flug;
        $post->content_flug = $request->content == null ? 0 : 1;


        $post->ig_account =  $ig_account;
        // $post->user_unique_id =  Auth::user()->unique_id;
        $post->ig_account_owner_unique_id = $ig_account_owner_unique_id;
        $post->access_token = $access_token;
        $post->save();

        session()->put('post_id', $post->id);

        $post_id = session()->get('post_id');

        $post = Post::where('id',  $post_id)->where('status', 0)->latest('created_at')->first();
        $published_url =  $this->instagram->instagramPostDescesionMaker($post);
        if (!is_null($published_url)) {
            session()->put('publish_url', $published_url);
            return  view('payment', compact('post', 'post_price'));
            // $paypal_transanction =  $this->payment->charge($request);
        }
    }

    /**
     * post publish to instagram feed
     * 
     */
    public static function postPublished()
    {
        $published_url =   session()->get('publish_url');
        $media_publish =  Http::post($published_url);
        $json_response = json_decode($media_publish);
        if (property_exists($json_response, 'error')) {
            return response()->json([
                'status' => 500,
                'message' => $json_response->error->error_user_msg
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Post published successfully'
            ]);
        }
    }

    /**
     * Upload image to local machin 
     * 
     * @return Array of image url
     */
    public function imageUpload($request)
    {

        $img_arr = [];
        $img_urls = [];

        $request_images = $request->file('images');
        for ($i = 0; $i < count($request_images); $i++) {
            $image_name =  Carbon::now()->toDateString() . '-' . uniqid() . '_instagram.' . $request_images[$i]->clientExtension();
            $img_arr[] = $image_name;
        }

        for ($i = 0; $i < count($request_images); $i++) {
            //image upload
            $image = getimagesize($request_images[$i]);
            //findout image width
            $width = $image[0];
            //findout image height
            $height = $image[1];
            //findout image retio
            $ratio = $width / $height;
            //image upload with custom size
            $original_image = $request_images[$i];

            if (isset($original_image)) {
                if (!file_exists('uploads/posts_image')) {
                    mkdir('uploads/posts_image', 0777, true);
                }
                $instagram_image = Image::make($original_image);
                $image_path = public_path('/uploads/posts_image/');

                if ($ratio == 1) {
                    $height = 1080;
                    $width  = 1080;
                }
                if ($ratio > 1) {
                    $height = 1080;
                    $width  = 608;
                }
                if ($ratio < 1) {
                    $height = 1080;
                    $width  = 1350;
                }
                $image_name =  Carbon::now()->toDateString() . '-' . uniqid() . '_instagram.' . $original_image->clientExtension();
                $instagram_image->resize($height, $width);
                $instagram_image->save($image_path . $image_name);

                $image_url = url('uploads/posts_image/' . $image_name);

                $img_urls[] = $image_url;
            }
        }

        return $img_urls;
    }


    //
    public function myImageUpload($request)
    {

        $img_arr = [];
        $img_urls = [];

        $request_images = $request->file('images');
        for ($i = 0; $i < count($request_images); $i++) {

            if (isset($request_images[$i])) {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate . '-' . uniqid() . '.' . $request_images[$i]->getClientOriginalExtension();
                if (!file_exists('uploads/posts_image')) {
                    mkdir('uploads/posts_image', 0777, true);
                }

                $img_arr[] = $imagename;
                $request_images[$i]->move('uploads/posts_image', $imagename);

                $image_url = url('uploads/posts_image/' . $imagename);

                $img_urls[] = $image_url;
            }
        }

        return $img_urls;
    }
}
