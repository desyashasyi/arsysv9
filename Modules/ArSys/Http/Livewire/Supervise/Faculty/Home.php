<?php

namespace Modules\ArSys\Http\Livewire\Supervise\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\ResearchSupervise;
use Modules\ArSys\Entities\DefenseApproval;
use Modules\ArSys\Entities\ResearchMilestoneStatus;
use Modules\ArSys\Entities\ResearchSuperviseDiscussion;
use Auth;
use Livewire\WithPagination;
use \Carbon\Carbon;

class Home extends Component
{
    public $search;
    public $user;
    public $milestone;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $supervisionTopic;
    public $supervisionMessage;
    public $supervisor;
    public $supervisorId;
    public $superviseId;
    public $superviseDiscussionStatus = false;
    public $clearFieldStatus = false;

    protected $listeners = [
        'refreshResearchIndex' => '$refresh',
    ];

    public function mount(){
        if($this->clearFieldStatus){
            $this->clearFields();
            $this->clearFieldStatus = false;
            $this->milestone = null;
        }
    }
    public function render()
    {
        $user = Auth::user();
        $this->user = $user;
        $students = Student::
                    whereHas('research', function($query){
                        $query
                        ->whereHas('supervisor', function($query){
                            $query->where('supervisor_id', $this->user->faculty->id);

                        })
                        ->whereHas('milestone', function($query){
                            $query->where(['milestone_model' => 'defense', 'status' => 1]);
                        })

                        ->where('username', null);

                    })
                    ->orderBy('first_name', 'ASC')
                    ->paginate(5);


        if ($this->search !== null) {
            $students = Student::
                    whereHas('research', function($query){
                        $query
                        ->whereHas('supervisor', function($query){
                            $query->where('supervisor_id', $this->user->faculty->id);

                        })
                        ->whereHas('milestone', function($query){
                            $query->where(['milestone_model' => 'defense', 'status' => 1]);
                        })

                        ->where('username', null);

                    })
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orderBy('first_name', 'ASC')
                ->paginate(5);
        }

        $thread = ResearchSupervise::where('id', $this->superviseId)->get();
        return view('arsys::livewire.supervise.faculty.home', compact('students', 'thread'));
    }

    public function superviseDiscussion($id){
        $this->clearFields();
        $this->superviseId = $id;
        $this->superviseDiscussionStatus = true;
    }

    public function submitDiscussion(){
        $user = Auth::user();

        $discussant='';
        if($user->sso_username > 8){
            $discussant = $user->faculty->id;
        }else{
            $discussant = $user->student->id;
        }
        $this->validate([
            'supervisionMessage' => 'required',
        ]);

        $thread = ResearchSupervise::where('id', $this->superviseId)->first();

        ResearchSuperviseDiscussion::create([
            'thread_id' => $thread->id,
            'discussant_id' => $discussant,
            'message' => $this->supervisionMessage,
        ]);
    }

    public function deleteDiscussion($id){
        ResearchSuperviseDiscussion::find($id)->delete();
    }

    public function closeModal(){
        $this->clearFields();
        $this->proposeSupervise = false;
        $this->superviseDiscussionStatus = false;
    }

    public function clearFields(){
        $this->resetErrorBag();
        $this->resetValidation();
        $this->supervisionTopic = '';
        $this->supervisionMessage = '';
    }


    public function createThread($id){
        $this->clearFields();
        $supervisor = ResearchSupervisor::where('id', $id)->first();
        $this->supervisorId = $supervisor->id;
        $this->proposeSupervise = true;

    }
    public function submitThread(){
        $this->validate([
            'supervisionTopic' => 'required',
            'supervisionMessage' => 'required',
        ]);

        $supervisor = ResearchSupervisor::where('id', $this->supervisorId)->first();

        //dd($supervisor->research->student_id);
        $supervise = ResearchSupervise::where('supervisor_id', $supervisor->supervisor_id)
            ->where('research_id', $supervisor->research_id)
            ->where('status', null)->count();
        if (!$supervise){
            ResearchSupervise::create([
                'research_id' => $supervisor->research_id,
                'threader_id' => $supervisor->supervisor_id,
                'supervisor_id' => $supervisor->supervisor_id,
                'topic' => $this->supervisionTopic,
                'message' => $this->supervisionMessage,
            ]);
            session()->flash('success', 'Thread has been successfully created');
        }else{
            //$this->emit('show-toast', 'New Post has been successfully created!', 'success');
            //toast('You do not have approval of previous meeting', 'success');
            session()->flash('error', 'You should make approval of previous discussion');
        }
        $this->clearFieldStatus = true;
    }

    public function recordMeeting(){
        $this->submitDiscussion();
        ResearchSupervise::where('id', $this->superviseId)->update(['status' => true]);
    }

    public function approve($id){
        /**
         * Update decision of Research Approval
         */
        DefenseApproval::where('id',$id)->update(['decision' => true, 'approval_date' => Carbon::now()]);

        /**
         * check all research approval has been decided, if so go up to the next milestone
         */
        $approval = DefenseApproval::where('id',$id)->first();
        $approval_count = DefenseApproval::where('research_id', $approval->research_id)->where('decision', null)->get();
        if($approval_count->isEmpty()){
            Research::find($approval->research_id)->increment('research_milestone');
        }
    }

    public function approveSupervise($supervise_id, $decision){

        if($decision == 'Approve'){
            ResearchSupervise::where('id', $supervise_id)->update(['status' => 1,]);
        }

        if($decision == 'Cancel'){
            ResearchSupervise::where('id', $supervise_id)->update(['status' => null,]);
        }
    }

    public function bypassMeeting($supervisor_id){
        if(ResearchSupervisor::where('id',$supervisor_id)->first()->bypass == null){
            ResearchSupervisor::where('id',$supervisor_id)->update(['bypass' => 1,]);
        }else{
            ResearchSupervisor::where('id',$supervisor_id)->update(['bypass' => null,]);
        }

    }
}
