<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchApproval extends Model
{
    use HasFactory;

    protected $fillable = ['research_id','approver','approval_type','research_role'];
    protected $table = 'arsys_research_approval';

    public function approvalType(){
        return $this->belongsTo(ResearchApprovalType::class, 'approval_type', 'id');
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'approver_id','id' );
    }
}
