<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefenseScoreGuide extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_defense_score_guide';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\DefenseScoreGuideFactory::new();
    }
}
