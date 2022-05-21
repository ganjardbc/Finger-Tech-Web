<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Image;

use Adventrest\ImagesModel;

class ImagesController extends Controller
{
    //get
    function index()
    {
        $images = ImagesModel::AllImages(10);
        return view('admin.images.index', [
            'path' => 'images',
            'images' => $images
        ]);
    }
    function create($idowner, $type)
    {
        return view('admin.images.create', [
            'path' => 'images',
            'idowner' => $idowner,
            'type' => $type,
        ]);
    }
    function edit($idowner, $idimages)
    {
        $images = ImagesModel::GetImagesById($idimages);
        return view('admin.images.edit', [
            'path' => 'images',
            'idowner' => $idowner,
            'images' => $images
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
                    $destination = public_path('img/images/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/images/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $description = $req['description'];
                        $type = $req['type'];
                        $idowner = $req['idowner'];

                        $data = [
                            'cover' => $cvrName,
                            'description' => $description,
                            'type' => $type,
                            'idowner' => $idowner,
                            'id' => $id
                        ];

                        $sql = ImagesModel::Insert($data);
                        if ($sql) 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Publish images success',
                            ]);
                        } 
                        else 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Publish images failed',
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
            $idimages = $req['idimages'];
            $description = $req['description'];
            $type = $req['type'];
            $idowner = $req['idowner'];

            $data = [
                'description' => $description,
                'type' => $type,
                'idowner' => $idowner,
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
                    $destination = public_path('img/images/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/images/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $data = [
                            'cover' => $cvrName,
                            'description' => $description,
                            'type' => $type,
                            'idowner' => $idowner,
                            'id' => $id
                        ];
                    }
                }
            }

            $sql = ImagesModel::Edit($data, $idimages);
            return json_encode([
                'status' => 'success',
                'message' => 'Edited images success',
            ]);
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
            $idimages = $req['idimages'];

            //remove database
            $sql = ImagesModel::Remove($idimages);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Delete images success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Delete images failed',
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
