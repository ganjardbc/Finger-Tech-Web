<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImagesModel extends Model
{
    protected $table = 'images';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($quer, $data, $idimages)
    {
        return DB::table($this->table)
        ->where('images.idimages', $idimages)
        ->update($data);
    }

    //delete
    function scopeRemove($quer, $idimages)
    {
        return DB::table($this->table)
        ->where('images.idimages', $idimages)
        ->delete();
    }

    //read
    function scopeAllImages($query, $limit, $order = 'asc')
    {
        return DB::table($this->table)
        ->select(
            'images.idimages',
            'images.cover',
            'images.description',
            'images.type',
            'images.date',
            'images.idowner',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'images.id')
        ->orderBy('images.idimages', $order)
        ->paginate($limit);
    }
    function scopeGetImagesById($query, $idimages)
    {
        return DB::table($this->table)
        ->select(
            'images.idimages',
            'images.cover',
            'images.description',
            'images.type',
            'images.date',
            'images.idowner',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'images.id')
        ->where('images.idimages', $idimages)
        ->first();
    }
    function scopeGetImagesByIdOwner($query, $idowner, $type)
    {
        return DB::table($this->table)
        ->select(
            'images.idimages',
            'images.cover',
            'images.description',
            'images.type',
            'images.date',
            'images.idowner',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'images.id')
        ->where('images.idowner', $idowner)
        ->where('images.type', $type)
        ->orderBy('images.idimages', 'asc')
        ->get();
    }
}
