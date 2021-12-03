<?php

namespace Modules\CollabRe\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollabreTodoList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'collabre_id','creator_id', 'creator_role', 'description','archived'];
    protected $table = 'collabre_todo_list';

    public function todo(){
        return $this->hasMany(CollabreTodo::class, 'list_id', 'id');
    }
    public function completetodo(){
        return $this->hasMany(CollabreTodo::class, 'list_id', 'id')->where('completed','=', 1);
    }

    public function collabre(){
        return $this->belongsTo(Collabre::class, 'collabre_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\CollabRe\Database\factories\CollabreTodoListFactory::new();
    }
}
