<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Auth;

//model
use Adventrest\BannerModel;
use Adventrest\ImagesModel;

class BannerController extends Controller
{
    //get
    function index()
    {
        $banner = BannerModel::AllBanner(10);
        return view('admin.banner.index', [
            'path' => 'banner',
            'banner' => $banner
        ]);
    }
    function create()
    {
        return view('admin.banner.create', [
            'path' => 'banner'
        ]);
    }
    function edit($idbanner)
    {
        $banner = BannerModel::BannerById($idbanner);
        $images = ImagesModel::GetImagesByIdOwner($idbanner, 'product');
        return view('admin.banner.edit', [
            'path' => 'banner',
            'idbanner' => $idbanner,
            'banner' => $banner,
            'images' => $images
        ]);
    }

    //public
    function view($id)
    {
        $banner = BannerModel::BannerByIdOnly(base64_decode($id));
        $images = ImagesModel::GetImagesByIdOwner(base64_decode($id), 'product');
        return view('web.banner.index', [
            'path' => 'product',
            'title' => config('app.name').' - Products',
            'banner' => $banner,
            'images' => $images
        ]);
    }
    function list()
    {
        $banner = BannerModel::AllBanner(10);
        return view('web.banner.list', [
            'path' => 'product',
            'title' => config('app.name').' - Products',
            'banner' => $banner 
        ]);
    }

    //post
    function publish(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            if ($req->hasFile('cover')) 
            {
                $checkFile = Validator::make($req->all(), [
                    'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:50000',
                ]);

                if ($checkFile) 
                {
                    $cover = $req->file('cover');
        
                    $chrc = array(
                        '[',']','@',' ','+','-','#','*',
                        '<','>','_','(',')',';',',','&',
                        '%','$','!','`','~','=','{','}',
                        '/',':','?','"',"'",'^'
                    );
                    $filename = $id.time().str_replace($chrc, '', $cover->getClientOriginalName());
        
                    //create thumbnail
                    $destination = public_path('img/banner/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/banner/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $title = $req['title'];
                        $description = $req['description'];
                        $link = $req['link'];
                        $position = $req['position'];

                        $data = [
                            'cover' => $cvrName,
                            'title' => $title,
                            'description' => $description,
                            'link' => $link,
                            'position' => $position,
                            'id' => $id
                        ];

                        $sql = BannerModel::Insert($data);
                        if ($sql) 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Upload banner success',
                            ]);
                        } 
                        else 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Upload banner failed',
                            ]);
                        }

                    } 
                    else 
                    {
                        return json_encode([
                            'status' => 'error',
                            'message' => 'Upload cover failed',
                        ]);
                    }
                } 
                else 
                {
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Cover not valid',
                    ]);
                }
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Please choose one cover',
                ]);
            }
        } 
        else 
        {
            return json_encode([
                'status' => 'error',
                'message' => 'Access denied',
            ]);
        }

    }

    function put(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $idbanner = $req['idbanner'];
            $title = $req['title'];
            $description = $req['description'];
            $link = $req['link'];
            $position = $req['position'];

            $data = [
                'title' => $title,
                'description' => $description,
                'link' => $link,
                'position' => $position,
                'id' => $id
            ];

            if ($req->hasFile('cover')) 
            {
                $checkFile = Validator::make($req->all(), [
                    'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000000',
                ]);

                if ($checkFile) 
                {
                    $cover = $req->file('cover');
        
                    $chrc = array(
                        '[',']','@',' ','+','-','#','*',
                        '<','>','_','(',')',';',',','&',
                        '%','$','!','`','~','=','{','}',
                        '/',':','?','"',"'",'^'
                    );
                    $filename = $id.time().str_replace($chrc, '', $cover->getClientOriginalName());
        
                    //create thumbnail
                    $destination = public_path('img/banner/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/banner/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $data = [
                            'cover' => $cvrName,
                            'title' => $title,
                            'description' => $description,
                            'link' => $link,
                            'position' => $position,
                            'id' => $id
                        ];
                    }
                }
            }

            $sql = BannerModel::Edit($data, $idbanner);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited banner success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited banner failed',
                ]);
            }
        } 
        else 
        {
            return json_encode([
                'status' => 'error',
                'message' => 'Access denied',
            ]);
        }

    }

    function remove(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $idbanner = $req['idbanner'];

            //getting image
            $image = BannerModel::BannerImageById($idbanner);

            if (true) 
            {
                //remove database
                $sql = BannerModel::Remove($idbanner);
                if ($sql) 
                {
                    //remove image
                    $rmvThumbnail = unlink(public_path('img/banner/thumbnails/'.$image));
                    $rmvCover = unlink(public_path('img/banner/covers/'.$image));
                    
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Delete banner success',
                    ]);
                } 
                else 
                {
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Delete banner failed',
                    ]);
                }
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Delete cover failed',
                ]);
            }
        } 
        else 
        {
            return json_encode([
                'status' => 'error',
                'message' => 'Access denied',
            ]);
        }
    }

    function changePosition(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $idbanner = $req['idbanner'];
            $position = $req['position'];

            $data = [
                'position' => $position,
                'id' => $id
            ];

            $sql = BannerModel::Edit($data, $idbanner);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited banner success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Edited banner failed',
                ]);
            }
        } 
        else 
        {
            return json_encode([
                'status' => 'error',
                'message' => 'Access denied',
            ]);
        }

    }
}
