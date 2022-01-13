<div>
    <div class="row">
        <div class="col-sm-3 offset-sm-0">
            <input wire:model="search" type="text" class="my-2 form-control" placeholder="Search event name">
        </div>
    </div>

    @forelse ($events as $event)
        <div class="row">
            <div class="col-sm-2 offset-sm-0">
                <b>Event ID</b>
            </div>
            <div class="col-sm-10 offset-sm-0">
                {{$event->event_id}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-sm-0">
                <b>Event Name</b>
            </div>
            <div class="col-sm-10 offset-sm-0">
                {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-sm-0">
                <b>Report</b>
            </div>
            @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id)
                <div class="col-sm-10 offset-sm-0">
                    <button wire:click="printReport({{$event->id}})" class="btn btn-sm"><i class="fa fa-sm fa-print"></i> Print Yudicium Report</button>
                </div>
            @elseif($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'STE')->first()->id)
                <div class="col-sm-10 offset-sm-0">
                    <button wire:click="printReport({{$event->id}})" class="btn btn-sm"><i class="fa fa-sm fa-print"></i> Print STE Report</button>
                </div>
            @endif

        </div>
        <br>
        <div class="row">
            <div class="col-sm-12 offset-sm-0">
                <div class="table-responsive users-table">
                    <table class="table table-sm data-table">
                        <thead class="thead">
                            <tr>
                                <th valign= "center" rowspan="2" width="2%">No</th>
                                <th valign= "center" rowspan="2" width="30%">Student</th>
                                <th valign= "center" class="text-center" rowspan="2" width="10%">SPV</th>
                                   @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'STE')->first()->id)
                                        <th class="text-center" width="60%" colspan="2">
                                            Seminar
                                        </th>
                                    @endif
                                <th  class="text-right" valign= "center" rowspan="2" width="10%">Grade</th>
                            </tr>

                            

                        </thead>
                        <tbody id="users-table">
                            @php($counter=0)
                            @php($examinerScore = NULL)
                            @php($examinerCounter = NULL)
                            @php($spvScore = NULL)
                            @foreach($event->applicant as $applicant)
                                @if($applicant->research->student->program_id == Auth::user()->faculty->program_id)
                                    <tr>
                                        <td>
                                            {{++$counter}}
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
                                                            <th class="text-center">
                                                                @foreach($applicant->research->supervisor as $supervisor)
                                                                    {{$supervisor->faculty->code}}
                                                                @endforeach
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">
                                                                @foreach($applicant->research->supervisor as $supervisor)
                                                                    @if(!$supervisor->supervisorscore->isEmpty())
                                                                        @foreach($supervisor->supervisorscore as $score)
                                                                            @if($score->mark != NULL)
                                                                                @php($spvScore = $score->mark)
                                                                                <u wire:click="$emit('editSupervisorSeminarScoreComponent_Program', {{$supervisor->id}}, {{$event->id}}, {{$applicant->id}})" style="cursor:pointer">
                                                                                    <i class="fa fa-xs fa-arrow-circle-up" aria-hidden="true" style="color:green"></i>
                                                                                    {{$score->mark}}
                                                                                </u>
                                                                                
                                                                            @else
                                                                                <u wire:click="$emit('editSupervisorSeminarScoreComponent_Program', {{$supervisor->id}}, {{$event->id}}, {{$applicant->id}})" style="cursor:pointer">
                                                                                    <i class="fa fa-xs fa-arrow-circle-up" aria-hidden="true" style="color:green"></i>
                                                                                    NULL
                                                                                </u>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <u wire:click="$emit('editSupervisorSeminarScoreComponent_Program', {{$supervisor->id}}, {{$event->id}}, {{$applicant->id}})" style="cursor:pointer">
                                                                            <i class="fa fa-xs fa-arrow-circle-up" aria-hidden="true" style="color:green"></i>
                                                                            NULL
                                                                        </u>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            
                                        </td>
                                        <td>
                                            <div class="table-responsive">
                                                <table class="table table-sm data-table">
                                                    <thead class="thead">
                                                        <tr>
                                                            @foreach($applicant->room as $room)
                                                                @if($room->id === $applicant->room_id)
                                                                    @foreach($room->examiner as $examiner)
                                                                            @if($examiner->presence != null)
                                                                                <th class="text-center">
                                                                                {{$examiner->faculty->code}}
                                                                                </th>
                                                                            @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @foreach($applicant->room as $room)
                                                                @if($room->id === $applicant->room_id)
                                                                    
                                                                    @foreach($room->examiner as $examiner)
                                                                            @if($examiner->presence != null)
                                                                                <td class="text-center">
                                                                                    @if($examiner->score != null)
                                                                                        @foreach($examiner->score as $score )
                                                                                            @if($score->applicant_id == $applicant->id)
                                                                                                @php($examinerScore += $score->mark)
                                                                                                @if( $score->mark == null)
                                                                                                    NULL
                                                                                                @else
                                                                                                    @php($examinerCounter++)
                                                                                                    {{$score->mark}}
                                                                                                @endif
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif

                                                                                </td>
                                                                            @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                            

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            @php($finalScore = NULL)
                                            @if($examinerCounter == NULL)
                                                @php($examinerCounter = 1)
                                                @php($examinerScore = 1)
                                            @endif
                                            @if($spvScore != NULL)
                                                @php($finalScore = (0.6*$spvScore) + (0.4*($examinerScore/$examinerCounter)))

                                                @if($finalScore >= 385)
                                                    A
                                                @elseif($finalScore >= 351)
                                                    A-
                                                @elseif($finalScore >= 318)
                                                    B+
                                                @elseif($finalScore >= 285)
                                                    B
                                                @elseif($finalScore >= 251)
                                                    B-
                                                @elseif($finalScore >= 218)
                                                    C+
                                                @elseif($finalScore >= 185)
                                                    C
                                                @elseif($finalScore >= 101)
                                                    D
                                                @else
                                                    E
                                                @endif
                                            @else
                                                Supervise Score NULL
                                            @endif
                                            @php($spvScore = NULL)
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        No data
    @endforelse
    {{$events->links()}}

    @livewire('arsys::seminar.program.edit-seminar-score')
    

</div>
