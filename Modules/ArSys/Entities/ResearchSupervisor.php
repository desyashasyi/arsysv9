<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSupervisor extends Model
{
    use HasFactory;
    protected $fillable = ['research_id', 'supervisor_id', 'role', 'bypass'];

    protected $table = 'arsys_research_supervisor';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'supervisor_id','id' );
    }

    public function supervisorscore(){
        return $this->hasMany(ResearchSupervisorScore::class, 'supervisor_id','id' );
    }
    public function research(){
        return $this->belongsTo(Research::class, 'research_id', 'id');
    }
}
