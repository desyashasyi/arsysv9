<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalReviewer extends Model
{
    use HasFactory;
    protected $fillable = ['research_id', 'reviewer', 'comment'];
    protected $table = 'arsys_proposal_reviewer';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'reviewer_id','id' );
    }
    public function decision(){
        return $this->belongsTo(ResearchDecisionType::class, 'decision_id','id' );
    }
}
