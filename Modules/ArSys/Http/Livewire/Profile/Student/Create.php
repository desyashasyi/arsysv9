<?php

namespace Modules\ArSys\Http\Livewire\Profile\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Student;
use Auth;

class Create extends Component
{
    protected $listeners = ['createStudentProfileComponent' => 'create',
                            'selectStudyProgram' => 'fillStudyProgram',
                            'selectStudySpecialization' => 'fillSpecialization',
                            'selectSupervisor' => 'fillSupervisor',
                            ];
    public $student_number;
    public $study_program;
    public $study_specialization;
    public $first_name;
    public $last_name;
    public $supervisor;
    public $phone;
    public $email;


    public function mount(){
        $this->student_number = '';
        $this->study_program = '';
        $this->study = '';
        $this->study_specialization = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->supervisor = '';
        $this->phone = '';
        $this->email = '';
    }
    public function render()
    {
        return view('arsys::livewire.profile.student.create');
    }
    public function create(){
        $this->dispatchBrowserEvent('resetSelection',[]);
        $this->student_number = '';
        $this->study_program = '';
        $this->study_specialization = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->supervisor = '';
        $this->phone = '';
        $this->email = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('createStudentProfileModal');
    }

    public function store(){

        $this->validate([
            'study_program' => 'required',
            'study_specialization' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'supervisor' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
        ]);




        $profile = Student::where('student_number', Auth::user()->sso_username)->first();
        if($profile === null){
            Student::create([
                'student_number' => Auth::user()->sso_username,
                'user_id' => Auth::user()->id,
                'code' => 's'.Auth::user()->sso_username,
                'program_id' => $this->study_program,
                'specialization_id' => $this->study_specialization,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'supervisor_id' => $this->supervisor,
                'phone' => $this->phone,
                'email' => $this->email,
            ]);
        }
    }

    public function fillStudyProgram($studyProgramId){
        $this->study_program = $studyProgramId['studyProgramId'];
    }

    public function fillSpecialization($studySpecializationId){
       $this->study_specialization = $studySpecializationId['studySpecializationId'];
    }

    public function fillSupervisor($supervisorId){
        $this->supervisor = $supervisorId['supervisorId'];
    }
}
