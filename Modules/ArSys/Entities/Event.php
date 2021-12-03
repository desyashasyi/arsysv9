<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['event_id', 'event_code', 'event_date', 'application_deadline', 'draft_deadline', 'event_type', 'quota', 'current','letter_number'];
    protected $table = 'arsys_event';

    public function applicant(){
        return $this->hasMany(EventApplicant::class, 'event_id','id');
    }

    public function room(){
        return $this->hasMany(SeminarRoom::class, 'event_id','id');
    }


    public function letter(){
        return $this->hasMany(EventLetter::class, 'event_id', 'id');
    }

    public function finaldefenseassignmentletter(){
        return $this->hasMany(EventAssignmentLetter::class, 'event_id', 'id');
    }
    public function type(){
        return $this->belongsTo(EventType::class, 'event_type', 'id');
    }
}
