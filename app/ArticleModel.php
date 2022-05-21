<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticleModel extends Model
{
    protected $table = 'article';

    //create
    function scopeInsert($query, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($query, $data, $idarticle)
    {
        return DB::table($this->table)
        ->where('article.idarticle', $idarticle)
        ->update($data);
    }

    //delete
    function scopeRemove($query, $idarticle)
    {
        return DB::table($this->table)
        ->where('article.idarticle', $idarticle)
        ->delete();
    }

    //draft check
    function scopeCheckDraft($query, $idarticle)
    {
        return DB::table($this->table)
        ->where('idarticle', $idarticle)
        ->value('draft');
    }
    function scopeCheckPinned($query, $idarticle)
    {
        return DB::table($this->table)
        ->where('idarticle', $idarticle)
        ->value('pinned');
    }

    //read
    function scopeGetTitleArticle($query, $idarticle)
    {
        return DB::table($this->table)
        ->where('article.idarticle', $idarticle)
        ->value('article.title');
    }
    function scopeArticleImageById($query, $idarticle)
    {
        return DB::table($this->table)
        ->where('article.idarticle', $idarticle)
        ->value('article.cover');
    }
    function scopeAllArticle($query, $limit, $order = 'asc')
    {
        return DB::table($this->table)
        ->select(
            'article.idarticle',
            'article.cover',
            'article.title',
            'article.content',
            'article.type',
            'article.date',
            'article.draft as is_draft',
            'article.pinned as is_pinned',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'article.id')
        ->orderBy('article.idarticle', $order)
        ->paginate($limit);
    }

    function scopeSearchArticle($query, $ctr, $limit, $order = 'asc')
    {
        //change orWhere to where
        $searchValues = preg_split('/\s+/', $ctr, -1, PREG_SPLIT_NO_EMPTY);
        return DB::table($this->table)
        ->select(
            'article.idarticle',
            'article.cover',
            'article.title',
            'article.content',
            'article.type',
            'article.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'article.id')
        ->where('article.draft', '0')
        ->where('article.title','like',"%$ctr%")
        ->where('article.content','like',"%$ctr%")
        ->where(function ($q) use ($searchValues)
        {
            foreach ($searchValues as $value) {
                $q->where('article.title','like',"%$value%");
                $q->where('article.content','like',"%$value%");
            }
        })
        ->orderBy('article.idarticle', $order)
        ->paginate($limit);
    }

    function scopeAllArticleBlog($query, $limit, $order = 'asc')
    {
        return DB::table($this->table)
        ->select(
            'article.idarticle',
            'article.cover',
            'article.title',
            'article.content',
            'article.type',
            'article.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'article.id')
        ->orderBy('article.idarticle', $order)
        ->where('article.draft', '0')
        ->paginate($limit);
    }

    function scopeArticleById($query, $idarticle)
    {
        return DB::table($this->table)
        ->select(
            'article.idarticle',
            'article.cover',
            'article.title',
            'article.content',
            'article.type',
            'article.date',
            'article.draft as is_draft',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'article.id')
        ->where('article.idarticle', $idarticle)
        ->first();
    }

    function scopeAllArticlePined($query, $limit, $order = 'asc')
    {
        return DB::table($this->table)
        ->select(
            'article.idarticle',
            'article.cover',
            'article.title',
            'article.content',
            'article.type',
            'article.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'article.id')
        ->where('article.pinned', '1')
        ->where('article.draft', '0')
        ->orderBy('article.pinned', $order)
        ->paginate($limit);
    }
}
