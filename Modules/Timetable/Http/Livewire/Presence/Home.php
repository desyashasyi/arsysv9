<?php

namespace Modules\Timetable\Http\Livewire\Presence;

use Livewire\Component;



use Modules\Timetable\Entities\Lectures;
use Modules\Timetable\Entities\LecturesPresence;
use Modules\Timetable\Entities\LecturesMeeting;
use Modules\Timetable\Entities\LecturesStudent;
use Modules\Timetable\Entities\LecturesTeacher;

use Auth;

class Home extends Component
{

    protected $listeners = ['refreshPresenceHomeComponent' => '$refresh'];

    public $subject_code;
    public $subject_name;
    public $class;
    public $university;
    public $lectureId;

    public function mount(){
        $this->subject_code = '';
        $this->subject_name = '';
        $this->class = '';
        $this->university = 'UPI';
        $this->lectureId = '';
    }
    public function render()
    {
        $lectures = Lectures::where('creator_id', Auth::user()->faculty->id)
            ->orWhereHas('teacher', function ($query){
                $query->where('faculty_id', Auth::user()->faculty->id);
            })
            ->get();

        return view('timetable::livewire.presence.home', compact('lectures'));
    }

    public function presenceRecap($id){
        return redirect()->route('lectures.presence.recap', ['id' => $id]);
    }

    public function edit($id){
        $this->lectureId = $id;
        $lecture = Lectures:: where('id', $this->lectureId)->first();
        $this->subject_code = $lecture->subject_code;
        $this->subject_name = $lecture->subject_name;
        $this->class = $lecture->class;
        $this->university = $lecture->university;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('hideAll');
        $this->emit('editModal');
    }

    public function updateLecture(){
        $this->validate([
            'subject_code' => 'required',
            'subject_name' => 'required',
            'class' => 'required',
            'university' => 'required',
        ]);

        Lectures::where('id',$this->lectureId)->update([
            'subject_code' => $this->subject_code,
            'subject_name' => $this->subject_name,
            'class' => $this->class,
            'university' => $this->university,
            'creator_id' => Auth::user()->faculty->id,
        ]);
    }

    public function delete($id){
        $lecture = Lectures::where('id', $id)->first();
        if($lecture->meeting != null){
            foreach($lecture->meeting as $meeting){
                if($meeting->presence != null){
                    foreach($meeting->presence as $presence){
                        LecturesPresence::where('id', $presence->id)->delete();
                    }
                    LecturesMeeting::where('id', $meeting->id)->delete();
                }
            }
            if($lecture->student != null){
                foreach($lecture->student as $student){
                    LecturesStudent::where('id', $student->id)->delete();
                }
            }
            if($lecture->teacher != null){
                foreach($lecture->teacher as $teacher){
                    LecturesTeacher::where('id', $teacher->id)->delete();
                }
            }
            Lectures::where('id', $id)->delete();
        }
    }

}
