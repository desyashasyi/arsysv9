<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventApplicantPrevious extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_event_applicant';
    public function examiner(){
        return $this->hasMany(DefenseExaminer::class, 'applicant_id','id');
    }
    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\EventApplicantPreviousFactory::new();
    }
}
