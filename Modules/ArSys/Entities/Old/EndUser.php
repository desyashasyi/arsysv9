<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EndUser extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'users';


    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\Old/OldUserFactory::new();
    }
}
