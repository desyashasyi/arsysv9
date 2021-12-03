<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoDiscussionUrl extends Model
{
    protected $guarded = [];
    protected $fillable = [];

    use HasFactory;
    protected $table = 'arsys_research_todo_discussion_url';
}
