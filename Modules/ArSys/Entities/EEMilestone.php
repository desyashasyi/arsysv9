<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EEMilestone extends Model
{
    protected $fillable = [];
    protected $table = 'arsys_seminar_milestone';

    protected static function newFactory()
    {
        return \Modules\NeoArSys\Database\factories\EEMilestoneFactory::new();
    }
    use HasFactory;
}
