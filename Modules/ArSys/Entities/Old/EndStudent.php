<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndStudent extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'endproject_student';
    use HasFactory;
}
