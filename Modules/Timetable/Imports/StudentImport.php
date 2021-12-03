<?php

namespace Modules\Timetable\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Timetable\Entities\LecturesStudent;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $lecture_id;

    public function __construct(int $lecture_id)
    {
        $this->lecture_id = $lecture_id;
    }
    public function model(array $row)
    {
        if($row[0] != 'No' && $row[0] != null ){
            $checkStudent = LecturesStudent::where('lecture_id', $this->lecture_id)
                ->where('student_number', $row[1])->first();

            if($checkStudent === null) {
                return new LecturesStudent([
                    'lecture_id' => $this->lecture_id,
                    'student_number' => $row[1],
                    'student_name' => $row[2],
                ]);
            }
        }
    }
}
