<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\StudyProgram;
use Modules\ArSys\Entities\EventAssignmentLetter;
use Carbon\Carbon;

class SubmitFinalDefense extends Component
{
    use WithFileUploads;
    public $eventId;
    public $programId = '';
    public $documentFile;
    public $listeners = ['submitFinalDefenseAssignmentLetterEmiter' => 'addAssignmentLetter',
                            'selectStudyProgram' => 'fillStudyProgram',
                        ];
    public function render()
    {
        return view('arxiv::livewire.assignment.admin.submit-final-defense');
    }

    public function addAssignmentLetter($event_id){
        $this->eventId = $event_id;
        $this->programId = '';
        $this->assignmentFile = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('resetProgramStudySelection');
        $this->emit('submitFinalDefenseAssignmentModal');
    }

    public function closeModal(){
        $this->emit('refreshAssignmentAdminFinalDefense');
    }

    public function documentStore(){
        $this->validate([
            'documentFile' => "required|mimetypes:application/pdf|max:10000",
        ]);

        if($this->programId == null){
            $this->emit('errorMessage', 'You should select the study program');
        }

        $programCode = StudyProgram::where('id', $this->programId)->first()->code;

        $fileCheck = EventAssignmentLetter::where('event_id', $this->eventId)->where('program_id', $this->programId)->first();
        if($fileCheck == null){
            //Upload the first time
            
            $filename = $this->documentFile->store('FinalDefAssign-'.$programCode, 'public');
            $file = [
                'program_id' => $this->programId,
                'event_id' => $this->eventId,
                'filename' => $filename,
            ];
            EventAssignmentLetter::create($file);
            $this->emit('successMessage', 'The letter of assignment has been submitted');
        }else{
            //Update the file, and deleted the old file
            $file = explode("/", $fileCheck->filename);
            if(Storage::exists('app/public/FinalDefAssign-'.$programCode.'/'.$file[1])){
                unlink(storage_path('app/public/FinalDefAssign-'.$programCode.'/'.$file[1]));
            }
            $filename = $this->documentFile->store('FinalDefAssign-'.$programCode, 'public');
            $file = [
                'program_id' => $this->programId,
                'event_id' => $this->eventId,
                'filename' => $filename,
            ];
            EventAssignmentLetter::where('id', $fileCheck->id)->update($file);
            Event::where('id', $this->eventId)->update(['status' => '1']);
            $this->emit('successMessage', 'The letter of assignment has been updated');
        }

    }
    public function fillStudyProgram($studyProgramId){
        $this->programId = $studyProgramId['studyProgramId'];
    }
}
