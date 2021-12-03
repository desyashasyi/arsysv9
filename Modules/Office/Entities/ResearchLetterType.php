<?php

namespace Modules\Office\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchLetterType extends Model
{
    use HasFactory;

    protected $table = 'arsys_research_letter_type';
    
    protected static function newFactory()
    {
        return \Modules\Office\Database\factories\ResearchLetterTypeFactory::new();
    }
}
