<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    protected $table = 'users';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($quer, $data, $id)
    {
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }

    //delete
    function scopeRemove($quer, $id)
    {
        return DB::table($this->table)
        ->where('id', $id)
        ->delete();
    }

    //read
    function scopeUserPhotoById($query, $id)
    {
        return DB::table($this->table)
        ->where('id', $id)
        ->value('photo');
    }
    function scopeCheckPassword($query, $password, $id)
    {
        return DB::table($this->table)
        ->where('password', $password)
        ->where('id', $id)
        ->value('id');
    }
    function scopeAllUser($query, $limit, $order = 'asc')
    {
        return DB::table($this->table)
        ->select(
            'id',
            'email',
            'name',
            'username',
            'photo',
            'created_at'
        )
        ->orderBy('id', $order)
        ->paginate($limit);
    }
    function scopeUserById($query, $id)
    {
        return DB::table($this->table)
        ->select(
            'id',
            'email',
            'name',
            'username',
            'photo',
            'created_at'
        )
        ->where('id', $id)
        ->get();
    }
}
