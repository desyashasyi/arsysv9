<?php

namespace Modules\Office\Entities;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\ArSys\Entities\Old\EndResearch;

class Research extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $guarded = [];
    protected $fillable = [];

    use HasFactory;
    protected $table = 'arsys_research';

    public function milestone(){
        return $this->hasOne(ResearchMilestone::class, 'sequence', 'research_milestone')->where('milestone_model', 'defense');
    }


    public function milestoneseminar(){
        return $this->hasOne(ResearchMilestoneSeminar::class, 'sequence', 'research_milestone')->where('milestone_model', 'seminar');
    }

    public function supervise(){
        return $this->hasMany(ResearchSupervise::class, 'research_id', 'id');
    }

    public function letter(){
        return $this->hasMany(ResearchLetter::class, 'research_id', 'id');
    }

    public function proposalFile(){
        return $this->hasMany(ResearchFile::class, 'research_id', 'id')->where('file_type', 1);
    }

    public function proposalReview(){
        return $this->hasMany(ResearchReviewApproval::class, 'research_id', 'id');
    }


    public function supervisor(){
        return $this->hasMany(ResearchSupervisor::class, 'research_id', 'id');
    }

    public function supervisorexternal(){
        return $this->hasOne(ResearchSupervisorExternal::class, 'research_id', 'id');
    }

    public function supervisordummy(){
        return $this->hasMany(ResearchSupervisorDummy::class, 'research_id', 'id');
    }

    public function supervisorexternaldummy(){
        return $this->hasOne(ResearchSupervisorExternalDummy::class, 'research_id', 'id');
    }

    public function supervisortemp(){
        return $this->hasMany(ResearchSupervisorTemp::class, 'research_id', 'id');
    }
    public function type(){
        return $this->belongsTo(ResearchType::class,  'research_type', 'id');
    }

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function defenseApproval(){
        return $this->hasMany(DefenseApproval::class, 'research_id', 'id');
    }

    public function approvalRequest(){
        return $this->hasMany(DefenseApproval::class, 'research_id', 'id')->where('decision', null);
    }

    public function applicant(){
        return $this->hasMany(EventApplicant::class, 'research_id', 'id');
    }

    public function file(){
        return $this->hasOne(ResearchFile::class, 'research_id', 'id');
    }
    public function todo(){
        return $this->hasMany(Todo::class, 'research_id', 'id')->where('completed','=', 0);;
    }

    public function completedtodo(){
        return $this->hasMany(Todo::class, 'research_id', 'id')->where('completed','=', 1);
    }

    public function thesisdoc(){
        return $this->hasOne(ResearchFile::class, 'research_id', 'id')->where('file_type', ResearchFileType::where('code', 'THESIS')->first()->id);
    }

    public function draftthesisdoc(){
        return $this->hasOne(ResearchFile::class, 'research_id', 'id')->where('file_type', ResearchFileType::where('code', 'DRAFTTHESIS')->first()->id);
    }

    public function spvdoc(){
        return $this->hasOne(ResearchFile::class, 'research_id', 'id')->where('file_type', ResearchFileType::where('code', 'SPV')->first()->id);
    }

    public function cospvdoc(){
        return $this->hasOne(ResearchFile::class, 'research_id', 'id')->where('file_type', ResearchFileType::where('code', 'COSPV')->first()->id);
    }

    public function pdfartdoc(){
        return $this->hasOne(ResearchFile::class, 'research_id', 'id')->where('file_type', ResearchFileType::where('code', 'PDFART')->first()->id);
    }

    public function docxartdoc(){
        return $this->hasOne(ResearchFile::class, 'research_id', 'id')->where('file_type', ResearchFileType::where('code', 'DOCXART')->first()->id);
    }

    public function pptdoc(){
        return $this->hasOne(ResearchFile::class, 'research_id', 'id')->where('file_type', ResearchFileType::where('code', 'PPTART')->first()->id);
    }

    public function endprojectresearch(){
        return $this->hasMany(EndResearch::class, 'username', 'username');
    }

    public function reviewDiscussion(){
        return $this->hasMany(ResearchReviewDiscussion::class, 'research_id', 'id');
    }

    public function reviewDiscussionRead(){
        return $this->hasMany(ResearchReviewDiscussionRead::class, 'research_id', 'id');
    }

}
