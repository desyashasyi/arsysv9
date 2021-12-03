<div>
    <div class="row">
        <div class="col-sm-3 offset-sm-0">
            <input wire:model="search" type="text" class="my-2 form-control" placeholder="Search event name">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 offset-sm-0">
            <b>Number of students</b>
        </div>
        <div class="col-sm-9 offset-sm-0">
            {{$applicants->total()}}
        </div>
    </div>
    <br>

    @if($applicants != null)
        <div class="row">
            <div class="col-sm-12 offset-sm-0">
                <div class="table-responsive users-table">
                    <table class="table table-sm data-table">
                        <thead class="thead">
                            <tr>
                                <th width="2%">No</th>
                                <th width="48%">Student</th>
                                <th width="20%" class="text-center">Supervisors</th>
                                <th width="30%" class="text-center">Examiners</th>
                            </tr>
                            </thead>
                        <tbody id="users-table">
                            @foreach($applicants as $number => $applicant)
                                @if($applicant->research->student->program_id == Auth::user()->faculty->program_id)
                                    <tr>
                                        <td>
                                            {{$applicants->firstItem() + $number}}
                                        </td>
                                        <td>
                                            {{$applicant->research->student->program->code}}.
                                            {{$applicant->research->student->student_number}}
                                            <br>
                                            {{$applicant->research->student->first_name}}
                                            {{$applicant->research->student->last_name}}
                                        </td>
                                        <td class="text-center">
                                            <div class="table-responsive">
                                                <table class="table table-sm data-table">
                                                    <thead class="thead">
                                                        <tr>
                                                            @foreach($applicant->research->supervisor as $supervisor)
                                                                <th>
                                                                    {{$supervisor->faculty->code}}
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @foreach($applicant->research->supervisor as $supervisor)
                                                                <td>
                                                                    @if($supervisor->supervisorscore != null)
                                                                        @foreach($supervisor->supervisorscore as $score)
                                                                            @if($score->mark != null)
                                                                                {{$score->mark}}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="table-responsive">
                                                <table class="table table-sm data-table">
                                                    <thead class="thead">
                                                        <tr>
                                                            @foreach($applicant->examiner as $examiner)
                                                                <th>
                                                                    @if($examiner->presence != null)
                                                                        {{$examiner->faculty->code}}
                                                                    @endif
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @foreach($applicant->examiner as $examiner)
                                                                <td>
                                                                    @if($examiner->presence != null)

                                                                        @if($examiner->examinerscore != null)
                                                                            @if( $examiner->examinerscore->mark != null)
                                                                                {{$examiner->examinerscore->mark}}
                                                                            @else
                                                                                <a class="btn btn-sm" wire:click="$emit('editExaminerScoreComponent',{{$examiner->id}})">
                                                                                    <u>
                                                                                        NULL
                                                                                    </u>
                                                                                </a>
                                                                            @endif
                                                                        @else
                                                                            <a class="btn btn-sm" wire:click="$emit('editExaminerScoreComponent',{{$examiner->id}})">
                                                                                <u>
                                                                                NULL
                                                                                </u>
                                                                            </a>
                                                                        @endif

                                                                        <br>
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        No data
    @endif
    {{$applicants->render()}}
</div>
