<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;
use Image;

use Adventrest\ServiceModel;
use Adventrest\ArticleModel;
use Adventrest\ImagesModel;

class ServiceController extends Controller
{
    //private
    function index()
    {
        $service = ServiceModel::AllService(10);
        return view('admin.service.index', [
            'path' => 'service',
            'service' => $service
        ]);
    }
    function create()
    {
        return view('admin.service.create', [
            'path' => 'service'
        ]);
    }
    function edit($idservice)
    {
        $service = ServiceModel::ServiceById($idservice);
        $images = ImagesModel::GetImagesByIdOwner($idservice, 'service');
        return view('admin.service.edit', [
            'path' => 'service',
            'idservice' => $idservice,
            'service' => $service,
            'images' => $images
        ]);
    }

    //public
    function view($id)
    {
        $service = ServiceModel::ServiceByIdOnly(base64_decode($id));
        $images = ImagesModel::GetImagesByIdOwner(base64_decode($id), 'service');
        return view('web.service.index', [
            'path' => 'service',
            'title' => config('app.name').' - Services',
            'service' => $service,
            'images' => $images
        ]);
    }
    function list()
    {
        $service = ServiceModel::AllService(10);
        return view('web.service.list', [
            'path' => 'service',
            'title' => config('app.name').' - Services',
            'service' => $service 
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
                    $destination = public_path('img/service/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/service/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $icon = $req['icon'];
                        $title = $req['title'];
                        $description = $req['description'];
                        $link = $req['link'];

                        $data = [
                            'cover' => $cvrName,
                            'icon' => $icon,
                            'title' => $title,
                            'description' => $description,
                            'link' => $link,
                            'id' => $id
                        ];

                        $sql = ServiceModel::Insert($data);
                        if ($sql) 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Publish service success',
                            ]);
                        } 
                        else 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Publish service failed',
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
            $idservice = $req['idservice'];
            $icon = $req['icon'];
            $title = $req['title'];
            $description = $req['description'];
            $link = $req['link'];

            $data = [
                'icon' => $icon,
                'title' => $title,
                'description' => $description,
                'link' => $link,
                'id' => $id
            ];

            if ($req->hasFile('cover')) 
            {
                $checkFile = Validator::make($req->all(), [
                    'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1000000',
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
                    $destination = public_path('img/service/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/service/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $data = [
                            'cover' => $cvrName,
                            'icon' => $icon,
                            'title' => $title,
                            'description' => $description,
                            'link' => $link,
                            'id' => $id
                        ];
                    }
                }
            }

            $sql = ServiceModel::Edit($data, $idservice);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited service success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Edited service failed',
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
            $idservice = $req['idservice'];

            //remove database
            $sql = ServiceModel::Remove($idservice);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Delete service success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Delete service failed',
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
