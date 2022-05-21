<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestimonyModel extends Model
{
    protected $table = 'testimony';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($quer, $data, $idtestimony)
    {
        return DB::table($this->table)
        ->where('idtestimony', $idtestimony)
        ->update($data);
    }

    //delete
    function scopeRemove($quer, $idtestimony)
    {
        return DB::table($this->table)
        ->where('idtestimony', $idtestimony)
        ->delete();
    }

    //read
    function scopeTestimonyImageById($query, $idtestimony)
    {
        return DB::table($this->table)
        ->where('idtestimony', $idtestimony)
        ->value('photo');
    }
    function scopeAllTestimony($query, $limit, $order = 'asc')
    {
        return DB::table($this->table)
        ->select(
            'testimony.idtestimony',
            'testimony.response',
            'testimony.name',
            'testimony.job',
            'testimony.photo',
            'testimony.date',
            'users.id',
            'users.name as name_admin',
            'users.username'
        )
        ->join('users','users.id', '=', 'testimony.id')
        ->orderBy('testimony.idtestimony', $order)
        ->paginate($limit);
    }
    function scopeSearchTestimony($query, $ctr, $limit, $order = 'asc')
    {
        $searchValues = preg_split('/\s+/', $ctr, -1, PREG_SPLIT_NO_EMPTY);
        return DB::table($this->table)
        ->select(
            'testimony.idtestimony',
            'testimony.response',
            'testimony.name',
            'testimony.job',
            'testimony.photo',
            'testimony.date',
            'users.id',
            'users.name as name_admin',
            'users.username'
        )
        ->join('users','users.id', '=', 'testimony.id')
        ->where('testimony.response','like',"%$ctr%")
        ->orWhere(function ($q) use ($searchValues)
        {
            foreach ($searchValues as $value) {
                $q->orWhere('testimony.response','like',"%$value%");
            }
        })
        ->orderBy('testimony.idtestimony', $order)
        ->paginate($limit);
    }
    function scopeTestimonyById($query, $idtestimony)
    {
        return DB::table($this->table)
        ->select(
            'testimony.idtestimony',
            'testimony.response',
            'testimony.name',
            'testimony.job',
            'testimony.photo',
            'testimony.date',
            'users.id',
            'users.name as name_admin',
            'users.username'
        )
        ->join('users','users.id', '=', 'testimony.id')
        ->where('testimony.idtestimony', $idtestimony)
        ->get();
    }
}
