<?php

namespace Modules\ArSys\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Modules\ArSys\Entities\Old\EndFaculty;
use Modules\ArSys\Entities\Old\EndStudent;
use Modules\ArSys\Entities\Old\EndSchedule;
use Modules\ArSys\Entities\Old\EndResearch;
use App\Models\User;
use App\Models\Role;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchType;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\AcademicYear;

class UtilitiesController extends Controller
{
    public function syncFaculty(){
        $user = Auth::user();

        if($user->hasRole('admin')){
            $faculties = EndFaculty::all();

            foreach($faculties as $faculty){
                $username = null;
                if($faculty->userdata != null){
                    $username = $faculty->userdata->sso_username;
                }

                Faculty::create([
                    'code' => $faculty->username,
                    'sso_username' => $username,
                    'upi_code' => $faculty->upi_code,
                    'nip' => $faculty->nip,
                    'front_title' => $faculty->front_title,
                    'rear_title' => $faculty->rear_title,
                    'first_name' => $faculty->first_name,
                    'last_name' => $faculty->last_name,
                    'specialization_id' => $faculty->specialization_id,
                    'homebase_id' => $faculty->homebase_id,
                    'created_at' => $faculty->created_at,
                    'updated_at' => $faculty->updated_at,
                ]);
            }
            toast('Data has been synced', 'success');
            return redirect()->route('arsys.home');
        }else{
            return redirect()->route('arsys');
        }
    }

    public function syncStudent(){
        $user = Auth::user();

        if($user->hasRole('admin')){
            $students = EndStudent::all();

            foreach($students as $student){
                $program_id = null;
                if($student->field_code === 'E0451'){
                    $program_id = 1;
                } elseif($student->field_code === 'E5051'){
                    $program_id = 2;
                }

                $specialization_id = null;
                if($student->concern_code == 'TE'){
                    $specialization_id = 2;
                }elseif($student->concern_code == 'EK'){
                    $specialization_id = 3;
                }elseif($student->concern_code == 'EI'){
                    $specialization_id = 1;
                }


                $studentCheck = Student::where('student_number', $student->student_number)->first();
                if($studentCheck == null){
                    if($program_id != null){

                        /*$studentUser = User::where('name', 's'.$student->student_number)->first();
                        if($studentUser == null){
                            $user = User::create([
                                'name' => 's'.$student->student_number,
                            ]);

                            $user->attachRole('student');
                        }*/

                        $faculty = Faculty::where('code', $student->supervisor)->first();
                        Student::create([
                            //'user_id' => $user->id,
                            'code' => 's'.$student->student_number,
                            'student_number' =>  $student->student_number,
                            'first_name' =>  $student->first_name,
                            'last_name' =>  $student->last_name,
                            'program_id' => $program_id,
                            'specialization_id' => $specialization_id,
                            'supervisor_id' => $faculty->id,
                            'created_at' => $student->created_at,
                            'updated_at' => $student->updated_at,
                        ]);
                    }
                }
            }
            toast('Data has been synced', 'success');
            return redirect()->route('arsys.home');
        }else{
            return redirect()->route('arsys');
        }
    }


    public function researchTruncate(){
        Research::query()->truncate();
        ResearchSupervisor::query()->truncate();
        toast('Data has been truncate', 'success');
        return redirect()->route('arsys');
    }


    public function syncSchedule(){
        $user = Auth::user();

        if($user->hasRole('admin')){
            $schedules = EndSchedule::all();


            foreach($schedules as $schedule){
                $event_type;
                $event_code;
                if($schedule->type == 'EE-seminar'){
                    $event_type = 3;
                    $event_code = 'STE';
                }elseif($schedule->type == 'Pre-defense'){
                    $event_type = 1;
                    $event_code = 'PRE';
                }if($schedule->type == 'Final-defense'){
                    $event_type = 2;
                    $event_code = 'PUB';
                }

                $event_id = $event_code.'-'.\Carbon\Carbon::parse($schedule->event_date)->format('dmY');

                Event::create([
                    'event_type' => $event_type,
                    'event_date' => $schedule->event_date,
                    'application_deadline' => $schedule->deadline,
                    'event_code' => $schedule->schedule_id,
                    'draft_deadline' => $schedule->draft_deadline,
                    'current' => $schedule->current,
                    'quota' => $schedule->quota,
                    'created_at' => $schedule->created_at,
                    'updated_at' => $schedule->updated_at,
                    //'letter_number' => $schedule->letter_number,
                    'event_id' => $event_id,
                ]);

            }
            toast('Data has been synced', 'success');
            return redirect()->route('arsys.home');
        }else{
            return redirect()->route('arsys.switch');
        }
    }

