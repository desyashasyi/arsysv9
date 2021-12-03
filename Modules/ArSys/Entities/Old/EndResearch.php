<?php

namespace Modules\ArSys\Entities\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndResearch extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'endproject_research';
    use HasFactory;

    public function supervisor(){
        return $this->hasMany(EndSupervisor::class, 'research_id', 'research_id');
    }
    public function applicant(){
        return $this->hasMany(EndApplicant::class, 'research_id', 'research_id');
    }
    public function participant(){
        return $this->hasMany(EndParticipants::class, 'research_id', 'research_id');
    }
    public function student() {
        return $this->belongsTo(Student::class, 'username', 'username');
    }

}
