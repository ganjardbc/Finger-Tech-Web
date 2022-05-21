<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BannerModel extends Model
{
    protected $table = 'banner';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($quer, $data, $idbanner)
    {
        return DB::table($this->table)
        ->where('banner.idbanner', $idbanner)
        ->update($data);
    }

    //delete
    function scopeRemove($quer, $idbanner)
    {
        return DB::table($this->table)
        ->where('banner.idbanner', $idbanner)
        ->delete();
    }

    //read
    function scopeBannerImageById($query, $idbanner)
    {
        return DB::table($this->table)
        ->where('banner.idbanner', $idbanner)
        ->value('banner.cover');
    }
    function scopeAllBanner($query, $limit)
    {
        return DB::table($this->table)
        ->select(
            'banner.idbanner',
            'banner.cover',
            'banner.title',
            'banner.description',
            'banner.link',
            'banner.position',
            'banner.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'banner.id')
        ->orderBy('banner.idbanner', 'desc')
        ->paginate($limit);
    }
    function scopeBannerByIdOnly($query, $idbanner)
    {
        return DB::table($this->table)
        ->select(
            'banner.idbanner',
            'banner.cover',
            'banner.title',
            'banner.description',
            'banner.link',
            'banner.position',
            'banner.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'banner.id')
        ->where('banner.idbanner', $idbanner)
        ->first();
    }
    function scopeBannerById($query, $idbanner)
    {
        return DB::table($this->table)
        ->select(
            'banner.idbanner',
            'banner.cover',
            'banner.title',
            'banner.description',
            'banner.link',
            'banner.position',
            'banner.date',
            'users.id',
            'users.name',
            'users.username'
        )
        ->join('users','users.id', '=', 'banner.id')
        ->where('banner.idbanner', $idbanner)
        ->get();
    }
}
