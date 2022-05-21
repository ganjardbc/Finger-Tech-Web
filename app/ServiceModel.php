<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceModel extends Model
{
    protected $table = 'service';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($query, $data, $idservice)
    {
        return DB::table($this->table)
        ->where('idservice', $idservice)
        ->update($data);
    }

    //delete
    function scopeRemove($query, $idservice)
    {
        return DB::table($this->table)
        ->where('idservice', $idservice)
        ->delete();
    }

    //get
    function scopeGetIdService($query, $title)
    {
        return DB::table($this->table)
        ->where('title', $title)
        ->value('idservice');
    }
    function scopeServiceByIdOnly($query, $idservice)
    {
        return DB::table($this->table)
        ->select(
            'idservice',
            'cover',
            'icon',
            'title',
            'description',
            'link',
            'date'
        )
        ->where('idservice', $idservice)
        ->first();
    }
    function scopeServiceById($query, $idservice)
    {
        return DB::table($this->table)
        ->select(
            'idservice',
            'cover',
            'icon',
            'title',
            'description',
            'link',
            'date'
        )
        ->where('idservice', $idservice)
        ->get();
    }
    function scopeAll($query)
    {
        return DB::table($this->table)
        ->select(
            'idservice',
            'cover',
            'icon',
            'title',
            'description',
            'link',
            'date'
        )
        ->orderBy('idservice', 'asc')
        ->get();
    }
    function scopeAllService($query, $limit)
    {
        return DB::table($this->table)
        ->select(
            'idservice',
            'cover',
            'icon',
            'title',
            'description',
            'link',
            'date'
        )
        ->orderBy('idservice', 'asc')
        ->paginate($limit);
    }
}
