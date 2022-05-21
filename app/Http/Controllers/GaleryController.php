<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Image;

use Adventrest\GaleryModel;
use Adventrest\TagModel;
use Adventrest\ImagesModel;

class GaleryController extends Controller
{
    //private
    function index()
    {
        $galery = GaleryModel::AllGalery(12, 'desc');
        return view('admin.galery.index', [
            'path' => 'galery',
            'title' => 'Daftar Galeri',
            'galery' => $galery
        ]);
    }
    function create()
    {
        return view('admin.galery.create', [
            'path' => 'galery'
        ]);
    }
    function edit($idgalery)
    {
        $galery = GaleryModel::GaleryById($idgalery);
        $tags = TagModel::GetTagsByComa($idgalery);
        $images = ImagesModel::GetImagesByIdOwner($idgalery, 'portofolio');
        return view('admin.galery.edit', [
            'path' => 'galery',
            'idgalery' => $idgalery,
            'galery' => $galery,
            'tags' => $tags,
            'images' => $images
        ]);
    }

    //public
    function list()
    {
        $gallery = GaleryModel::AllGalery(12, 'desc');
        $tags = TagModel::GetTopTags(12);
        return view('web.galery.list', [
            'path' => 'portofolio',
            'title' => config('app.name').' - Portofolios',
            'gallery' => $gallery
        ]);
    }
    function view($id)
    {
        $gallery = GaleryModel::GaleryByIdOnly(base64_decode($id));
        $images = ImagesModel::GetImagesByIdOwner(base64_decode($id), 'portofolio');
        return view('web.galery.index', [
            'path' => 'portofolio',
            'title' => config('app.name').' - Portofolios',
            'gallery' => $gallery,
            'images' => $images
        ]);
    }
    function tags($tag)
    {
        $galery = TagModel::GetGaleryByTag(4, $tag);
        $tags = TagModel::GetTopTags(12);
        return view('web.galery.list', [
            'path' => 'portofolio',
            'title' => 'Daftar Galeri Terbaru - Kebun Begonia Lembang',
            'galery' => $galery,
            'tags' => $tags
        ]);
    }

    //funtion
    function mentions($tags, $idgalery)
    {
        $replace = array(
            '[',']','@','+','-','*','<','>',
            '-','(',')',';','&','%','$','!',
            '`','~','=','{','}','/',':','?',
            '"',"'",'^'
        );
        $str1 = str_replace($replace, '', $tags);
        $str2 = str_replace(array(', ', ' , ', ' ,'), ',', $str1);
        $tag = explode(',', $str2);
        $count_tag = count($tag);

        for ($i = 0; $i < $count_tag; $i++) {
            if ($tag[$i] != '') {
                $data = array([
                    'tag' => $tag[$i],
                    'idgalery' => $idgalery
                ]);
                TagModel::Insert($data);
            }
        }
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
                    $destination = public_path('img/galery/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/galery/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $title = $req['title'];
                        $description = $req['description'];
                        $tags = $req['tags'];

                        $data = [
                            'cover' => $cvrName,
                            'title' => $title,
                            'description' => $description,
                            'id' => $id
                        ];

                        $sql = GaleryModel::Insert($data);
                        if ($sql) 
                        {
                            $idgalery = GaleryModel::GetGaleryRecentId();
                            $this->mentions($tags, $idgalery);

                            return json_encode([
                                'status' => 'success',
                                'message' => 'Upload galery success',
                            ]);
                        } 
                        else 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Upload galery failed',
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
            $idgalery = $req['idgalery'];
            $title = $req['title'];
            $description = $req['description'];
            $tags = $req['tags'];

            $data = [
                'title' => $title,
                'description' => $description,
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
                    $destination = public_path('img/galery/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/galery/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $data = [
                            'cover' => $cvrName,
                            'description' => $description,
                            'id' => $id
                        ];
                    }
                }
            }

            //remove tags
            TagModel::RemoveByIdgalery($idgalery);

            //add mentions
            $this->mentions($tags, $idgalery);

            $sql = GaleryModel::Edit($data, $idgalery);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited galery success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited galery failed',
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
            $idgalery = $req['idgalery'];

            //getting image
            $image = GaleryModel::GaleryImageById($idgalery);

            if (true) 
            {
                //remove database
                $sql = GaleryModel::Remove($idgalery);
                if ($sql) 
                {
                    //remove image
                    $rmvThumbnail = unlink(public_path('img/galery/thumbnails/'.$image));
                    $rmvCover = unlink(public_path('img/galery/covers/'.$image));
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Delete galery success',
                    ]);
                } 
                else 
                {
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Delete galery failed',
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
