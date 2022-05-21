<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Image;

use Adventrest\User;
use Adventrest\AdminModel;

class AdminController extends Controller
{
    //private
    function index()
    {
        $user = AdminModel::AllUser(10, 'desc');
        return view('admin.admin.index', [
            'path' => 'admin',
            'user' => $user
        ]);
    }
    function create()
    {
        return view('admin.admin.create', [
            'path' => 'admin'
        ]);
    }
    function edit()
    {
        $id = Auth::id();
        $user = AdminModel::UserById($id);
        return view('admin.admin.edit', [
            'path' => 'edit',
            'user' => $user
        ]);
    }

    //
    function publish(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $data = [
                'name' => $req['name'],
                'email' => $req['email'],
                'username' => explode('@', $req['email'])[0],
                'password' => Hash::make($req['password']),
            ];
            AdminModel::Insert($data);
            if ($sql) 
            {
                /*return json_encode([
                    'status' => 'success',
                    'message' => 'Admin created',
                ]);*/
                return redirect()->route('listAdmin');
            } 
            else 
            {
                /*return json_encode([
                    'status' => 'error',
                    'message' => 'There is an error please try again',
                ]);*/
                return redirect()->route('createAdmin');
            }
            
        } 
        else 
        {
            /*return json_encode([
                'status' => 'error',
                'message' => 'Access denied',
            ]);*/
            return redirect()->route('createAdmin');
        }
    }

    function photo(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            if ($req->hasFile('photo')) 
            {
                $checkFile = Validator::make($req->all(), [
                    'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:50000',
                ]);

                if ($checkFile) 
                {
                    $photo = $req->file('photo');
        
                    $chrc = array(
                        '[',']','@',' ','+','-','#','*',
                        '<','>','_','(',')',';',',','&',
                        '%','$','!','`','~','=','{','}',
                        '/',':','?','"',"'",'^'
                    );
                    $filename = $id.time().str_replace($chrc, '', $photo->getClientOriginalName());
        
                    //create thumbnail
                    $destination = public_path('img/admin/thumbnails/'.$filename);
                    $img = Image::make($photo->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/admin/photos/');
                    $real = $photo->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;

                        $data = [
                            'photo' => $cvrName,
                        ];

                        $sql = AdminModel::Edit($data, $id);
                        if ($sql) 
                        {

                            return json_encode([
                                'status' => 'success',
                                'message' => 'Edited akun success',
                            ]);
                        } 
                        else 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Edited akun failed',
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
            $name = $req['name'];
            $email = $req['email'];
            $username = $req['username'];

            $data = [
                'name' => $name,
                'email' => $email,
                'username' => $username
            ];

            $sql = AdminModel::Edit($data, $id);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited account success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Edited account failed',
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

    function password(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $oldPassword = Hash::make($req['oldPassword']);
            $newPassword = $req['newPassword'];
            $confirmPassword = $req['confirmPassword'];

            //check password lama
            $check = AdminModel::CheckPassword($oldPassword, $id);
            if (!empty($check))
            {
                //check password konfirmasi
                if ($newPassword == $confirmPassword) 
                {
                    $data = [
                        'password' => Hash::make($newPassword),
                    ];
        
                    $sql = AdminModel::Edit($data, $id);
                    if ($sql) 
                    {
                        return json_encode([
                            'status' => 'success',
                            'message' => 'Edited password success',
                        ]);
                    } 
                    else 
                    {
                        return json_encode([
                            'status' => 'error',
                            'message' => 'Edited password failed',
                        ]);
                    }
                } 
                else 
                {
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Your new & confirm password are wrong',
                    ]);
                }
                
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Your old password is wrong',
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
        $iduser = $req['idadmin'];
        $id = Auth::id();
        if (!empty($id)) 
        {
            $image = AdminModel::UserPhotoById($iduser);

            if (true) 
            {
                //remove database
                $sql = AdminModel::Remove($iduser);
                if ($sql) 
                {
                    //remove image
                    $rmvThumbnail = unlink(public_path('img/admin/thumbnails/'.$image));
                    $rmvCover = unlink(public_path('img/admin/photos/'.$image));

                    return json_encode([
                        'status' => 'success',
                        'message' => 'Delete admin success',
                    ]);
                } 
                else 
                {
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Delete admin failed',
                    ]);
                }
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Delete photo failed',
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
