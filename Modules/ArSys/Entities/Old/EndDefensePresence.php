<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EndDefensePresence extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'endproject_defense_presence';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\Old/EndDefensePresenceFactory::new();
    }
}
