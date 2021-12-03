<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefenseRole extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_defense_role';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\DefenseRoleFactory::new();
    }
}
