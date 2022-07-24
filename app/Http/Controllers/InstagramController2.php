<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class InstagramController extends Controller
{


    /**
     * instagram post decesion maker
     * 
     * @param Object $post
     */
    public function instagramPostDescesionMaker($post)
    {

        // $ig_account = $post->ig_account;
        // $access_token = $post->access_token;

        $ig_account = 17841404804688719;
        $access_token = "EAAOyUbzPRwoBAGRUADkkLBHtBnmPo8p9cJ8MmpJ0U6xHbl4qEm0j5x1bQzgTQfWLpA0itCCylpkO1YGZB92jitsjdLVKol4IDokpyrlRP2yhTeoxpYFlvEgSCZA8hSOFEQ5JcN9Va9zP2ZA40OD9l3V12QHzNy2fIhWMxWyc9G0oZAl1TZAi6mczQ6yieWrsZD";
        $caption = $post->content;
        // $images = json_decode($post->image);

        $images = ['https://giopio.com/images/Linkdin-post-giopio-schedule-post.jpg', 'https://giopio.com/images/collect-facebook-leads.jpg', 'https://giopio.com/images/web-design-and-development.jpg'];

        if ($post->image_flug == 1) {
            $image = $images[0];
            //only single image post on instagram feed
            return $this->postSingleImage($ig_account, $image, $caption, $access_token);
        } else {
            //multiple image(carosel) post on instagram feed
            return $this->postMultipleImage($ig_account, $images, $caption, $access_token);
        }
    }

    /**
     * carosel chiled upload
     * 
     * 
     */
    public function childrenUpload($ig_account, $image, $access_token)
    {
        $url = 'https://graph.facebook.com/v13.0/' . $ig_account . '/media?image_url=' . $image . '&is_carousel_item=true&access_token=' . $access_token;
        $response = Http::post($url);

        $json_data = json_decode($response);
        $child_id = $json_data->id;
        return $child_id;
    }

    /**
     * post multiple image with / without content
     * 
     * @param int $ag_account
     * @param Array $images
     * @param String $caption,$access_token
     * 
     * @return Json Object
     */
    public function postMultipleImage($ig_account, $images, $caption = null, $access_token)
    {


        $childrens = [];
        $carosel_ids = '';
        $url = '';
        for ($i = 0; $i < count($images); $i++) {
            $childrens[] = $this->childrenUpload($ig_account, $images[$i], $access_token);
        }

        for ($i = 0; $i < count($childrens); $i++) {
            if ($i < count($childrens) - 1) {
                $carosel_ids .= $childrens[$i] . '%2C';
            } else {
                $carosel_ids .= $childrens[$i];
            }
        }

        if ($caption == null) {
            $url =  'https://graph.facebook.com/v13.0/' . $ig_account . '/media?media_type=CAROUSEL&children=' . $carosel_ids . '&access_token=' . $access_token;
        } else {
            $url =  'https://graph.facebook.com/v13.0/' . $ig_account . '/media?caption=' . $caption . '&media_type=CAROUSEL&children=' . $carosel_ids . '&access_token=' . $access_token;
        }

        $response = Http::post($url);
        $json_data = json_decode($response);
        $creational_id = $json_data->id;

        $published_url = 'https://graph.facebook.com/v13.0/' . $ig_account . '/media_publish?creation_id=' . $creational_id . '&access_token=' . $access_token;
        return $carosel = Http::post($published_url);
    }

    /**
     * post single image with / without content
     * 
     * @param int $ig_account
     * @param String $image,$caption,$access_token
     * 
     * @return Json Object
     */
    public function postSingleImage($ig_account, $image, $caption = null, $access_token)
    {

        $feed_url = '';
        if ($caption == null) {
            $feed_url = 'https://graph.facebook.com/v13.0/' . $ig_account . '/media?image_url=' . $image . '&access_token=' . $access_token;
        } else {
            $feed_url =  'https://graph.facebook.com/v13.0/' . $ig_account . '/media?image_url=' . $image . '&caption=' . $caption . '&access_token=' . $access_token;
        }

        $json_response =  Http::post($feed_url);
        $response = json_decode($json_response);

        $url = 'https://graph.facebook.com/v13.0/' . $ig_account . '/media_publish?creation_id=' . $response->id . '&access_token=' . $access_token;;
        return $media_publish =  Http::post($url);
    }
}
