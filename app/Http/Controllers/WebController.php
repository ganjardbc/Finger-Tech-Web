<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;

use Adventrest\BannerModel;
use Adventrest\ServiceModel;
use Adventrest\GaleryModel;
use Adventrest\ArticleModel;
use Adventrest\NoteModel;
use Adventrest\TestimonyModel;
use Adventrest\TagModel;

class WebController extends Controller
{
    protected $token = '2052574873.877ad90.fba27260465e4fe69cd359a0f2563274';

    function index()
    {
        $tag = 'uiux';
        $url = 'https://api.instagram.com/v1/users/self/media/recent?access_token='.$this->token.'&count=4';

        $banner = BannerModel::AllBanner(10);
        $service = ServiceModel::AllService(3);
        $galery = GaleryModel::AllGalery(10, 'desc');
        $article = ArticleModel::AllArticleBlog(3, 'desc');
        $pinned = ArticleModel::AllArticlePined(2, 'desc');
        $note = NoteModel::AllNote(20, 'desc');
        $testimony = TestimonyModel::AllTestimony(3, 'desc');
        $insta = TagModel::GetGaleryByTag(4, 'instagram');
        return view('web.index', [
            'path' => 'home',
            'title' => config('app.name').' - Reliable IT Solution Partner',
            'banner' => $banner,
            'service' => $service,
            'galery' => $galery,
            'article' => $article,
            'pinned' => $pinned,
            'note' => $note,
            'testimony' => $testimony,
            'insta' => $insta
        ]);

        //$insta = json_decode(file_get_contents($url));//$this->instagram_connect($url);
        //echo json_encode($this->instagram_access_token());
    }

    function search()
    {
        $ctr = $_GET['src'];
        $nav = $_GET['nav'];
        if ($nav == 'article') {
            $search = ArticleModel::SearchArticle($ctr, 10, 'desc');   
        }
        if ($nav == 'portofolio') {
            $search = GaleryModel::SearchGalery($ctr, 10, 'desc');   
        }
        return view('web.search.index', [
            'path' => 'search',
            'title' => config('app.name').' - '.ucwords($ctr),
            'search' => $search
        ]);
    }

    function admin()
    {
        return view('admin.index', [
            'path' => 'home'
        ]);
    }

    function instagram()
    {
        $url = 'https://api.instagram.com/v1/users/self/media/recent?access_token='.$this->token.'&count=16';
        $insta = json_decode(file_get_contents($url));
        return view('web.instagram.list', [
            'path' => 'instagram',
            'insta' => $insta->data
        ]);
    }

    function instagram_access_token()
    {
        //CLIENT_ID:877ad909a58d49c98d8e008fd49fd9bc
        //https://api.instagram.com/oauth/authorize/?client_id=877ad909a58d49c98d8e008fd49fd9bc&redirect_uri=http://localhost:8000&response_type=code&scope=public_content

        $fields = array(
            'client_id'     => '877ad909a58d49c98d8e008fd49fd9bc',
            'client_secret' => 'a7544070697641b6ad6efa0421c34972',
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => 'http://localhost:8000/',
            'code'          => 'a883cf9e6e1041368c5af8a6d5f200bb'
        );
        $url = 'https://api.instagram.com/oauth/access_token';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch,CURLOPT_POST,true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        curl_close($ch); 
        $result = json_decode($result);
        return $result;
    }

    function instagram_connect( $api_url )
    {
        $connection_c = curl_init(); // initializing
        curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
        curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
        curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
        $json_return = curl_exec( $connection_c ); // connect and get json data
        curl_close( $connection_c ); // close connection
        $result = json_decode( $json_return ); // decode and return
        return $result;
    }

    //sites
    function aboutUs()
    {
        return view('web.sites.aboutUs', [
            'path' => 'about-us',
            'title' => config('app.name').' - About Us',
        ]);
    }
    function contacts()
    {
        $service = ServiceModel::All();
        return view('web.sites.contacts', [
            'path' => 'contacts',
            'title' => config('app.name').' - Contacts',
            'service' => $service,
        ]);
    }
    function tnc()
    {
        return view('web.sites.tnc', [
            'path' => 'information',
            'title' => config('app.name').' - Terms & Condition',
        ]);
    }
    function privacy()
    {
        return view('web.sites.privacy', [
            'path' => 'information',
            'title' => config('app.name').' - Privacy',
        ]);
    }
    function faq()
    {
        return view('web.sites.faq', [
            'path' => 'information',
            'title' => config('app.name').' - FAQ',
        ]);
    }
}
