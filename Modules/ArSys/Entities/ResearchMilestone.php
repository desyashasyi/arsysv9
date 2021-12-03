<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchMilestone extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $table = 'arsys_research_milestone';
}
