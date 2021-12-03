<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchFile extends Model
{
    use HasFactory;
    protected $fillable = ['research_id', 'file_type', 'filename'];
    protected $table = 'arsys_research_file';

    public function documenttype(){
        return $this->hasOne(ResearchFileType::class, 'file_type', 'id');
    }
}
