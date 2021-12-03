<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSupervise extends Model
{
    use HasFactory;
    protected $fillable = ['research_id', 'threader_id', 'threader_role','supervisor_id', 'topic', 'message', 'share'];
    protected $table = 'arsys_research_supervise';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'supervisor_id','id' );
    }

    public function discussion(){
        return $this->hasMany(ResearchSuperviseDiscussion::class, 'thread_id','id' );
    }
}
