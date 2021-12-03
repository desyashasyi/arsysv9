<?php

namespace Modules\Timetable\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Timetable\Entities\Subject;
use Modules\Timetable\Entities\SubjectYear;
use Modules\Timetable\Entities\SubjectType;
use Modules\Timetable\Entities\Specialization;

class CurriculumImport implements ToCollection
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

        foreach($rows as $row){
            if($row[0] != 'No' && $row[0] != null ){
                $checkSubject = Subject::where('code', $row[1] )
                    ->where('program_id', $this->programId)->first();
                    $specializationId =  null;
                    $subjectType = null;
                    $subjectYear = null;
                    if($row[5] != null){
                        $specializationId = Specialization::where('code', $row[5])->first()->id;
                    }

                    if($row[6] != null){
                        $subjectType = SubjectType::where('code', $row[6])->first()->id;
                    }
                    $subjectYear = null;
                    if($row[7] != null){
                        $subjectYear = SubjectYear::where('year', $row[7])->first()->id;
                    }
                if($checkSubject  === null) {
                    Subject::create([
                        'code' => $row[1],
                        'name' => $row[2],
                        'credit' => $row[3],
                        'semester' => $row[4],
                        'specialization_id' => $specializationId,
                        'type_id' => $subjectType,
                        'program_id' => $this->programId,
                        'year_id' => $subjectYear,
                    ]);
                }else{
                    Subject::where('code', $row[1])->where('program_id', $this->programId)
                    ->update([
                        'code' => $row[1],
                        'name' => $row[2],
                        'credit' => $row[3],
                        'semester' => $row[4],
                        'specialization_id' => $specializationId,
                        'type_id' => $subjectType,
                        'program_id' => $this->programId,
                        'year_id' => $subjectYear,
                    ]);
                }
            }
        }
    }
}
