<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventAssignmentLetter extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'program_id', 'filename'];
    protected $table = 'arsys_event_assignment_letter';

    public function program() {
        return $this->hasOne(StudyProgram::class, 'id', 'program_id');
    }
    public function event(){
        return $this->belongsTo(Event::class, 'event_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\EventAssignmentLetterFactory::new();
    }
}
