<?php

namespace Modules\ArSys\Http\Livewire\Utilities\Admin\SyncResearch;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventType;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseExaminer;
use Modules\ArSys\Entities\DefenseExaminerScore;
use Modules\ArSys\Entities\DefenseExaminerPresence;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\Old\EndResearch;

class Home extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {

        /*$researchs = Research::where('research_milestone', 17)->where('username', '!=', null)->get();
        foreach($researchs as $research){
            $this->sync($research->id);
        }
        */
        $researchs = Research::where('research_milestone', 17)->where('username', '!=', null)->paginate(10);
        if ($this->search !== null) {
            $researchs = Research::where('research_milestone', 17)->where('username', '!=', null)
            ->whereHas('student', function($query){
                $query->where('first_name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);
        }

        return view('arsys::livewire.utilities.admin.sync-research.home', compact('researchs'));
    }

public function sync($research_id){
        $research = Research::where('id', $research_id)->first();
        foreach($research->endprojectresearch as $endresearch){
            if($endresearch->title == $research->title){
                if($endresearch->submission_period <= 202001){
                    ResearchSupervisor::create([
                        'research_id' => $research->id,
                        'supervisor_id' => Faculty::where('code', $endresearch->first_supervisor)->first()->id,
                    ]);
                    ResearchSupervisor::create([
                        'research_id' => $research->id,
                        'supervisor_id' => Faculty::where('code', $endresearch->second_supervisor)->first()->id,
                    ]);
                }else{
                    foreach($endresearch->supervisor as $supervisor){
                        $spv = null;
                        if($supervisor->role == 'First Supervisor'){
                            $spv = $supervisor->username;
                        }else{
                            $spv = $supervisor->username;
                        }
                        ResearchSupervisor::create([
                            'research_id' => $research->id,
                            'supervisor_id' => Faculty::where('code', $spv)->first()->id,
                        ]);
                    }
                }
            }
        }
        $research = Research::where('id', $research_id)->first();
        foreach($research->endprojectresearch as $endresearch){
            if($endresearch->title == $research->title){
                if($endresearch->applicant != null){
                    foreach($endresearch->applicant as $applicantSchedule){
                        if($applicantSchedule->schedule != null)
                            if($applicantSchedule->type == 'Pre-defense'){
                                $event = Event::where('event_date', $applicantSchedule->schedule->event_date)
                                    ->where('event_type', EventType::where('abbrev', 'PRE')->first()->id)->first();
                                if($event == null){
                                    $event_type;
                                    $event_code;
                                    if($applicantSchedule->schedule->type == 'EE-seminar'){
                                        $event_type = 3;
                                        $event_code = 'STE';
                                    }elseif($applicantSchedule->schedule->type == 'Pre-defense'){
                                        $event_type = 1;
                                        $event_code = 'PRE';
                                    }if($applicantSchedule->schedule->type == 'Final-defense'){
                                        $event_type = 2;
                                        $event_code = 'PUB';
                                    }
                                    $event_id = $event_code.'-'.\Carbon\Carbon::parse($applicantSchedule->schedule->event_date)->format('dmY');
                                    Event::create([
                                        'event_type' => $event_type,
                                        'event_date' => $applicantSchedule->schedule->event_date,
                                        'application_deadline' => $applicantSchedule->schedule->deadline,
                                        'event_code' => $applicantSchedule->schedule->schedule_id,
                                        'draft_deadline' => $applicantSchedule->schedule->draft_deadline,
                                        'current' => $applicantSchedule->schedule->current,
                                        'quota' => $applicantSchedule->schedule->quota,
                                        'created_at' => $applicantSchedule->schedule->created_at,
                                        'updated_at' => $applicantSchedule->schedule->updated_at,
                                        //'letter_number' => $schedule->letter_number,
                                        'event_id' => $event_id,
                                    ]);
                                }
                                $event = Event::where('event_date', $applicantSchedule->schedule->event_date)
                                    ->where('event_type', EventType::where('abbrev', 'PRE')->first()->id)->first();

                                $applicant = EventApplicant::where('event_id', $event->id)->where('research_id', $research->id)->first();
                                if($applicant == null){
                                    EventApplicant::create([
                                        'research_id' => $research->id,
                                        'event_id' => $event->id,
                                    ]);
                                }

                                $applicant = EventApplicant::where('research_id',$research->id)->where('event_id',$event->id)->first();

                                if($applicantSchedule->report->first_examiner != null){
                                    $facultyId = Faculty::where('code', $applicantSchedule->report->first_examiner)->first()->id;
                                    DefenseExaminer::create([
                                        'event_id' => $event->id,
                                        'applicant_id' => $applicant->id,
                                        'examiner_id' => $facultyId,
                                    ]);
                                }


                                if($applicantSchedule->report->second_examiner != null){
                                    $facultyId = Faculty::where('code', $applicantSchedule->report->second_examiner)->first()->id;
                                    DefenseExaminer::create([
                                        'event_id' => $event->id,
                                        'applicant_id' => $applicant->id,
                                        'examiner_id' => $facultyId,
                                    ]);
                                }

                                if($applicantSchedule->report->third_examiner != null){
                                    $facultyId = Faculty::where('code', $applicantSchedule->report->third_examiner)->first()->id;
                                    DefenseExaminer::create([
                                        'event_id' => $event->id,
                                        'applicant_id' => $applicant->id,
                                        'examiner_id' => $facultyId,
                                    ]);
                                }

                                /*$examiners = DefenseExaminer::where('event_id',$event->id)->where('applicant_id',$applicant->id)->get();
                                foreach($examiners as $examiner){
                                    DefenseExaminerPresence::create([
                                        'event_id' => $event->id,
                                        'applicant_id' => $applicant->id,
                                        'examiner_id' => $examiner->id,
                                    ]);
                                    DefenseExaminerScore::create([
                                        'event_id' => $event->id,
                                        'applicant_id' => $applicant->id,
                                        'examiner_id' => $examiner->id,
                                    ]);
                                }*/

                            }
                            if($applicantSchedule->type == 'Final-defense'){
                                $event = Event::where('event_date', $applicantSchedule->schedule->event_date)
                                    ->where('event_type', EventType::where('abbrev', 'PUB')->first()->id)->first();
                                if($event == null){
                                    $event_type;
                                    $event_code;
                                    if($applicantSchedule->schedule->type == 'EE-seminar'){
                                        $event_type = 3;
                                        $event_code = 'STE';
                                    }elseif($applicantSchedule->schedule->type == 'Pre-defense'){
                                        $event_type = 1;
                                        $event_code = 'PRE';
                                    }if($applicantSchedule->schedule->type == 'Final-defense'){
                                        $event_type = 2;
                                        $event_code = 'PUB';
                                    }
                                    $event_id = $event_code.'-'.\Carbon\Carbon::parse($applicantSchedule->schedule->event_date)->format('dmY');
                                    Event::create([
                                        'event_type' => $event_type,
                                        'event_date' => $applicantSchedule->schedule->event_date,
                                        'application_deadline' => $applicantSchedule->schedule->deadline,
                                        'event_code' => $applicantSchedule->schedule->schedule_id,
                                        'draft_deadline' => $applicantSchedule->schedule->draft_deadline,
                                        'current' => $applicantSchedule->schedule->current,
                                        'quota' => $applicantSchedule->schedule->quota,
                                        'created_at' => $applicantSchedule->schedule->created_at,
                                        'updated_at' => $applicantSchedule->schedule->updated_at,
                                        //'letter_number' => $schedule->letter_number,
                                        'event_id' => $event_id,
                                    ]);
                                }
                                $event = Event::where('event_date', $applicantSchedule->schedule->event_date)
                                    ->where('event_type', EventType::where('abbrev', 'PUB')->first()->id)->first();

                                $applicant = EventApplicant::where('event_id', $event->id)->where('research_id', $research->id)->first();
                                if($applicant == null){
                                    EventApplicant::create([
                                        'research_id' => $research->id,
                                        'event_id' => $event->id,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }

}

