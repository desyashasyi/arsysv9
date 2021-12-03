<div>

    <div class="col-md-3 offset-md-0">
        <input wire:model="search" type="text" class="my-3 form-control" placeholder="Search student name">
    </div>


    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th class="text-left" width="2%">Number</th>
                <th class="text-left" width="23%">Student</th>
                <th class="text-left" width="35%">Research</th>
                <th class="text-left" width="40%">Endresearch</th>

            </tr>
            </thead>
            <tbody id="users-table">
                    @php($number = 0)
                    @foreach ($researchs as $research)
                        <tr>
                            <td>
                                {{++$number}}
                            </td>
                            <td>
                                {{$research->student->program->code}}.
                                {{$research->student->student_number}}
                                <br>
                                {{$research->student->first_name}}
                                {{$research->student->last_name}}
                            </td>
                            <td>
                                {{$research->research_code}}
                                <br>
                                {{$research->title}}
                                <br>
                                <br>
                                @if($research->milestone != null || $research->milestoneseminar != null)
                                    @if($research->type->research_model == 'defense')
                                        <b>{{$research->milestone->milestone}}</b> |
                                    @endif

                                    {{$research->type->description}} {{$research->student->program->description}}
                                @endif
                                <hr>
                                @if($research->supervisor->isNotEmpty())
                                    SPV:
                                    <br>
                                    @foreach($research->supervisor as $supervisor)
                                        {{$supervisor->faculty->code}}
                                        <br>
                                    @endforeach
                                @endif

                                @foreach($research->applicant as $applicant)
                                    {{$applicant->event->event_id}}
                                    <br>
                                    @if($applicant->event->event_type ==
                                        \Modules\ArSys\Entities\EventType::where('abbrev', 'PRE')->first()->id
                                        )
                                        @foreach($applicant->examiner as $examiner)
                                            {{$examiner->faculty->code}}
                                            <br>
                                        @endforeach
                                    @endif
                                @endforeach


                            </td>
                            <td>
                                @foreach($research->endprojectresearch as $endresearch)
                                    @if($endresearch->title == $research->title)
                                        {{$endresearch->title}} - <i>{{$endresearch->submission_period}}</i>
                                        <br>
                                        <b>SPV:</b>
                                        <br>
                                        @if($endresearch->submission_period <= 202001)
                                            1. {{$endresearch->first_supervisor}}
                                            <br>2. {{$endresearch->second_supervisor}}
                                        @else
                                            @foreach($endresearch->supervisor as $supervisor)
                                                @if($supervisor->role == 'First Supervisor')
                                                    1. {{$supervisor->username}}
                                                @else
                                                    2. {{$supervisor->username}}
                                                @endif
                                                <br>
                                            @endforeach
                                        @endif
                                        <hr>
                                        @if($endresearch->applicant != null)
                                            @foreach($endresearch->applicant as $applicantSchedule)
                                                @if($applicantSchedule->type == 'Pre-defense')
                                                    {{$applicantSchedule->schedule_id}}
                                                @endif
                                                <br>

                                                @if($applicantSchedule->type == 'Pre-defense')
                                                    EXA:
                                                    <br>
                                                    {{$applicantSchedule->report->first_examiner}}
                                                    <br>
                                                    {{$applicantSchedule->report->second_examiner}}
                                                    <br>
                                                    {{$applicantSchedule->report->third_examiner}}
                                                @endif
                                                @if($applicantSchedule->type == 'Final-defense')
                                                    {{$applicantSchedule->schedule_id}}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                                <br>
                                <button wire:click="sync({{$research->id}})"
                                    class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                    Sync
                                </button>
                            </td>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    {{$researchs->links()}}
</div>

