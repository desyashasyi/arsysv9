<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndSupervisor extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'endproject_research_supervisor';
    use HasFactory;
}
