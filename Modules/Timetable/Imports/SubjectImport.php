<?php

namespace Modules\Timetable\Imports;

use Illuminate\Support\Collection;
use Modules\Timetable\Entities\Subject;
#use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class SubjectImport implements ToModel
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
    public function model(array $row)
    {

        if($row[0] != 'No' && $row[0] != null ){
            $checkSubject = Subject::where('subject_code', $row[1] )
                ->where('program_id', $this->programId)->first();


            if($checkSubject === null) {
                return new Subject([
                    'subject_code' => $row[1],
                    'subject_name' => $row[2],
                    'program_id' => Auth::user()->faculty->program_id,
                ]);
            }
        }
    }
}
