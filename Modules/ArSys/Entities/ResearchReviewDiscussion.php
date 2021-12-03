<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchReviewDiscussion extends Model
{
    protected $table = 'arsys_research_review_discussion';
    protected $fillable = ['research_id', 'discussant_id', 'discussant_type', 'message'];
    public function faculty(){
        return $this->belongsTo(Faculty::class, 'discussant_id','id' );
    }

    public function student(){
        return $this->belongsTo(Student::class, 'discussant_id','id' );
    }
    use HasFactory;
}
