<?php

namespace Modules\Office\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchLetter extends Model
{
    use HasFactory;

    protected $fillable = ['research_id', 'number', 'date', 'type_id'];
    protected $table = 'arsys_research_letter';
    
    protected static function newFactory()
    {
        return \Modules\Office\Database\factories\ResearchLetterFactory::new();
    }
}
