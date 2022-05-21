<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GaleryModel extends Model
{
    protected $table = 'galery';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($quer, $data, $idgalery)
    {
        return DB::table($this->table)
        ->where('galery.idgalery', $idgalery)
        ->update($data);
    }

    //delete
    function scopeRemove($quer, $idgalery)
    {
        return DB::table($this->table)
        ->where('galery.idgalery', $idgalery)
        ->delete();
    }

    //read
    function scopeGetGaleryRecentId($query)
    {
        return DB::table($this->table)
        ->orderBy('galery.idgalery', 'desc')
        ->limit(1)
        ->value('galery.idgalery');
    }
    function scopeGaleryImageById($query, $idgalery)
    {
        return DB::table($this->table)
        ->where('galery.idgalery', $idgalery)
        ->value('galery.cover');
    }
    function scopeDetailGalery($query, $idgalery)
    {
        return DB::table($this->table)
        ->select(
            'galery.idgalery',
            'galery.cover',
            'galery.title',
            'galery.description',
            'galery.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->where('galery.idgalery', $idgalery)
        ->join('users','users.id', '=', 'galery.id')
        ->get();
    }
    function scopeAllGalery($query, $limit, $order = 'asc')
    {
        return DB::table($this->table)
        ->select(
            'galery.idgalery',
            'galery.cover',
            'galery.title',
            'galery.description',
            'galery.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'galery.id')
        ->orderBy('galery.idgalery', $order)
        ->paginate($limit);
    }
    function scopeSearchGalery($query, $ctr, $limit, $order = 'asc')
    {
        $searchValues = preg_split('/\s+/', $ctr, -1, PREG_SPLIT_NO_EMPTY);
        return DB::table($this->table)
        ->select(
            'galery.idgalery',
            'galery.cover',
            'galery.title',
            'galery.description',
            'galery.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'galery.id')
        ->where('galery.description','like',"%$ctr%")
        ->orWhere(function ($q) use ($searchValues)
        {
            foreach ($searchValues as $value) {
                $q->orWhere('galery.description','like',"%$value%");
            }
        })
        ->orderBy('galery.idgalery', $order)
        ->paginate($limit);
    }
    function scopeGaleryByIdOnly($query, $idgalery)
    {
        return DB::table($this->table)
        ->select(
            'galery.idgalery',
            'galery.cover',
            'galery.title',
            'galery.description',
            'galery.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'galery.id')
        ->where('galery.idgalery', $idgalery)
        ->first();
    }
    function scopeGaleryById($query, $idgalery)
    {
        return DB::table($this->table)
        ->select(
            'galery.idgalery',
            'galery.cover',
            'galery.title',
            'galery.description',
            'galery.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'galery.id')
        ->where('galery.idgalery', $idgalery)
        ->get();
    }
}
