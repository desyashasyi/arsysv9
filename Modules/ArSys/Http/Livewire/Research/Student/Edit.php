<?php

namespace Modules\ArSys\Http\Livewire\Research\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchType;
use Modules\ArSys\Entities\ResearchFile;
use Modules\ArSys\Entities\ResearchFileType;
use Livewire\WithFileUploads;
use Storage;
use Auth;




class Edit extends Component
{

    use WithFileUploads;
    public $researchId;
    public $researchEditFlag;
    public $researchTitle;
    public $researchAbstract;
    public $researchFile;
    public $researchData;
    public $user;
    public $researchType;

    protected $listeners = ['researchEditComponent' => 'researchEdit',
                            'selectResearchTypeEdit' => 'researchTypeEdit'];

    public function mount(){
        /*$this->researchData = null;
        $this->researchTitle = null;
        $this->researchAbstract = null;
        $this->researchFile = null;
        $this->user = null;
        */
    }
    public function render()
    {
        $this->user = Auth::user();
        if($this->user->hasRole('student')){
            return view('arsys::livewire.research.student.edit');
        }else
            return redirect()->route('arsys.switch');

    }
    public function researchTypeEdit($research_type)
    {
        $this->researchType = $research_type['researchType'];
    }
    public function researchEdit($id){
        $this->researchType = null;
        $this->researchFile = '';
        $this->researchId = $id;

        if($this->researchId != null){
            $this->researchData = Research::where('id', $this->researchId)->first();
            $this->researchTitle = $this->researchData->title;
            $this->researchAbstract = $this->researchData->abstract;
            if($this->researchData->file){
                $this->researchFile = $this->researchData->file->filename;
            }else{
                $this->researchFile = null;
            }
        }

        $this->emit('hideAll');
        $this->emit('researchEditModal');


    }

    public function researchUpdate(){

        if($this->researchType == null){
            $this->researchType = Research::where('id', $this->researchData->id)->first()->research_type;
        }

        $this->validate([
            'researchTitle' => 'required',
            'researchAbstract' => 'required',
            'researchFile' => "required|mimetypes:application/pdf|max:10000",
        ]);


        if($this->researchData->file != null){
            $oldFile = ResearchFile::where('id', $this->researchData->file->id)->first();
            if($oldFile->filename != null){
                $file = explode("/", $oldFile->filename);
                if(Storage::exists('app/public/proposal/'.$file[1])){
                    unlink(storage_path('app/public/proposal/'.$file[1]));
                }
            }
        }
        

        $researchCounter = Research::where('research_type', $this->researchType)
            ->where('student_id', $this->user->student->id)
            ->count();

        $research_code =  null;
        if($this->researchType != null){
            $research_code = ResearchType::where('id',$this->researchType)->first()->code
                            .'-'.$this->user->student->student_number.'-'.(strval($researchCounter+1));
        }else{
            $research_code = Research::where('id', $this->researchId)->first()->research_code;
        }

        $filename = $this->researchFile->storeAs('proposal', $research_code.'-Proposal.pdf','public');
        $file = [
            'research_id' => $this->researchData->id,
            'file_type' => ResearchFiletype::where('code', 'PRO')->first()->id,
            'filename' => $filename,
        ];

        if($this->researchData->file != null){
            ResearchFile::find($this->researchData->file->id)->update($file);
        }else{
            ResearchFile::create($file);
        }
        

        Research::find($this->researchId)->update([
            'title' => $this->researchTitle,
            'abstract' => $this->researchAbstract,
            'research_type' => $this->researchType,
            'research_code' => $research_code,
        ]);

        session()->flash('success', 'Research proposal has been successfully updated');
        $this->emit('refreshResearchIndex');
    }

}
