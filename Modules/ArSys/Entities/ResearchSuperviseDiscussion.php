<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSuperviseDiscussion extends Model
{
    use HasFactory;

    protected $fillable = ['thread_id','discussant_id','discussant_role','message'];
    protected $table = 'arsys_research_supervise_discussion';

    public function supervise(){
        return $this->belongsTo(ResearchSupervise::class, 'thread_id','id' );
    }


    public function student(){
        return $this->belongsTo(Student::class, 'discussant_id', 'id');
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'discussant_id', 'id');
    }
}
