<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EndApplicant extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'endproject_reserved_schedule';

    public function examiner(){
        return $this->hasMany(EndExaminer::class, 'research_id', 'research_id');
    }
    public function schedule(){
        return $this->belongsTo(EndSchedule::class, 'schedule_id', 'schedule_id');
    }
    public function report(){
        return $this->hasOne(EndDefenseReport::class, 'research_id', 'research_id');
    }

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\Old/EndApplicantFactory::new();
    }
}
