<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'roles';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\RoleFactory::new();
    }
}
