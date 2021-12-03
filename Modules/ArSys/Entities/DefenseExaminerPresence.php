<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefenseExaminerPresence extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;
    protected $fillable = ['applicant_id','examiner_id', 'event_id'];
    protected $table = 'arsys_defense_examiner_presence';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'examiner_id', 'id');
    }
    public function applicant(){
        return $this->belongsTo(EventApplicant::class, 'applicant_id', 'id');
    }
}
