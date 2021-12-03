<?php

namespace Modules\ArSys\Http\Livewire\Profile\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Student;
use Auth;

class Edit extends Component
{

    protected $listeners = ['editStudentProfileComponent' => 'edit',
                            'selectEditStudyProgram' => 'fillStudyProgram',
                            'selectEditStudySpecialization' => 'fillSpecialization',
                            'selectEditSupervisor' => 'fillSupervisor',
                            ];

    public $student_number;
    public $study_program;
    public $study_specialization;
    public $first_name;
    public $last_name;
    public $supervisor;
    public $phone;
    public $email;


    public function fillStudyProgram($studyProgramId){
        $this->study_program = $studyProgramId['studyProgramId'];
    }

    public function fillSpecialization($studySpecializationId){
       $this->study_specialization = $studySpecializationId['studySpecializationId'];
    }

    public function fillSupervisor($supervisorId){
        $this->supervisor = $supervisorId['supervisorId'];
    }
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
        return view('arsys::livewire.profile.student.edit');
    }

    public function edit(){
        $profile = Student::where('student_number',  Auth::user()->sso_username)->first();
        $this->dispatchBrowserEvent('setSelection',
                                    ['program_id' => $profile->program_id,
                                     'specialization_id' => $profile->specialization_id,
                                     'supervisor_id' => $profile->supervisor_id,
                                    ]);

        $this->student_number = $profile->student_number;
        $this->study_program = $profile->program_id;
        $this->study_specialization = $profile->specialization_id;
        $this->first_name = $profile->first_name;
        $this->last_name = $profile->last_name;
        $this->supervisor = $profile->supervisor_id;
        $this->phone = $profile->phone;
        $this->email = $profile->email;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('editStudentProfileModal');

    }

    public function update(){

        Student::where('student_number', Auth::user()->sso_username)->update([
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
