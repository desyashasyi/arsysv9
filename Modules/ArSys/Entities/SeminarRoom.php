<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarRoom extends Model
{
    use HasFactory;

    protected $fillable = ['room_code', 'event_id', 'space_id', 'session_id', 'moderator_id'];

    protected $table = 'arsys_seminar_room';

    public function space(){
        return $this->belongsTo(EventSpace::class,  'space_id','id'  );
    }
    public function session(){
        return $this->belongsTo(EventSession::class,  'session_id','id');
    }
    public function moderator(){
        return $this->hasMany(SeminarModerator::class, 'room_id', 'id');
    }

    public function event(){
        return $this->belongsTo(Event::class, 'event_id','id');
    }

    public function applicant(){
        return $this->hasMany(EventApplicant::class, 'room_id','id');
    }
    public function examiner(){
        return $this->hasMany(SeminarExaminer::class, 'room_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\SeminarRoomFactory::new();
    }
}
