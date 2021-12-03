<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoDiscussionFile extends Model
{
    protected $guarded = [];
    protected $fillable = ['todo_discussion_file', 'todo_discussion_id'];

    use HasFactory;
    protected $table = 'arsys_research_todo_discussion_file';

}
