<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EndDefenseReport extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'endproject_seminar';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\Old/EndDefenseReportFactory::new();
    }
}
