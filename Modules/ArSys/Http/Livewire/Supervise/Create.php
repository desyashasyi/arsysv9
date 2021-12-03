<?php

namespace Modules\ArSys\Http\Livewire\Supervise;

use Livewire\Component;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\ResearchSupervise;
use Modules\ArSys\Entities\Role;



use Auth;
class Create extends Component
{

    public $supervisionTopic;
    public $shareDiscussion;
    public $supervisionMessage;
    public $supervisor;
    public $supervisorId;
    public $superviseId;
    public $user;

    protected $listeners = ['researchCreateSuperviseComponent' => 'researchSupervise'];
    public function render()
    {

        $this->user = Auth::user();
        if ($this->user){
            return view('arsys::livewire.supervise.create');
        }else{
            return redirect()->route('arsys.swicth');
        }

    }

    public function researchSupervise($supervisor_id){
        $this->supervisorId = $supervisor_id;
        $supervisor = ResearchSupervisor::where('id', $supervisor_id)->first();
        $this->supervisor = $supervisor->faculty->first_name.' '. $supervisor->faculty->last_name;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->supervisionTopic = null;
        $this->supervisionMessage = null;
        $this->emit('hideAll');
        $this->emit('researchCreateSuperviseModal');
    }

    public function superviseStore(){
        $this->validate([
            'supervisionTopic' => 'required',
            'supervisionMessage' => 'required',
        ]);

        $supervisor = ResearchSupervisor::where('id', $this->supervisorId)->first();

        //dd($supervisor->research->student_id);
        $shareDiscussion = false;
        $supervise = null;
        $threaderId = null;
        if($this->user->hasRole('faculty')){
            $shareDiscussion = $this->shareDiscussion;
            $threaderId = $supervisor->supervisor_id;
            $threader_role = Role::where('name', 'faculty')->first()->id;
        }else{
            $supervise = ResearchSupervise::where('supervisor_id', $supervisor->supervisor_id)
                ->where('research_id', $supervisor->research_id)
                ->where('status', null)
                ->where('threader_role',Role::where('name', 'student')->first()->id)
                ->count();
                $threaderId = $supervisor->research->student_id;
                $threader_role = Role::where('name', 'student')->first()->id;
        }

        if (!$supervise){
            ResearchSupervise::create([
                'research_id' => $supervisor->research_id,
                'threader_id' => $threaderId,
                'supervisor_id' => $supervisor->supervisor_id,
                'threader_role' => $threader_role,
                'topic' => $this->supervisionTopic,
                'message' => $this->supervisionMessage,
                'share' => $shareDiscussion,
            ]);
            session()->flash('success', 'Supervision proposal has been successfully created');
        }else{
            if($supervisor->bypass === 1){
                ResearchSupervise::create([
                    'research_id' => $supervisor->research_id,
                    'threader_id' => $threaderId,
                    'supervisor_id' => $supervisor->supervisor_id,
                    'threader_role' => $threader_role,
                    'topic' => $this->supervisionTopic,
                    'message' => $this->supervisionMessage,
                    'share' => $shareDiscussion,
                ]);
                session()->flash('success', 'Supervision proposal has been successfully created');
            }else{
                //$this->emit('show-toast', 'New Post has been successfully created!', 'success');
                //toast('You do not have approval of previous meeting', 'success');
                session()->flash('error', 'You should have approval of previous meeting');

            }
        }

        $this->emit('refreshResearchIndex');
    }


}
