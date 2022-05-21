<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TagModel extends Model
{
    protected $table = 'tags';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($quer, $data, $idtags)
    {
        return DB::table($this->table)
        ->where('tags.idtags', $idtags)
        ->update($data);
    }

    //delete
    function scopeRemove($quer, $idtags)
    {
        return DB::table($this->table)
        ->where('tags.idtags', $idtags)
        ->delete();
    }
    function scopeRemoveByIdgalery($quer, $idgalery)
    {
        return DB::table($this->table)
        ->where('tags.idgalery', $idgalery)
        ->delete();
    }

    //read
    function scopeGetTagsByComa($query, $idgalery)
    {
        $restTags = $this->GetTags($idgalery);
        $temp = [];
        foreach ($restTags as $tag) {
            array_push($temp, $tag->tag);
        }
        $tags = implode(", ", $temp);
        return $tags;
    }
    function scopeGetTags($query, $idgalery)
    {
        return DB::table($this->table)
        ->select('idtags', 'tag')
        ->where('tags.idgalery', $idgalery)
        ->orderBy('tags.idtags', 'asc')
        ->get();
    }
    function scopeGetTagsById($query, $idgalery)
    {
        return DB::table($this->table)
        ->select('idtags', 'tag')
        ->where('tags.idgalery', $idgalery)
        ->orderBy('tags.idtags', 'asc')
        ->get();
    }
    function scopeGetTopTags($query, $limit)
    {
    	return DB::table($this->table)
        ->select(
            'tags.tag',
            DB::raw('count(tags.idtags) as ttl_tag')
        )
        ->groupBy('tags.tag')
        ->orderBy('ttl_tag', 'desc')
        ->limit($limit)
        ->get();
    }
    function scopeGetGaleryByTag($query, $limit, $tag)
    {
    	return DB::table($this->table)
        ->select(
            'tags.idtags',
            'tags.tag',
            'galery.idgalery',
            'galery.cover',
            'galery.description',
            'galery.date',
            'galery.id'
        )
        ->join('galery', 'galery.idgalery', '=', 'tags.idgalery')
        ->where('tags.tag', 'like', "%{$tag}%")
        ->orderBy('galery.idgalery', 'desc')
        ->paginate($limit);
    }
}
