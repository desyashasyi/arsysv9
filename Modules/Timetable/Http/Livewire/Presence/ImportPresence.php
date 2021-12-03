<?php

namespace Modules\Timetable\Http\Livewire\Presence;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Modules\Timetable\Entities\Lectures;
use Modules\Timetable\Entities\LecturesStudent;
use Modules\Timetable\Entities\LecturesMeeting;
use Modules\Timetable\Entities\LecturesPresence;
use \Carbon\Carbon;

class ImportPresence extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $filePresence;
    public $meeting_date;
    public $lectureId;
    public $date;
    public $meetingId;
    public $listeners = ['importPresenceComponent' => 'importPresence'];

    public function mount(){
        $this->filePresence = '';
        $this->lectureId = '';
        $this->date = '';
        $this->meetingId = '';
    }
    public function render()
    {
        $idLatestMeeting = LecturesMeeting::where('lecture_id', $this->lectureId)
            ->orderBy('id', 'DESC')->first();

        if($idLatestMeeting != null){
            $this->meetingId = $idLatestMeeting->id;
        }
        $students = LecturesStudent::where('lecture_id', $this->lectureId)->paginate(5);
        $lecture = Lectures::where('id', $this->lectureId)->first();
        return view('timetable::livewire.presence.import-presence', compact('lecture', 'students'));
    }
    public function importPresence($id){
        $this->filePresence = '';
        $this->meeting_date = null;
        $this->lectureId = $id;

        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('hideAll');
        $this->emit('importPresenceModal');
    }
    public function resetMeeting($id){
        $meeting = LecturesMeeting::where('id', $id)->first();
        if($meeting != null){
            $presences = LecturesPresence::where('meeting_id', $meeting->id)->get();
            if(!$presences->isEmpty()){
                foreach($presences as $presence){
                    LecturesPresence::where('id', $presence->id)->delete();
                }
            }
            LecturesMeeting::where('id', $meeting->id)->delete();
        }
    }

    public function submitPresence(){
        $this->validate([
            'filePresence' => "required|mimetypes:text/plain|max:10000",
            'meeting_date' => "required",
        ]);
        $path1 = $this->filePresence->store('temp');
        $path=storage_path('app').'/'.$path1;


        $checkDate = LecturesMeeting::where('lecture_id', $this->lectureId)
            ->where('meeting_date', $this->meeting_date)->first();

        if($checkDate === null){
            LecturesMeeting::create([
                'meeting_date' => $this->meeting_date,
                'lecture_id' => $this->lectureId,
            ]);
        }





        $idLatestMeeting = LecturesMeeting::where('lecture_id', $this->lectureId)
            ->orderBy('id', 'DESC')->first();

        $txt_file = file_get_contents($path);
        $rows = explode("\n", $txt_file); //Split the file by each line
        foreach ($rows as $row) {
            if($row != null){
                $presences = explode(" ", $row); //Split the line by a space, which is the seperator between username and password
                $time = str_replace("\t","",$presences[0]);
                $studentData = $presences[2];


                $student_number = explode ("_",$studentData );
                $student_id = LecturesStudent::where('lecture_id', $this->lectureId)
                    ->where('student_number', $student_number[0])->first();

                $this->meetingId = $idLatestMeeting->id;
                if($student_id != null){
                    $checkStudent = LecturesPresence::where('meeting_id', $idLatestMeeting->id)
                        ->where('lecture_id', $idLatestMeeting->id)
                        ->where('student_id', $student_id->id)->first();
                    if($checkStudent === null){
                        LecturesPresence::create([
                            'meeting_id' => $idLatestMeeting->id,
                            'lecture_id' => $this->lectureId,
                            'presence_time' => $time,
                            'student_id' =>$student_id->id,
                        ]);
                    }
                }
            }
        }
    }
}
