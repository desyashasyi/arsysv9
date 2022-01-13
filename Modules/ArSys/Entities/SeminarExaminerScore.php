<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarExaminerScore extends Model
{
    use HasFactory;

    protected $fillable = ['examiner_id', 'event_id', 'applicant_id', 'mark', 'seminar_note'];

    protected $table = 'arsys_seminar_examiner_score';

    

    public function applicant(){
        return $this->belongsTo(EventApplicant::class, 'applicant_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\SeminarScoreFactory::new();
    }
}
