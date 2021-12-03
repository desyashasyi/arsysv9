<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoDiscussion extends Model
{
    protected $guarded = [];
    protected $fillable = [];

    use HasFactory;
    protected $table = 'arsys_research_todo_discussion';

    public function student(){
        return $this->hasOne(Student::class, 'id', 'discussant_id');
    }

    public function faculty(){
        return $this->hasOne(Faculty::class, 'id', 'discussant_id');
    }

    public function url(){
        return $this->hasOne(TodoDiscussionUrl::class, 'todo_discussion_id','id' );
    }
    public function file(){
        return $this->hasOne(TodoDiscussionFile::class, 'todo_discussion_id','id' );
    }
}
