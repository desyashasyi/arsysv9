<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarExaminer extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'examiner_id'];

    protected $table = 'arsys_seminar_examiner';

    public function presence(){
        return $this->hasOne(SeminarExaminerPresence::class, 'examiner_id','id');
    }
    public function score(){
        return $this->hasMany(SeminarExaminerScore::class, 'examiner_id','id');
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'examiner_id', 'id');
    }

    public function room(){
        return $this->belongsTo(SeminarRoom::class, 'room_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\SeminarExaminerFactory::new();
    }
}
