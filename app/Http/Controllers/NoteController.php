<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Image;

use Adventrest\NoteModel;

class NoteController extends Controller
{
    //private
    function index()
    {
        $note = NoteModel::AllNote(10);
        return view('admin.note.index', [
            'path' => 'note',
            'note' => $note
        ]);
    }
    function create()
    {
        return view('admin.note.create', [
            'path' => 'note'
        ]);
    }
    function edit($idnote)
    {
        $note = NoteModel::NoteById($idnote);
        return view('admin.note.edit', [
            'path' => 'note',
            'note' => $note
        ]);
    }

    //public
    function list($idnote)
    {
        $note = NoteModel::NoteById(base64_decode($idnote));
        return view('web.note.index', [
            'note' => $note
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
                    $destination = public_path('img/note/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/note/covers/');
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

                        $sql = NoteModel::Insert($data);
                        if ($sql) 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Publish note success',
                            ]);
                        } 
                        else 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Publish note failed',
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
            $idnote = $req['idnote'];
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
                    $destination = public_path('img/note/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/note/covers/');
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

            $sql = NoteModel::Edit($data, $idnote);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited note success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Edited note failed',
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
            $idnote = $req['idnote'];

            //remove database
            $sql = NoteModel::Remove($idnote);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Delete note success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Delete note failed',
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
