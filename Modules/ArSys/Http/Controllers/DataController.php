<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\ArSys\Entities\ResearchType;
use Modules\ArSys\Entities\EventType;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\EventSession;
use Modules\ArSys\Entities\EventSpace;
use Modules\ArSys\Entities\DocumentType;
use Modules\ArSys\Entities\LetterType;
use Modules\ArSys\Entities\StudyProgram;
use Modules\ArSys\Entities\StudySpecialization;

class DataController extends Controller
{
    public function eventSessionDefense(request $request ){
        $search = $request->search;

        if($search == ''){
            $sessions = EventSession::where('type','defense')->orderby('time','asc')->select('id','time')->get();
        }else{
            $sessions = EventSession::where('type','defense')->orderby('time','asc')->select('id','time')->where('time', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($sessions as $session){
            $response[] = array(
                "id"=>$session->id,
                "text"=>$session->time
            );
        }

        echo json_encode($response);
        exit;
    }

    public function eventSessionSeminar(request $request ){
        $search = $request->search;

        if($search == ''){
            $sessions = EventSession::where('type','seminar')->orderby('time','asc')->select('id','time')->get();
        }else{
            $sessions = EventSession::where('type','seminar')->orderby('time','asc')->select('id','time')->where('time', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($sessions as $session){
            $response[] = array(
                "id"=>$session->id,
                "text"=>$session->time
            );
        }

        echo json_encode($response);
        exit;
    }

    public function eventSpace(request $request ){
        $search = $request->search;

        if($search == ''){
            $spaces = EventSpace::orderby('space','asc')->select('id','space','passcode','description')->get();
        }else{
            $spaces = EventSpace::orderby('space','asc')->select('id','space','passcode','description')->where('space', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($spaces as $space){
            $response[] = array(

                "id"=>$space->id,
                "text"=>$space->space.' | '.$space->passcode.' | '.$space->description,
            );
        }

        echo json_encode($response);
        exit;
    }

    public function eventType(request $request ){
        $search = $request->search;

        if($search == ''){
            $event = EventType::orderby('abbrev','asc')->select('id','abbrev','event_type')->get();
        }else{
            $event = EventType::orderby('abbrev','asc')->select('id','abbrev', 'event_type')->where('abbrev', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($event as $event){
            $response[] = array(
                "id"=>$event->id,
                "text"=>$event->abbrev.'-'.$event->event_type
            );
        }

        echo json_encode($response);
        exit;
    }

    public function eventTypeEdit(request $request ){
        $search = $request->search;

        if($search == ''){
            $event = EventType::orderby('abbrev','asc')->select('id','abbrev','event_type')->get();
        }else{
            $event = EventType::orderby('abbrev','asc')->select('id','abbrev', 'event_type')->where('abbrev', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($event as $event){
            $response[] = array(
                "id"=>$event->id,
                "text"=>$event->abbrev.'-'.$event->event_type
            );
        }

        echo json_encode($response);
        exit;
    }

    public function researchType(request $request ){
        $search = $request->search;

        if($search == ''){
            $research_types = ResearchType::orderby('code','asc')->select('id','code','description')->limit(5)->get();
        }else{
            $research_types = ResearchType::orderby('code','asc')->select('id','code', 'description')->where('description', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($research_types as $research_type){
            $response[] = array(
                "id"=>$research_type->id,
                "text"=>$research_type->code.' | '. $research_type->description
            );
        }

        echo json_encode($response);
        exit;
    }

    public function studyProgram(request $request ){
        $search = $request->search;

        if($search == ''){
            $study_programs = StudyProgram::orderby('code','asc')->select('id','code','description')->limit(5)->get();
        }else{
            $study_programs = StudyProgram::orderby('code','asc')->select('id','code', 'description')->where('description', 'like', '%' .$search . '%')
                ->orWhere('code', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($study_programs as $study_program){
            $response[] = array(
                "id"=>$study_program->id,
                "text"=>$study_program->code.' | '. $study_program->description
            );
        }

        echo json_encode($response);
        exit;
    }

    public function studySpecialization(request $request ){
        $search = $request->search;

        if($search == ''){
            $study_specializations = StudySpecialization::orderby('code','asc')->select('id','code','description')->limit(5)->get();
        }else{
            $study_specializations = StudySpecialization::orderby('code','asc')->select('id','code', 'description')->where('description', 'like', '%' .$search . '%')
                ->orWhere('code', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($study_specializations as $specialization){
            $response[] = array(
                "id"=>$specialization->id,
                "text"=>$specialization->code.' | '. $specialization->description
            );
        }

        echo json_encode($response);
        exit;
    }
    public function faculty(request $request ){
        $search = $request->search;

        if($search == ''){
            $faculties = Faculty::orderby('code','asc')->select('id','code','first_name', 'last_name')->limit(5)->get();
        }else{
            $faculties = Faculty::orderby('code','asc')->select('id','code', 'first_name', 'last_name')->where('first_name', 'like', '%' .$search . '%')
                ->orWhere('code', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($faculties as $faculty){
            $response[] = array(
                "id"=>$faculty->id,
                "text"=>$faculty->code.' | '. $faculty->first_name.' '. $faculty->last_name
            );
        }

        echo json_encode($response);
        exit;
    }

    public function letterType(request $request ){
        $search = $request->search;

        if($search == ''){
            $letterType = LetterType::orderby('id','asc')->select('id','code','description')->get();
        }else{
            $letterType = LetterType::orderby('id','asc')->select('id','code','description')->where('description', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($letterType as $letter){
            $response[] = array(
                "id"=>$letter->id,
                "text"=>$letter->id.'. '.$letter->description
            );
        }

        echo json_encode($response);
        exit;
    }

    public function documentType(request $request ){
        $search = $request->search;

        if($search == ''){
            $documentType = DocumentType::orderby('id','asc')->select('id','code','description')->get();
        }else{
            $documentType = DocumentType::orderby('id','asc')->select('id','code','description')->where('description', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($documentType as $document){
            $response[] = array(
                "id"=>$document->id,
                "text"=>$document->id.'. '.$document->description
            );
        }

        echo json_encode($response);
        exit;
    }
}
