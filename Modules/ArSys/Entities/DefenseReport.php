<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefenseReport extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;
    protected $fillable = ['applicant_id','event_id', 'defense_resume', 'defense_date'];
    protected $table = 'arsys_defense_report';

    public function applicant(){
        return $this->belongsTo(EventApplicant::class, 'applicant_id', 'id');
    }
}
