<?php

namespace Modules\ArSys\Http\Livewire\Utilities\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\ResearchType;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseExaminer;
use Modules\ArSys\Entities\DefenseExaminerPresence;
use Modules\ArSys\Entities\ResearchMilestone;
use Modules\ArSys\Entities\Research;
use \Carbon\Carbon;
use Auth;

class SetDefensePresence extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $user = Auth::user();

        $students = Student::whereHas('research', function($query){
            $query->where('research_type', '!=', ResearchType::where('code', 'PI')->first()->id)
                ->where('research_milestone',8);
            })
            ->orderBy('first_name', 'ASC')
            ->paginate(10);

        if ($this->search !== null) {
            $students = Student::whereHas('research', function($query){
                $query->where('research_type', '!=', ResearchType::where('code', 'PI')->first()->id)
                    ->where('research_milestone','>=', 8);
                })
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orderBy('first_name', 'ASC')
                ->paginate(10);
        }


        return view('arsys::livewire.utilities.admin.set-defense-presence', compact('students'));
    }

    public function setPresence($id){
        $examiner = DefenseExaminer::where('id', $id)->first();
        $applicant = EventApplicant::where('id', $examiner->applicant_id)->first();
        $presence = DefenseExaminerPresence::where('applicant_id', $examiner->applicant_id)
            ->where('event_id', $examiner->event_id)
            ->where('examiner_id', $examiner->id)->first();

        if($presence == null){
            if(DefenseExaminerPresence::where('applicant_id', $examiner->applicant_id)
            ->where('event_id', $examiner->event_id)->count() < 3){
                DefenseExaminerPresence::create([
                    'applicant_id' => $examiner->applicant_id,
                    'event_id' => $examiner->event_id,
                    'examiner_id' => $examiner->id,
                ]);
                //$this->emit('successMessage', 'The examiner presence has been submitted' );
            }

        }else{
            $this->emit('removeExaminerPresence', $presence->id);
        }
    }

    public function upMilestone($research_id){
        Research::find($research_id)->increment('research_milestone');
    }

    public function removePresence($presence_id){
        DefenseExaminerPresence::find($presence_id)->delete();
    }
}
