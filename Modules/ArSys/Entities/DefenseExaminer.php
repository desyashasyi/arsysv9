<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefenseExaminer extends Model
{
    use HasFactory;

    use \Awobaz\Compoships\Compoships;

    protected $fillable = ['applicant_id','examiner_id', 'event_id', 'addition'];
    protected $table = 'arsys_defense_examiner';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'examiner_id', 'id');
    }

    public function presence(){
        return $this->hasOne(DefenseExaminerPresence::class, 'examiner_id','id');
    }
    public function examinerscore(){
        return $this->hasOne(DefenseExaminerScore::class, 'examiner_id','id');
    }

    public function applicant(){
        return $this->belongsTo(EventApplicant::class, 'applicant_id', 'id');
    }
}
