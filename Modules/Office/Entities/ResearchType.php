<?php

namespace Modules\Office\Entities;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchType extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $table = 'arsys_research_type';
}

