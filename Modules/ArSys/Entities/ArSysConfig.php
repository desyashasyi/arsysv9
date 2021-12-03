<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArSysConfig extends Model
{
    use HasFactory;

    protected $fillable = ['status'];
    protected $table = 'arsys_config';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ArSysConfigFactory::new();
    }
}
