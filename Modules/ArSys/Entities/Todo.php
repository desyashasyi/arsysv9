<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = [];
    protected $fillable = ['todo_title', 'research_id', 'todo_description', 'creator_id', 'creator_type', 'todo_duedate', 'todo_url', 'todo_file'];

    use HasFactory;
    protected $table = 'arsys_research_todo';

    public function discussion(){
        return $this->hasMany(TodoDiscussion::class, 'todo_id','id' );
    }

    public function student(){
        return $this->hasOne(Student::class, 'id', 'creator_id');
    }

    public function faculty(){
        return $this->hasOne(Faculty::class, 'id', 'creator_id');
    }
}
