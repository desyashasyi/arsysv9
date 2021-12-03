<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventLetter extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'program_id', 'number', 'type_id', 'date'];
    protected $table = 'arsys_event_letter';

    public function program() {
        return $this->hasOne(StudyProgram::class, 'id', 'program_id');
    }

    public function type() {
        return $this->hasOne(EventLetterType::class, 'id', 'type_id');
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\EventLetterFactory::new();
    }
}
