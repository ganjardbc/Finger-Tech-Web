<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Image;

use Adventrest\ServiceModel;
use Adventrest\ArticleModel;

class ArticleController extends Controller
{
    //private
    function index()
    {
        $article = ArticleModel::AllArticle(10, 'desc');
        return view('admin.article.index', [
            'path' => 'article',
            'article' => $article
        ]);
    }
    function create()
    {
        return view('admin.article.create', [
            'path' => 'article'
        ]);
    }
    function edit($idarticle)
    {
        $article = ArticleModel::ArticleById($idarticle);
        return view('admin.article.edit', [
            'path' => 'article',
            'article' => $article
        ]);
    }

    //public
    function list()
    {
        $article = ArticleModel::AllArticleBlog(10, 'desc');
        return view('web/article/list', [
            'path' => 'article',
            'title' => config('app.name').' - our news & now events',
            'article' => $article
        ]);
    }
    function view($idarticle)
    {
        $words = ArticleModel::GetTitleArticle(base64_decode($idarticle));
        $article = ArticleModel::ArticleById(base64_decode($idarticle));
        $newArticle = ArticleModel::AllArticleBlog(10, 'desc');
        return view('web/article/view', [
            'path' => 'article',
            'title' => config('app.name').' - '.$words,
            'article' => $article,
            'newArticle' => $newArticle
        ]);
    }

    //post
    function changePinned(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $idarticle = $req['idarticle'];

            $rest = ArticleModel::CheckPinned($idarticle);

            if ($rest == '1') 
            {
                $pinned = '0';
            } 
            else 
            {
                $pinned = '1';
            }

            $data = [
                'pinned' => $pinned,
                'id' => $id
            ];

            $sql = ArticleModel::Edit($data, $idarticle);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'pinned' => $pinned,
                    'message' => 'Article pinnned',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Failed to pinned article',
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

    function changeDraft(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $idarticle = $req['idarticle'];

            $rest = ArticleModel::CheckDraft($idarticle);

            if ($rest == '1') 
            {
                $draft = '0';
            } 
            else 
            {
                $draft = '1';
            }

            $data = [
                'draft' => $draft,
                'id' => $id
            ];

            $sql = ArticleModel::Edit($data, $idarticle);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'draft' => $draft,
                    'message' => 'Edited article status success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited article status failed',
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
                    $destination = public_path('img/article/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/article/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $title = $req['title'];
                        $content = $req['content'];
                        $draft = $req['status'];

                        $type = 'blog';

                        $data = [
                            'cover' => $cvrName,
                            'title' => $title,
                            'content' => $content,
                            'type' => $type,
                            'draft' => $draft,
                            'id' => $id
                        ];

                        $sql = ArticleModel::Insert($data);
                        if ($sql) 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Published article success',
                            ]);
                        } 
                        else 
                        {
                            return json_encode([
                                'status' => 'success',
                                'message' => 'Published article failed',
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
            $idarticle = $req['idarticle'];
            $title = $req['title'];
            $content = $req['content'];
            $draft = $req['status'];

            $type = 'blog';

            $data = [
                'title' => $title,
                'content' => $content,
                'type' => $type,
                'draft' => $draft,
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
                    $destination = public_path('img/article/thumbnails/'.$filename);
                    $img = Image::make($cover->getRealPath());

                    $thumbnail = $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);
        
                    //create image real
                    $destination = public_path('img/article/covers/');
                    $real = $cover->move($destination, $filename); 

                    if ($thumbnail && $real) 
                    {
                        $cvrName = $filename;
                        $data = [
                            'cover' => $cvrName,
                            'title' => $title,
                            'content' => $content,
                            'type' => $type,
                            'draft' => $draft,
                            'id' => $id
                        ];
                    }
                }
            }

            $sql = ArticleModel::Edit($data, $idarticle);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited article success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited article failed',
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
            $idarticle = $req['idarticle'];

            //getting image
            $image = ArticleModel::ArticleImageById($idarticle);

            if (true) 
            {
                //remove database
                $sql = ArticleModel::Remove($idarticle);
                if ($sql) 
                {
                    //remove image
                    $rmvThumbnail = unlink(public_path('img/article/thumbnails/'.$image));
                    $rmvCover = unlink(public_path('img/article/covers/'.$image));
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Delete article success',
                    ]);
                } 
                else 
                {
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Delete article failed',
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
