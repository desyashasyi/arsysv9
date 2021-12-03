<?php

namespace Modules\ArSys\Http\Livewire\Utilities\Admin;

use Livewire\Component;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchSupervisorTemp;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AddSupervisor extends Component
{
    protected $listeners = ['emiterUtilSetSupervisor' => 'setSupervisor'];
    public $supervisionFile;
    public $researchId = null;
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;
    public function render()
    {

        $research = Research::where('id', $this->researchId)->first();

        $faculties = Faculty::orderBy('code', 'ASC')
                    ->paginate(5);

        if ($this->search !== null) {
            $faculties = Faculty::where('first_name', 'like', '%' . $this->search . '%')
                ->orwhere('code', 'like', '%' . $this->search . '%')
                ->orderBy('code', 'ASC')
                ->paginate(5);
        }

        return view('arsys::livewire.utilities.admin.add-supervisor', compact('faculties', 'research'));
    }

    public function setSupervisor($id){
        $this->researchId = $id;
        $this->supervisionFile = null;
        $this->emit('UtilSetSupervisor');
    }

    public function assign($research_id, $faculty_id){


        //dd($supervisor->count());

        if(ResearchSupervisorTemp::where('research_id', $research_id)->count()
            <  Research::where('id', $research_id)->first()->type->supervisor_number){


            if (ResearchSupervisorTemp::where('research_id', $research_id)
                ->where('supervisor_id', $faculty_id)
                ->first() == null){
                    ResearchSupervisorTemp::updateOrCreate([
                        'research_id' => $research_id,
                        'supervisor_id' => $faculty_id,
                    ]);
            }

        }
        //$this->emit('refreshStudentResearchPage');
    }

    public function unAssign($research_id, $faculty_id){
        $oldFile = ResearchSupervisorTemp::where('research_id', $research_id)->where('supervisor_id', $faculty_id)->first();

        if($oldFile->file != null){
            $file = explode("/", $oldFile->file);
            if(Storage::exists('app/public/supervisor/'.$file[1])){
                unlink(storage_path('app/public/supervisor/'.$file[1]));
            }

        }
        ResearchSupervisorTemp::where('research_id', $research_id)->where('supervisor_id', $faculty_id)
            ->delete();
        //$this->emit('refreshStudentResearchPage');
    }

    public function storeFile($id){
        $this->validate([
            'supervisionFile' => "required|image|mimes:jpeg,png,jpg|max:5000",
        ]);

        $oldFile = ResearchSupervisorTemp::where('id', $id)->first();

        if($oldFile->file != null){
            $file = explode("/", $oldFile->file);
            if(Storage::exists('app/public/supervisor/'.$file[1])){
                unlink(storage_path('app/public/supervisor/'.$file[1]));
            }

        }

        $filename = $this->supervisionFile->store('supervisor', 'public');

        $file = [
            'file' => $filename,
        ];

        ResearchSupervisorTemp::find($id)->update($file);

    }

    public function closeModal(){
        $this->emit('refreshStudentResearchPage');
    }

}
