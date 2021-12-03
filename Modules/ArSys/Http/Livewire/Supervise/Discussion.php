<?php

namespace Modules\ArSys\Http\Livewire\Supervise;

use Livewire\Component;
use Modules\ArSys\Entities\ResearchSupervise;
use Modules\ArSys\Entities\ResearchSuperviseDiscussion;
use Modules\ArSys\Entities\Role;
use Auth;

class Discussion extends Component
{
    public $supervise;
    public $discussionMessage;
    public $discussant;
    public $superviseId;
    public $user;
    protected $listeners = ['superviseDiscussionComponent' => 'superviseDiscussion'];

    public function mount(){
        $this->discussionMessage = null;
        $this->superviseId = null;
        $this->discussant = null;
        $this->superviseId = null;
        $this->user = Auth::user();
    }
    public function render()
    {
        if($this->user->hasRole('student') || $this->user->hasRole('faculty')){
            $this->supervise = ResearchSupervise::where('id', $this->superviseId)->first();
            return view('arsys::livewire.supervise.discussion');
        }else{
            return redirect()->route('arsys');
        }

    }

    public function superviseDiscussion($supervise_id){
        $this->discussionMessage = '';
        $this->superviseId = $supervise_id;
        $this->emit('hideAll');
        $this->emit('superviseDiscussionModal');
    }

    public function discussionStore(){

        $this->validate([
            'discussionMessage' => 'required',
        ]);

        $thread = ResearchSupervise::where('id', $this->superviseId)->first();

        if(Auth::user()->hasRole('faculty')){

            $this->discussant = Auth::user()->faculty->id;
            $discussant_role = Role::where('name', 'faculty')->first()->id;
        }

        if(Auth::user()->hasRole('student')){
            if(Auth::user()->student != null){
                $this->discussant = Auth::user()->student->id;
                $discussant_role = Role::where('name', 'student')->first()->id;
            }
        }

        ResearchSuperviseDiscussion::create([
            'thread_id' => $thread->id,
            'discussant_id' => $this->discussant,
            'discussant_role' => $discussant_role,
            'message' => $this->discussionMessage,
        ]);

        //session()->flash('success', 'discussion has been successfully submitted');
        $this->discussionMessage = '';

    }

    public function deleteDiscussion($id){
        ResearchSuperviseDiscussion::find($id)->delete();
        //session()->flash('success', 'discussion has been successfully deleted');
    }

}

