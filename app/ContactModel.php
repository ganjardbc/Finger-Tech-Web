<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContactModel extends Model
{
    protected $table = 'contact';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($quer, $data, $idcontact)
    {
        return DB::table($this->table)
        ->where('idcontact', $idcontact)
        ->update($data);
    }

    //delete
    function scopeRemove($quer, $idcontact)
    {
        return DB::table($this->table)
        ->where('idcontact', $idcontact)
        ->delete();
    }

    //read
    function scopeContactImageById($query, $idcontact)
    {
        return DB::table($this->table)
        ->where('idcontact', $idcontact)
        ->value('photo');
    }
    function scopeAllContact($query, $limit, $order = 'asc')
    {
        return DB::table($this->table)
        ->select(
            'contact.idcontact',
            'contact.service',
            'contact.name',
            'contact.email',
            'contact.phone',
            'contact.budget',
            'contact.message',
            'contact.status',
            'contact.date',
        )
        ->orderBy('contact.idcontact', $order)
        ->paginate($limit);
    }
    function scopeSearchContact($query, $ctr, $limit, $order = 'asc')
    {
        $searchValues = preg_split('/\s+/', $ctr, -1, PREG_SPLIT_NO_EMPTY);
        return DB::table($this->table)
        ->select(
            'contact.idcontact',
            'contact.service',
            'contact.name',
            'contact.email',
            'contact.phone',
            'contact.budget',
            'contact.message',
            'contact.status',
            'contact.date',
        )
        ->where('contact.response','like',"%$ctr%")
        ->orWhere(function ($q) use ($searchValues)
        {
            foreach ($searchValues as $value) {
                $q->orWhere('contact.response','like',"%$value%");
            }
        })
        ->orderBy('contact.idcontact', $order)
        ->paginate($limit);
    }
    function scopeContactById($query, $idcontact)
    {
        return DB::table($this->table)
        ->select(
            'contact.idcontact',
            'contact.service',
            'contact.name',
            'contact.email',
            'contact.phone',
            'contact.budget',
            'contact.message',
            'contact.status',
            'contact.date',
        )
        ->where('contact.idcontact', $idcontact)
        ->first();
    }
}
