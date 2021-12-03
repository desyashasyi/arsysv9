<?php

namespace Modules\Timetable\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\ArSys\Entities\Research;
use Maatwebsite\Excel\Concerns\FromCollection;

class FetTeacherExport implements FromQuery
{



    public function query()
    {
        return Research::all();
    }
}
