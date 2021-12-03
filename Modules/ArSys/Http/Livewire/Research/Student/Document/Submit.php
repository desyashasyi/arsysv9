<?php

namespace Modules\ArSys\Http\Livewire\Research\Student\Document;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchFileType;
use Modules\ArSys\Entities\ResearchFile;
use Modules\ArSys\Entities\ResearchFileSupervisor;
use Livewire\WithFileUploads;
use Storage;
use Auth;

class Submit extends Component
{
    public $researchId = null;
    public $fileType = null;
    public $documentFile = null;
    use WithFileUploads;
    public $listeners = ['emiterResearchStudentDocumentSubmit' => 'documentSubmit'];
    public function render()
    {
        $research = null;
        if($this->researchId != null){
            $research = Research::where('id', $this->researchId)->first();
        }

        return view('arsys::livewire.research.student.document.submit', compact('research'));
    }

    public function documentSubmit($research_id, $file_type){
        $this->researchId = $research_id;
        $this->fileType = $file_type;
        $this->documentFile = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('researchStudentDocumentModal');
    }

    public function documentStore(){

        $supervisorId;
        if($this->fileType == ResearchFileType::where('code', 'DRAFTTHESIS')->first()->id){
            $this->validate([
                'documentFile' => "required|mimetypes:application/pdf|max:10000",
            ]);
        }elseif($this->fileType == ResearchFileType::where('code', 'THESIS')->first()->id){
            $this->validate([
                'documentFile' => "required|mimetypes:application/pdf|max:10000",
            ]);
        }elseif($this->fileType == ResearchFileType::where('code', 'PDFART')->first()->id){
            $this->validate([
                'documentFile' => "required|mimetypes:application/pdf|max:50000",
            ]);
        }elseif($this->fileType == ResearchFileType::where('code', 'SPV')->first()->id){
            $this->validate([
                'documentFile' => "required|mimetypes:application/pdf|max:2000",
            ]);
            $supervisorId = $research = Research::where('id', $this->researchId)->first()
                ->supervisor->first()->supervisor_id;
        }
        elseif($this->fileType == ResearchFileType::where('code', 'COSPV')->first()->id){
            $this->validate([
                'documentFile' => "required|mimetypes:application/pdf|max:2000",
            ]);
            $supervisorId = $research = Research::where('id', $this->researchId)->first()
            ->supervisor->last()->supervisor_id;
        }

        $research_code = Research::where('id', $this->researchId)->first()->research_code;

        $fileFolder = ResearchFileType::where('id', $this->fileType)->first()->code;
        $fileCheck = ResearchFile::where('research_id', $this->researchId)->where('file_type', $this->fileType)->first();
        if($fileCheck == null){
            //Upload the first time
            $filename = $this->documentFile->storeAs($fileFolder, Auth::user()->student->first_name.'-'.$research_code.'-'.$fileFolder.'.pdf', 'public');
            $file = [
                'research_id' => $this->researchId,
                'file_type' => $this->fileType,
                'filename' => $filename,
            ];
            ResearchFile::create($file);

            //Create file supervisor
            if($this->fileType == ResearchFileType::where('code', 'SPV')->first()->id
                ||
                $this->fileType == ResearchFileType::where('code', 'COSPV')->first()->id){
                $fileSupervisor = ResearchFile::where('research_id', $this->researchId)->where('file_type', $this->fileType)->first();
                $fileSpv = [
                    'research_id' => $this->researchId,
                    'file_id' => $fileSupervisor->id,
                    'supervisor_id' => $supervisorId,
                ];
                ResearchFileSupervisor::create($fileSpv);
            }
        }else{
            //Update the file, and deleted the old file
            $file = explode("/", $fileCheck->filename);
            if(Storage::exists('app/public/'.$fileFolder.'/'.$file[1])){
                unlink(storage_path('app/public/'.$fileFolder.'/'.$file[1]));
            }


            $filename = $this->documentFile->storeAs($fileFolder, Auth::user()->student->first_name.'-'.$research_code.'-'.$fileFolder.'.pdf', 'public');
            $file = [
                'research_id' => $this->researchId,
                'file_type' => $this->fileType,
                'filename' => $filename,
            ];
            ResearchFile::where('id', $fileCheck->id)->update($file);
        }

        //Delete The Draft of Thesis
        if($this->fileType == ResearchFileType::where('code', 'THESIS')->first()->id){
            $fileToDelete = ResearchFile::where('research_id', $this->researchId)
                ->where('file_type', ResearchFileType::where('code', 'DRAFTTHESIS')->first()->id)->first();
            if($fileToDelete){
                $file = explode("/", $fileToDelete->filename);
                if(Storage::exists('app/public/DRAFTTHESIS/'.$file[1])){
                    unlink(storage_path('app/public/DRAFTTHESIS/'.$file[1]));
                }

                ResearchFile::where('id', $fileToDelete->id)->delete();
            }
        }
        $this->emit('successMessage', 'The required document(s) for defense has been submitted' );
    }

    public function close(){
        $this->documentFile = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('refreshStudentResearchPage');
    }
}