    public function syncResearch(){
        $user = Auth::user();

        if ($user != null && $user->hasRole('admin')){

            $students = Student::all();
            foreach($students as $student){
                $endResearchs = EndResearch::where('username', $student->code)->get();
                foreach ($endResearchs as $research){

                    $research_type = null;
                    $research_milestone = null;
                    if($research->research_type == 'SK'){
                        $research_type = 1;
                        if($research->milestone === 'Final-defense')
                            $research_milestone = 17;
                        else
                            $research_milestone = 0;
                    }elseif($research->research_type == 'TA'){
                        $research_type = 2;
                        if($research->milestone === 'Final-defense')
                            $research_milestone = 17;
                        else
                            $research_milestone = 0;
                    }elseif($research->research_type == 'STE' || $research->research_type == 'SE'){
                        $research_type = 4;
                        if($research->status === 'Completed' || $research->status === 'Scheduled')
                            $research_milestone = 10;
                        else
                            $research_milestone = 0;
                    }
                    $research_code  ='';
                    $researchCounter = Research::where('research_type', $research_type)->where('student_id', $student->id)->count();

                    if($research_type != null and $research->active == true){
                        $researchCode = ResearchType::where('id',$research_type)->first();
                        $research_code = $researchCode->code
                            .'-'.$student->code.'-'.(strval($researchCounter+1));

                        $rsc = Research::where('research_code', $research_code)->first();

                        if($rsc == null){
                            Research::create([
                                'student_id' => $student->id,
                                'research_type' => $research_type,
                                'research_code' => $research_code,
                                'title' => $research->title,

                                //'research_milestone' => 1,
                                'research_milestone' => $research_milestone,
                                'status' => $research_milestone,
                                'created_at' => $research->created_at,
                                'updated_at' => $research->updated_at,
                                'research_id' => $research->research_id,
                                'username' => $student->code,
                            ]);

                            $storeResearch = Research::where('research_code', $research_code)->first();

                            if ((intval($research->submission_period) > 202001)){
                                if($research->supervisor != null){
                                    foreach($research->supervisor as $supervisor){
                                        $supervisorData = Faculty::where('code', $supervisor->username)->first();
                                        //dd($supervisorData);
                                        if($supervisorData != null){
                                            ResearchSupervisor::create([
                                                'supervisor_id' => $supervisorData->id,
                                                'research_id' => $storeResearch->id,
                                            ]);
                                        }
                                    }
                                }


                            }else{
                                if($research->research_type == 'SK' || $research->research_type == 'TA'){
                                    $supervisorData = Faculty::where('code', $research->first_supervisor)->first();
                                    if($supervisorData != null){
                                        ResearchSupervisor::create([
                                            'supervisor_id' => $supervisorData->id,
                                            'research_id' => $storeResearch->id,
                                        ]);
                                    }

                                    $supervisorData = Faculty::where('code', $research->second_supervisor)->first();

                                    if($supervisorData != null){
                                        ResearchSupervisor::create([
                                            'supervisor_id' => $supervisorData->id,
                                            'research_id' => $storeResearch->id,
                                        ]);
                                    }
                                }else{
                                    $supervisorData = Faculty::where('code', $research->first_supervisor)->first();
                                    if($supervisorData != null){
                                        ResearchSupervisor::create([
                                            'supervisor_id' => $supervisorData->id,
                                            'research_id' => $storeResearch->id,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            toast('Data has been synced', 'success');
            return redirect()->route('arsys.home');
        }else{
            return redirect()->route('arsys.switch');
        }
    }

    public function setSupervisor(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view ('arsys::livewire.utilities.admin.set-supervisor-idx');
        }else
            return redirect()->route('arsys');
    }

    public function syncResearchSpv(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view('arsys::livewire.utilities.admin.sync-research.home-idx');
        }else
            return redirect()->route('arsys');
    }

    public function updateMilestone(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view('arsys::livewire.utilities.admin.update-milestone-idx');
        }else
            return redirect()->route('arsys');
    }

    public function setDefensePresence(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view('arsys::livewire.utilities.admin.set-defense-presence-idx');
        }else
            return redirect()->route('arsys');
    }

    public function deleteEvent(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view('arsys::livewire.utilities.admin.event.home-idx');
        }else
            return redirect()->route('arsys');
    }

    public function setEventType(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            $applicants = EventApplicant::all();
            foreach($applicants as $applicant){
                EventApplicant::find($applicant->id)->update([
                    'event_type' => $applicant->event->event_type,
                ]);
            }
            toast('Data has been set', 'success');
            return redirect()->route('arsys.home');
        }else
            return redirect()->route('arsys');
    }

    public function setAcademicYear(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            $academicYear = AcademicYear::latest()->first();
            $researchs = Research::where('approval_date', '>', $academicYear->start)->get();
            foreach($researchs as $research){
                Research::where('id', $research->id)->update([
                    'academic_year_id' => $academicYear->id,
                ]);
            }
            toast('Data has been set', 'success');
            return redirect()->route('arsys.home');
        }else
            return redirect()->route('arsys');
    }


}
