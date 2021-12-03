<?php

namespace Modules\ArXiv\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchFileSupervisor extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_research_file_supervisor';

    public function docfile(){
        return $this->belongsTo(ResearchFile::class, 'file_id', 'id');
    }
    protected static function newFactory()
    {
        return \Modules\ArXiv\Database\factories\ResearchFileSupervisorFactory::new();
    }
}
