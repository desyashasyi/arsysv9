<?php

namespace Modules\Timetable\Http\Livewire\Presence;

use Livewire\Component;

use Modules\Timetable\Entities\Lectures;
use Auth;

class AddLecture extends Component
{

    public $subject_code;
    public $subject_name;
    public $class;
    public $university;

    public $listeners = ['addLectureComponent' => 'addLecture'];

    public function mount(){
        $this->subject_code = '';
        $this->subject_name = '';
        $this->class = '';
        $this->university = 'UPI';
    }
    public function render()
    {
        return view('timetable::livewire.presence.add-lecture');
    }

    public function addLecture(){
        $this->subject_code = '';
        $this->subject_name = '';
        $this->class = '';
        $this->university = 'UPI';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('hideAll');
        $this->emit('addLectureModal');
    }

    public function submitLecture(){

        $this->validate([
            'subject_code' => 'required',
            'subject_name' => 'required',
            'class' => 'required',
            'university' => 'required',
        ]);


        $lecturesCheck = Lectures::where('creator_id', Auth::user()->faculty->id)
            ->where('subject_code', $this->subject_code)->first();


        if($lecturesCheck === null){
            Lectures::create([
                'subject_code' => $this->subject_code,
                'subject_name' => $this->subject_name,
                'class' => $this->class,
                'university' => $this->university,
                'creator_id' => Auth::user()->faculty->id,
            ]);
        }
        $this->emit('hideAddLectureModal');
        $this->emit('successMessage', 'The lecture data has been submitted');
        $this->emit('refreshPresenceHomeComponent');
    }
}
