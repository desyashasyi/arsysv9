<?php

namespace Modules\ArXiv\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchSupervisor extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_research_supervisor';

    public function research(){
        return $this->belongsTo(Research::class, 'research_id', 'id');
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'supervisor_id','id' );
    }
    
    protected static function newFactory()
    {
        return \Modules\ArXiv\Database\factories\ResearchSupervisorFactory::new();
    }
}
