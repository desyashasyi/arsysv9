<?php

namespace Modules\CollabRe\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class CollabreTodo extends Model
{
    use HasFactory;
    use HasTrixRichText;

    protected $fillable = ['list_id', 'title', 'duedate', 'enddate', 'creator_id', 'creator_type', 'notes', 'completed'];
    protected $table = 'collabre_todo';
    

    protected $guarded = [];

    public function list(){
        return $this->belongsTo(CollabreTodoList::class, 'list_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\CollabRe\Database\factories\CollabreTodoFactory::new();
    }
}
