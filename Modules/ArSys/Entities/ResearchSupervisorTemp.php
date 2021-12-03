<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchSupervisorTemp extends Model
{
    use HasFactory;
    protected $fillable = ['research_id', 'supervisor_id', 'file'];

    protected $table = 'arsys_research_supervisor_temp';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'supervisor_id','id' );
    }

    public function research(){
        return $this->belongsTo(Research::class, 'research_id', 'id');
    }
}
