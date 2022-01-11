<?php

namespace Modules\ArSys\Http\Livewire\Research\Student;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchType;
use Modules\ArSys\Entities\ResearchFile;
use Modules\ArSys\Entities\ResearchFileType;

use Auth;

class Create extends Component
{
    use WithFileUploads;
    public $researchCreateFlag;
    public $researchTitle;
    public $researchAbstract;
    public $researchFile;
    public $user;
    public $researchType;

    protected $listeners = ['researchCreateComponent' => 'researchCreate',
                            'selectResearchType' => 'researchType'];



    public function mount(){
        $this->researchTitle = null;
        $this->researchAbstract = null;
        $this->researchType = null;
        $this->researchFile = null;
        $this->researchType = null;
    }

    public function researchType($research_type)
    {
        $this->researchType = $research_type['researchType'];
    }

    public function render()
    {

        $this->user = Auth::user();
        return view('arsys::livewire.research.student.create');
    }
    public function researchCreate(){
        $this->dispatchBrowserEvent('resetResearchType',[]);
        $this->researchTitle = '';
        $this->researchAbstract = '';
        $this->researchFile = '';
        $this->researchType = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('hideAll');
        $this->emit('researchCreateModal');
    }
    public function researchStore(){
        $this->validate([
            'researchTitle' => 'required',
            'researchAbstract' => 'required',
            'researchType' => 'required',
            'researchFile' => "required|mimetypes:application/pdf|max:10000",
        ]);


        /**
         * Check amount of research data
         */

        $researchCounter = Research::where('research_type', $this->researchType)
            ->where('student_id', $this->user->student->id)
            ->count();
        $research_code = ResearchType::where('id',$this->researchType)->first()->code
                            .'-'.$this->user->student->student_number.'-'.(strval($researchCounter+1));
        Research::create([
            'student_id' => $this->user->student->id,
            'title' => $this->researchTitle,
            'abstract' => $this->researchAbstract,
            'research_type' => $this->researchType,
            'research_milestone' => 1,
            'research_code' => $research_code,
        ]);


        $research = Research::where('research_code', $research_code)->first();
        $filename = $this->researchFile->storeAs('proposal', $research_code.'-proposal.pdf','public');
        $file = [
            'research_id' => $research->id,
            'file_type' => ResearchFiletype::where('code', 'PRO')->first()->id,
            'filename' => $filename,
        ];
        ResearchFile::create($file);
        session()->flash('success', 'Research proposal has been successfully created');
        $this->emit('refreshResearchIndex');
    }


    public function industrialStore(){
        $this->validate([
            'researchTitle' => 'required',
            'researchAbstract' => 'required',
            'researchType' => 'required',
            'researchFile' => "required|mimetypes:application/pdf|max:10000",
        ]);


        /**
         * Check amount of research data
         */

        $researchCounter = Research::where('research_type', $this->researchType)
            ->where('student_id', $this->user->student->id)
            ->count();
        $research_code = ResearchType::where('id',$this->researchType)->first()->code
                            .'-'.$this->user->student->student_number.'-'.(strval($researchCounter+1));
        
        dd($researchCounter);
        if($researchCounter == null){
            Research::create([
                'student_id' => $this->user->student->id,
                'title' => $this->researchTitle,
                'abstract' => $this->researchAbstract,
                'research_type' => $this->researchType,
                'research_milestone' => 6,
                'research_code' => $research_code,
            ]);

            $research = Research::where('research_code', $research_code)->first();
            $filename = $this->researchFile->storeAs('proposal', $research_code.'-proposal.pdf','public');
            $file = [
                'research_id' => $research->id,
                'file_type' => ResearchFiletype::where('code', 'PIREPORT')->first()->id,
                'filename' => $filename,
            ];
            ResearchFile::create($file);
            session()->flash('success', 'Report of industrial practical word has been successfully created');
            $this->emit('refreshResearchIndex');
        }
        
        
    }
}
