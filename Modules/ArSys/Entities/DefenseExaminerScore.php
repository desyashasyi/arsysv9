<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefenseExaminerScore extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;
    protected $fillable = ['applicant_id','examiner_id', 'event_id', 'defense_note', 'mark'];
    protected $table = 'arsys_defense_examiner_score';

    public function applicant(){
        return $this->belongsTo(EventApplicant::class, 'applicant_id', 'id');
    }
}
