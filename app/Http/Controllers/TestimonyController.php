<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Image;

use Adventrest\TestimonyModel;

class TestimonyController extends Controller
{
    //private
    function index()
    {
        $testimony = TestimonyModel::AllTestimony(10, 'desc');
        return view('admin.testimony.index', [
            'path' => 'testimony',
            'testimony' => $testimony
        ]);
    }
    function create()
    {
        return view('admin.testimony.create', [
            'path' => 'testimony'
        ]);
    }
    function edit($idtestimony)
    {
        $testimony = TestimonyModel::TestimonyById($idtestimony);
        return view('admin.testimony.edit', [
            'path' => 'testimony',
            'testimony' => $testimony
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
                    $destination = public_path('img/testimony/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/testimony/photos/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $name = $req['name'];
                        $job = $req['job'];
                        $response = $req['response'];

                        $data = [
                            'photo' => $cvrName,
                            'name' => $name,
                            'job' => $job,
                            'response' => $response,
                            'id' => $id
                        ];

                        $sql = TestimonyModel::Insert($data);
                        if ($sql) 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Upload testimony success',
                            ]);
                        } 
                        else 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Upload testimony failed',
                            ]);
                        }

                    } 
                    else 
                    {
                        return json_encode([
                            'status' => 'error',
                            'message' => 'Upload photo failed',
                        ]);
                    }
                } 
                else 
                {
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Photo not valid',
                    ]);
                }
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Please choose one photo',
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
            $idtestimony = $req['idtestimony'];
            $name = $req['name'];
            $job = $req['job'];
            $response = $req['response'];

            $data = [
                'name' => $name,
                'job' => $job,
                'response' => $response,
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
                    $destination = public_path('img/testimony/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/testimony/photos/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $data = [
                            'photo' => $cvrName,
                            'name' => $name,
                            'job' => $job,
                            'response' => $response,
                            'id' => $id
                        ];
                    }
                }
            }

            $sql = TestimonyModel::Edit($data, $idtestimony);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited testimony success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited testimony failed',
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
            $idtestimony = $req['idtestimony'];

            //getting image
            $image = TestimonyModel::TestimonyImageById($idtestimony);

            //remove image
            $rmvThumbnail = unlink(public_path('img/testimony/thumbnails/'.$image));
            $rmvCover = unlink(public_path('img/testimony/photos/'.$image));

            if ($rmvThumbnail && $rmvCover) 
            {
                //remove database
                $sql = TestimonyModel::Remove($idtestimony);
                if ($sql) 
                {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Delete testimony success',
                    ]);
                } 
                else 
                {
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Delete testimony failed',
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
}
