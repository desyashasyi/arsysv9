<?php

namespace Modules\Timetable\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Timetable\Entities\Subject;
use Modules\Timetable\Entities\SubjectYear;
use Modules\Timetable\Entities\SubjectType;
use Modules\Timetable\Entities\Specialization;
use Modules\Timetable\Entities\Program;
use Modules\Timetable\Entities\Faculty;
use Modules\Timetable\Entities\Schedule;
use Modules\Timetable\Entities\ScheduleRoom;
use Modules\Timetable\Entities\ScheduleYear;
use Modules\Timetable\Entities\ScheduleStudentSets;
use Modules\Timetable\Entities\ScheduleTeachingTeam;
use Log;

use Carbon\carbon;

class FETTimetableImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $programId;

    public function __construct(int $program_id)
    {
        $this->programId = $program_id;
    }
    public function collection (Collection $rows)
    {

        $activity_id = '';
        foreach($rows as $row){
            if($row[0] != 'Activity Id'){
                if($row[0] != $activity_id){
                    $activity_id = $row[0];
                    error_log($activity_id);

                    $subject = null;
                    if($row[4] != null){
                        $subject = explode('-', $row[4]);
                    }
                    if($subject[0] == Program::where('id', $this->programId)->first()->code){
                        $schedule_year = ScheduleYear::latest()->first();
                        $start_day = $schedule_year->start_date;
                        $daytime = null;
                        for($iter = 1; $iter < 8; $iter++){
                            $subject_day = Carbon::parse($start_day)->format('l');
                            if($subject_day == $row[1]){
                                $day = explode(' ', $start_day);
                                $dt = $day[0].' '.$row[2].':00';
                                $daytime =  Carbon::createFromFormat('Y-m-d H:i:s', $dt)->format('Y-m-d H:i:s');
                            }
                            $start_day = Carbon::parse($start_day)->addDay();
                        }

                        $schedule = null;
                        if($row[0] != null){
                            $schedule = Schedule::where('program_id', $this->programId)
                                ->where('activity_id', $row[0])
                                ->where('year_id', $schedule_year->id)
                                ->first();
                        }

                        $roomId = null;
                        if($row[7] != ''){
                            $room = ScheduleRoom::where('code', $row[7])->first();
                            if($room != null){
                                $roomId = $room->id;
                            }
                        }

                        $studentId = null;
                        if($row[3] != ''){
                            $student = ScheduleStudentSets::where('code', $row[3])->first();
                            if($student != null){
                                $studentId = $student->id;
                            }
                        }

                        $subjectId = null;
                        if($subject[1] != ''){
                            $subjectData = Subject::where('code', $subject[1])->first();
                            if($subjectData != null){
                                $subjectId = $subjectData->id;
                            }
                        }

                        if($schedule == null){
                            Schedule::create([
                                'activity_id' => $row[0],
                                'year_id' => $schedule_year->id,
                                'student_id' => $studentId,
                                'program_id' => $this->programId,
                                'subject_id' => $subjectId,
                                'daytime'=> $daytime,
                                'room_id' => $roomId,
                            ]);
                        }else{
                            Schedule::where('program_id', $this->programId)
                                ->where('activity_id', $row[0])
                                ->where('year_id', $schedule_year->id)
                                ->update([
                                    'activity_id' => $row[0],
                                    'year_id' => $schedule_year->id,
                                    'student_id' => $studentId,
                                    'program_id' => $this->programId,
                                    'subject_id' => $subjectId,
                                    'daytime'=> $daytime,
                                    'room_id' => $roomId,
                                ]);
                        }


                        $class = Schedule::where('program_id', $this->programId)
                            ->where('activity_id', $row[0])
                            ->where('year_id', $schedule_year->id)
                            ->first();

                        foreach(explode('+',$row[5]) as $teacher){
                            $faculty = Faculty::where('code', $teacher)->first();
                            $facultyId;
                            if($faculty != null){
                                $facultyId = $faculty->id;
                            }

                            $teachingTeam = ScheduleTeachingTeam::where('schedule_id', $class->id)
                                ->where('faculty_id', $facultyId)
                                ->first();
                            if($teachingTeam == null){
                                ScheduleTeachingTeam::create([
                                    'faculty_id' => $facultyId,
                                    'schedule_id' => $class->id,
                                ]);
                            }else{
                                if($schedule != null){
                                    $faculty = ScheduleTeachingTeam::where('schedule_id', $schedule->id)
                                    ->where('faculty_id', $facultyId)
                                    ->first();
                                    ScheduleTeachingTeam::where('id',$faculty->id)->update([
                                        'faculty_id' => $facultyId,
                                        'schedule_id' => $class->id,
                                    ]);
                                }
                            }
                        }
                    }
                }

            }
        }
    }
}
