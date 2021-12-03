<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefenseModel extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_defense_model';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\DefenseModelFactory::new();
    }
}
