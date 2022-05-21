<?php

namespace Adventrest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NoteModel extends Model
{
    protected $table = 'note';

    //create
    function scopeInsert($quer, $data)
    {
        return DB::table($this->table)
        ->insert($data);
    }

    //update
    function scopeEdit($query, $data, $idnote)
    {
        return DB::table($this->table)
        ->where('idnote', $idnote)
        ->update($data);
    }

    //delete
    function scopeRemove($query, $idnote)
    {
        return DB::table($this->table)
        ->where('idnote', $idnote)
        ->delete();
    }

    //get
    function scopeNoteById($query, $idnote)
    {
        return DB::table($this->table)
        ->select(
            'idnote',
            'cover',
            'icon',
            'title',
            'description',
            'link',
            'date'
        )
        ->where('idnote', $idnote)
        ->get();
    }
    function scopeAllNote($query, $limit)
    {
        return DB::table($this->table)
        ->select(
            'idnote',
            'cover',
            'icon',
            'title',
            'description',
            'link',
            'date'
        )
        ->orderBy('idnote', 'asc')
        ->paginate($limit);
    }
}
