<?php

namespace Modules\Timetable\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Timetable\Entities\Program;

class DataController extends Controller
{
    public function academicYear(request $request){
        $search = $request->search;

        if($search == ''){
            $academicYear = AcademicYear::orderby('academic_year','asc')->select('id','time')->get();
        }else{
            $academicYear = AcademicYear::orderby('academic_year','asc')->select('id','time')->where('academic_year', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($academicYear as $acYear){
            $response[] = array(
                "id"=>$acYear->id,
                "text"=>$acYear->academic_year
            );
        }

        echo json_encode($response);
        exit;
    }

    public function studyProgram(request $request ){
        $search = $request->search;

        if($search == ''){
            $study_programs = Program::orderby('code','asc')->select('id','code','description')->limit(5)->get();
        }else{
            $study_programs = Program::orderby('code','asc')->select('id','code', 'description')->where('description', 'like', '%' .$search . '%')
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

    public function studyProgramSecond(request $request ){
        $search = $request->search;

        if($search == ''){
            $study_programs = Program::orderby('code','asc')->select('id','code','description')->limit(5)->get();
        }else{
            $study_programs = Program::orderby('code','asc')->select('id','code', 'description')->where('description', 'like', '%' .$search . '%')
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
}
