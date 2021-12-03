<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchReview extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['research_id', 'reviewer_id', 'comment', 'decision_id', 'decisio_date'];
    protected $table = 'arsys_research_review';


    public function faculty(){
        return $this->belongsTo(Faculty::class, 'reviewer_id','id' );
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchReviewFactory::new();
    }
}
