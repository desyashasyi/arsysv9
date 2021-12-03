<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Faculty extends Model
{

    use HasFactory;

    protected $fillable = ['user_id', 'code', 'upi_code', 'nip',
                            'front_title', 'rear_title',
                            'first_name', 'last_name',
                            'specialization_id', 'duty_id','homebase_id', 'sso_username' ];
    protected $table = 'arsys_faculty';

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id' );
    }


    public function supervisor(){
        return $this->hasMany(ResearchSupervisor::class, 'supervisor_id','id');
    }
    public function proposalReviewer(){
        return $this->hasMany(ProposalReviewer::class, 'id','reviewer');
    }
    public function eventExaminer($eventId){
        return $this->hasMany(DefenseExaminer::class, 'examiner_id', 'id')->where('event_id', $eventId)->count();
    }
    public function allEventExaminer(){
        return $this->hasMany(DefenseExaminer::class, 'examiner_id', 'id')->count();
    }

    public function examiner(){
        return $this->hasMany(DefenseExaminer::class, 'examiner_id', 'id');
    }

    public function duty(){
        return $this->hasMany(FacultyDuty::class, 'faculty_id', 'id');
    }

    public function defenseSupervisor(){
        return $this->hasMany(ResearchSupervisor::class, 'supervisor_id', 'id')
            ->whereHas('research', function($query){
                $query->where('research_type', ResearchType::where('code', 'SK')->first()->id)
                    ->orwhere('research_type', ResearchType::where('code', 'TA')->first()->id);
            });
    }
}
