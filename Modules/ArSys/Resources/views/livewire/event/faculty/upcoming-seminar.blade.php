<div>
    @foreach($events as $event)
        @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id
            ||
            $event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'STE')->first()->id
            )
            @if($event->room != null)
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        <b><i>
                        {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('l,') }}
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                        </i></b>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive users-table">
                        <table class="table table-striped table-sm data-table">
                            <thead class="thead">
                                <tr>
                                    <th width="15%">Schedule</th>
                                    <th width="35%">Examiners</th>
                                    <th text-align="right" width="40%">Participants</th>
                                    <th text-align="left" width="10%">Mark</th>
                                </tr>
                            </thead>
                            <tbody id="users-table">
                                @foreach($event->room as $room)
                                    @if($room->examiner->contains('examiner_id', Auth::user()->faculty->id)
                                        )
                                        @php($currentRoom == $room->id)
                                        <tr>
                                            <td>
                                                {{$room->room_code}}
                                                <br>
                                                {{\Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                                                <br>
                                                @if($room->session)
                                                    {{$room->session->time}}
                                                @else
                                                    To be scheduled
                                                @endif
                                                <br>
                                                <br>
                                                <b>Meeting ID</b>
                                                <br>
                                                @if($room->space)
                                                    <a href="{{$room->space->link}}" target="_blank">
                                                        <u>
                                                        {{$room->space->space}}
                                                        </u>
                                                    </a>
                                                @else
                                                    To be scheduled
                                                @endif
                                                <br>
                                                <b>Passcode</b>
                                                <br>
                                                @if($room->space)
                                                    {{$room->space->passcode}}
                                                @else
                                                    -
                                                @endif
                                                <br>
                                                <b>Host</b>
                                                <br>
                                                @if($room->space)
                                                    @if($room->space->host_key)
                                                        {{$room->space->host_key}}
                                                    @else
                                                        -
                                                    @endif
                                                @endif

                                            </td>
                                            <td>
                                                <b>Moderator</b>
                                                <br>

                                                @foreach($room->moderator as $moderator)
                                                    {{$moderator->faculty->front_title}}
                                                    {{$moderator->faculty->first_name}}
                                                    {{$moderator->faculty->last_name}},
                                                    {{$moderator->faculty->rear_title}}
                                                    <br>
                                                @endforeach
                                                @if($room->moderator->contains('moderator_id', Auth::user()->faculty->id))
                                                    <button wire:click="$emit('seminarModeratorComponent', {{$room->id}})" class="btn btn-xs">
                                                        <i class="fa fa-xs fa-user-plus" style="color:green" aria-hidden="true"></i>
                                                        Add/Edit
                                                    </button>
                                                @endif
                                                <br>
                                                <b>Examiner</b>
                                                <br>
                                                @foreach($room->examiner as $examiner)
                                                    @if($room->moderator->contains('moderator_id', Auth::user()->faculty->id))
                                                        @if($examiner->presence != null)
                                                            <a class="btn btn-sm" wire:click="examinerPresence ({{$examiner->id}})">
                                                                <i class="fa fa-check-circle" style="color:green"  aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                            <a class="btn btn-sm" wire:click="examinerPresence ({{$examiner->id}})">
                                                                <i class="fa fa-check-circle" style="color:gray"  aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if($examiner->presence != null)
                                                            <i class="fa fa-xs fa-check-circle" style="color:green"  aria-hidden="true"></i>
                                                        @else
                                                            <i class="fa fa-xs fa-check-circle" style="color:gray"  aria-hidden="true"></i>
                                                        @endif
                                                    @endif
                                                    {{$examiner->faculty->front_title}}
                                                    {{$examiner->faculty->first_name}}
                                                    {{$examiner->faculty->last_name}},
                                                    {{$examiner->faculty->rear_title}}
                                                <br>
                                                @endforeach

                                                @if($room->moderator->contains('moderator_id', Auth::user()->faculty->id))
                                                    <hr>
                                                    <i>Please click on the <i class="fa fa-xs fa-check-circle" style="color:gray"  aria-hidden="true"></i>
                                                    to set examiner's presence</i>
                                                @endif
                                                <hr>
                                                <!--a class="btn btn-xs btn-info" wire:click="printAssignment({{$room->id}})"><i class="fa fa-print" aria-hidden="true"></i>
                                                    Print assignment
                                                </a>
                                                -->
                                            </td>
                                            <td text-align="right">
                                                @php($number = 0)
                                                @foreach($room->applicant as $number => $applicant)
                                                    {{++$number}}.
                                                    @if($applicant->research->pdfartdoc)
                                                        <a href="{{url('/')}}{{ Storage::disk('local')->url($applicant->research->pdfartdoc->filename)}}" target="blank"><i class="fa fa-xs fa-file-pdf" aria-hidden="true"></i>
                                                            <u>{{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}</u>
                                                        </a>
                                                    @else
                                                        {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                                    @endif
                                                    <br>
                                                @endforeach
                                                <hr>
                                                <i>Please click on the <i class="fa fa-xs fa-file-pdf" aria-hidden="true"></i>
                                                to download the participant's article</i>
                                                <br>
                                                <br>
                                                <i>Please click on the <i class="fa fa-xs fa-arrow-circle-up" aria-hidden="true" style="color:green"></i>
                                                to submit/revise the participant's defense-mark</i>


                                            </td>
                                            <td text-align="left" wire:poll>
                                                @foreach($room->examiner as $examiner)
                                                    @if($examiner->examiner_id == Auth::user()->faculty->id)
                                                        @if($examiner->score != null)
                                                            @php($number = null)
                                                            @foreach($examiner->score as $score)
                                                                {{++$number}}.
                                                                <u wire:click="$emit('submitSeminarScoreComponent_Faculty', {{$score->id}})" style="cursor:pointer">
                                                                    <i class="fa fa-xs fa-arrow-circle-up" aria-hidden="true" style="color:green"></i>
                                                                    @if($score->mark != null)
                                                                        {{$score->mark}}
                                                                    @else
                                                                        NULL
                                                                    @endif
                                                                </u>
                                                                <br>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'STE')->first()->id)
                    <div class="row">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                    <tr>
                                        <th width="10%">Code</th>
                                        <th width="20%">Schedule</th>
                                        <th text-align="right" width="25%">Participants</th>
                                        <th text-align="left" width="10%">Mark</th>
                                    </tr>
                                </thead>
                                <tbody id="users-table">
                                    @foreach($room->applicant as $applicant)
                                        @if($applicant->supervisor->contains('supervisor_id', Auth::user()->faculty->id))
                                            @if($currentRoom != $room->id)
                                                <tr>
                                                    <td>
                                                        {{$room->room_code}}
                                                    </td>
                                                    <td>
                                                        {{\Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                                                        <br>
                                                        {{$room->session->time}}
                                                    </td>
                                                    <td text-align="right">
                                                        @foreach($room->applicant as $applicant)
                                                            @if($applicant->supervisor->contains('supervisor_id', Auth::user()->faculty->id))
                                                                {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                                                <br>
                                                            @endif
                                                        @endforeach
                                                        <br>

                                                    </td>
                                                    <td text-align="left">
                                                        @foreach($room->examiner as $examiner)
                                                            @if($examiner->examiner_id == Auth::user()->faculty->id)
                                                                @if($examiner->score != null)
                                                                    @foreach($examiner->score as $score)
                                                                        <a class="btn btn-xs" wire:click="$emit('submitSeminarScoreComponent_Faculty', {{$score->id}})">
                                                                            <i class="fa fa-xs fa-edit" style="color:green"  aria-hidden="true"></i>
                                                                            <u>
                                                                            @if($score->mark != null)
                                                                                {{$score->mark}}
                                                                            @else
                                                                                NULL
                                                                            @endif
                                                                            </u>
                                                                        </a>
                                                                        <br>
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    @endforeach
    @livewire('arsys::seminar.faculty.submit-score')
    @livewire('arsys::event.admin.seminar.add-moderator')
</div>
