<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndFaculty extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'timetable_faculty';

    public function userdata(){
        return $this->belongsTo(EndUser::class, 'username','name' );
    }
    use HasFactory;
}
