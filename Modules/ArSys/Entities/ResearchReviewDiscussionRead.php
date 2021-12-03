<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchReviewDiscussionRead extends Model
{
    use HasFactory;

    protected $fillable = ['research_id', 'reader_id', 'status'];
    protected $table = 'arsys_research_review_discussion_read';


    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchReviewDiscussionReadFactory::new();
    }
}
