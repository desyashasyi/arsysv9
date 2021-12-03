<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarExaminerPresence extends Model
{
    use HasFactory;


    protected $fillable = ['room_id','examiner_id', 'event_id'];
    protected $table = 'arsys_seminar_examiner_presence';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'examiner_id', 'id');
    }
    public function applicant(){
        return $this->belongsTo(EventApplicant::class, 'applicant_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\SeminarPresenceFactory::new();
    }
}
