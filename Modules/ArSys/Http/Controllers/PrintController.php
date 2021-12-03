<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventLetterType;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\EventApplicantWaiting;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\StudyProgram;
use PDF;
use \Carbon\Carbon;

class PrintController extends Controller
{

    public function prinfDefense_Admin($eventId){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            $event = Event::where('id', $eventId)->first();
            $applicants = EventApplicant::where('event_id', $eventId)->get();
            $faculties = Faculty::whereHas('examiner', function($query) use($eventId){
                $query->where('event_id', $eventId);
            })->get();

            $defensePDF = PDF::loadView('arsys::livewire.print.admin.defensePDF', ['applicants' => $applicants, 'event' => $event])
                ->setPaper('a4', 'portrait');
            $defenseFacultyPDF = PDF::loadView('arsys::livewire.print.admin.defenseFacultyPDF', ['faculties' => $faculties, 'event' => $event])
                ->setPaper('a4', 'portrait');
            //return $defensePDF->stream($event->type->description.' '.\Carbon\Carbon::parse($event->event_date)->format('d F Y')),
            return $defenseFacultyPDF->stream($event->type->description.' '.\Carbon\Carbon::parse($event->event_date)->format('d F Y'));

        }else
            return redirect()->route('arsys');

    }

    public function prinfDocxDefense_Admin($eventId){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $section = $phpWord->addSection();
            $text = $section->addText('Didin Wahyudin');
            $text = $section->addText('Handsome');
            $text = $section->addText('Testing',array('name'=>'Arial','size' => 20,'bold' => true));
            $section->addImage("./images/ydm.png");
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('Appdividend.docx');
            return response()->download(public_path('Appdividend.docx'));

        }else
            return redirect()->route('arsys');

    }

    public function printDefense_Student($event_id, $research_id){
        $user = Auth::user();
        if($user != null && $user->hasRole('student')){
            $applicant = EventApplicant::where('event_id', $event_id)->where('research_id', $research_id)->first();
            $defenseStudentPDF = PDF::loadView('arsys::print.defenseStudentPDF', compact ('applicant'))
                ->setPaper('a4', 'portrait');
            return $defenseStudentPDF->stream($applicant->event->type->description.' '.\Carbon\Carbon::parse($applicant->event->event_date)->format('d F Y'));

        }else
            return redirect()->route('arsys');
    }

    public function printAssignmentPredef_Faculty($applicant_id){
        $user = Auth::user();
        if($user != null && $user->hasRole('faculty')){
            $applicant = EventApplicant::where('id', $applicant_id)->first();
            $eventId = $applicant->event_id;
            $researchId = $applicant->research_id;
            $faculties = Faculty::whereHas('examiner', function($query) use($eventId){
                    $query->where('event_id', $eventId);
                })
                ->orwhereHas('supervisor', function($query) use($researchId){
                        $query->where('research_id', $researchId);
                })
                ->get();
            $pdf = PDF::loadView('arsys::livewire.print.faculty.assignment.pre-defense', ['faculties' => $faculties, 'applicant' => $applicant])
                ->setPaper('a4', 'portrait');
            return $pdf->stream($applicant->event->type->description.' '.\Carbon\Carbon::parse($applicant->event->event_date)->format('d F Y').'-'.$applicant->research->student->first_name.' '.$applicant->research->student->last_name);

        }else
            return redirect()->route('arsys');
    }



    public function printAssignmentFinaldef_Faculty($room_id){
        $user = Auth::user();
        if($user != null && $user->hasRole('faculty')){
            $room = SeminarRoom::where('id', $room_id)->first();
            $eventId = $room->event_id;
            $faculties = Faculty::whereHas('examiner', function($query) use($eventId){
                    $query->where('event_id', $eventId);
                })
                ->orwhereHas('supervisor', function($query) use($researchId){
                        $query->where('research_id', $researchId);
                })
                ->get();
            $pdf = PDF::loadView('arsys::livewire.print.faculty.assignment.seminar', ['faculties' => $faculties, 'room' => $room])
                ->setPaper('a4', 'portrait');
            return $pdf->stream($applicant->event->type->description.' '.\Carbon\Carbon::parse($applicant->event->event_date)->format('d F Y').'-'.$applicant->research->student->first_name.' '.$applicant->research->student->last_name);

        }else
            return redirect()->route('arsys');
    }

    public function printYudisiumLetter_Admin($event_id, $program_id, $letter_type){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            if($letter_type == EventLetterType::where('code','YUDPRO')->first()->id){
                $program = StudyProgram::where('id', $program_id)->first();
                $event = Event::where('id', $event_id)->first();
                $applicants = EventApplicant::where('event_id', $event_id)->get();
                $waitingApplicants = EventApplicantWaiting::where('event_id', $event_id)->get();
                $pdf = PDF::loadView('arsys::livewire.print.event.admin.yudicium-proposal', ['applicants' => $applicants, 'waitingApplicants' => $waitingApplicants,'program' => $program, 'event' => $event])
                        ->setPaper('a4', 'portrait');
                return $pdf->stream($program->abbrev.'-Yudicium Proposal '.\Carbon\Carbon::parse($event->event_date));
            }elseif($letter_type == EventLetterType::where('code','DEANINV')->first()->id){
                $program = StudyProgram::where('id', $program_id)->first();
                $event = Event::where('id', $event_id)->first();
                $pdf = PDF::loadView('arsys::livewire.print.event.admin.dean-invitation', ['program' => $program, 'event' => $event])
                        ->setPaper('a4', 'portrait');
                return $pdf->stream($program->abbrev.'-Dean Invitation '.\Carbon\Carbon::parse($event->event_date));
            }

        }else
            return redirect()->route('arsys');
    }

    public function printYudiciumReport_Program($event_id){
        $user = Auth::user();
        if($user != null && $user->hasRole('program')){
            $program = StudyProgram::where('id', $user->faculty->program_id)->first();
            $event = Event::where('id', $event_id)->first();
            $pdf = PDF::loadview('arsys::livewire.print.seminar.program.yudicium-report', ['event' => $event, 'program' => $program])
                        ->setPaper('a4', 'landscape');
            return $pdf->stream($program->abbrev.'-Yudicium report of final defense'.Carbon::parse($event->event_date));
        }else
            return redirect()->route('arsys');

    }
}
