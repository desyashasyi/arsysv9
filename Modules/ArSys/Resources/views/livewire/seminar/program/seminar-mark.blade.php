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
                                <th valign= "center" rowspan="2" width="33%">Student</th>
                                @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id)
                                    <th class="text-center" colspan="2">
                                        Pre Defense
                                    </th>
                                @endif

                                    @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id)
                                        <th class="text-center">
                                            Final Defense
                                        </th>
                                    @elseif($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'STE')->first()->id)
                                        <th class="text-center" colspan="2">
                                            Seminar
                                        </th>
                                    @endif
                            </tr>
                            @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id)
                                <tr>
                                    <th class="text-center">
                                        Supervisor
                                    </th>
                                    <th class="text-center">
                                        Examiners
                                    </th>
                                    <th class="text-center">
                                        Examiners
                                    </th>
                                </tr>
                            @endif

                        </thead>
                        <tbody id="users-table">
                            @php($counter=0)
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
                                        @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id)
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
                                                                            <a class="btn btn-sm" wire:click="$emit('editExaminerScoreComponent',{{$score->id}})">
                                                                                <u>
                                                                                    @if($score->mark != null)
                                                                                        {{$score->mark}}
                                                                                    @else
                                                                                        NULL
                                                                                    @endif
                                                                                </u>
                                                                            </a>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        @endif
                                        <td class="text-center">
                                            <div class="table-responsive">
                                                <table class="table table-sm data-table">
                                                    <thead class="thead">
                                                        <tr>

                                                            @foreach($applicant->previous->examiner as $examiner)
                                                                @if($examiner->presence != null)
                                                                    <th class="text-center">
                                                                        {{$examiner->faculty->code}}
                                                                    </th>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @foreach($applicant->previous->examiner as $examiner)
                                                            <td class="text-center">
                                                                @if($examiner->presence != null)
                                                                    @if($examiner->examinerscore != null)
                                                                    <a class="btn btn-sm" wire:click="$emit('editExaminerScoreComponent',{{$examiner->examinerscore->id}})">
                                                                        <u>
                                                                            @if( $examiner->examinerscore->mark != null)
                                                                                {{$examiner->examinerscore->mark}}
                                                                            @else
                                                                                NULL
                                                                            @endif
                                                                        </u>
                                                                    </a>
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
                                                                                                <a class="btn btn-xs" wire:click="$emit('editExaminerScoreComponent',{{$examiner->id}})">
                                                                                                    <u>
                                                                                                    @if( $score->mark == null)
                                                                                                        NULL
                                                                                                    @else
                                                                                                        {{$score->mark}}
                                                                                                    @endif
                                                                                                    </u>
                                                                                                </a>
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

    @livewire('arsys::defense.program.edit-score')

</div>
