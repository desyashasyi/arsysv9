<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventApplicantWaiting extends Model
{
    use \Awobaz\Compoships\Compoships;

    use HasFactory;
    protected $table = 'arsys_event_applicant_waiting';
    protected $fillable = ['event_id', 'research_id', 'event_type','space_id', 'session_id', 'hold','room_id'];



    public function event(){
        return $this->belongsTo(Event::class, 'event_id','id');
    }

    public function research(){
        return $this->belongsTo(Research::class,'research_id','id');
    }

    public function supervisor(){
        return $this->hasMany(ResearchSupervisor::class, 'research_id', 'research_id');
    }

    public function examiner(){
        return $this->hasMany(DefenseExaminer::class, 'applicant_id','id');
    }
    public function examinerscore(){
        return $this->hasMany(DefenseExaminerScore::class,  ['applicant_id','id'], ['id','event_id']);
    }

    public function report(){
        return $this->hasMany(DefenseReport::class,  'applicant_id','id');
    }

    public function space(){
        return $this->belongsTo(EventSpace::class,  'space_id','id'  );
    }
    public function session(){
        return $this->belongsTo(EventSession::class,  'session_id','id');
    }

    public function room(){
        return $this->hasMany(SeminarRoom::class, 'event_id', 'event_id');
    }

    public function applicantroom(){
        return $this->belongsTo(SeminarRoom::class, 'room_id', 'id');
    }

    public function previous (){
        return $this->hasOne(EventApplicant::class,'research_id', 'research_id');
                //->where('event_type', EventType::where('abbrev', 'PRE')->first()->id);
    }
    public function fixedapplicant(){
        return $this->hasMany(EventApplicant::class, 'research_id','research_id');
    }
}
