<div>
    <div class="my-2 row">
        <div class="text-left col-sm-12">

            <button wire:click = "$emit('seminarAddRoomComponent', {{$event->id}})" class="btn btn-sm btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i> Add Room</button>
            <button wire:click="publish" class="btn btn-sm btn-primary"><i class="fa fa-globe"></i> Publish</button>
            <button wire:click = "sortUpApplicant" class="btn btn-sm btn-primary"><i class="fa fa-sort" aria-hidden="true"> </i> Sort</button>
            @if($event->status == true)
            <button wire:click = "$emit('eventAdminSeminarPrintSchedule', {{$event->id}})" class="btn btn-sm btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print Schedule</button>

                <button wire:click="scheduleCompleted" class="btn btn-sm btn-primary"><i class="fa fa-cog"></i>
                    Make Schedule Completed
                </button>
            @endif
            <br>
            <hr>
            @if($event->letter != null)
                @foreach($event->letter as $letter)
                    @if($letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id)
                        <button wire:click="printYudiciumLetter({{$letter->program_id}}, {{$letter->type_id}})" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>
                            {{$letter->type->description}} - {{$letter->program->abbrev}}
                        </button>
                    @endif
                @endforeach
            @endif

            @if($event->letter != null)
                @foreach($event->letter as $letter)
                    @if($letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'YUDPRO')->first()->id)
                        <button wire:click="printYudiciumLetter({{$letter->program_id}}, {{$letter->type_id}})" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>
                            {{$letter->type->description}} - {{$letter->program->abbrev}}
                        </button>
                    @endif
                @endforeach
            @endif


        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-md-3 offset-md-0">
            <b>Event Code</b>
        </div>
        <div class="col-md-9 offset-md-0">
            {{$event->event_id}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-0">
            <b>Event Description</b>
        </div>
        <div class="col-md-9 offset-md-0">
            {{$event->type->description}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-0">
            <b>Number of Assignment Letter</b>
        </div>
        <div class="col-md-9 offset-md-0">
            @if($event->letter != null)
                @foreach($event->letter as $letter)

                    @if($letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEFASS')->first()->id)
                        <button wire:click="deleteLetter({{$letter->id}})" class="btn btn-xs">
                            <i class="fa fa-trash" style="color:red" aria-hidden="true"></i>
                        </button>
                        {{$letter->number}} - {{$letter->program->description}}
                        <br>
                    @endif
                @endforeach
            @endif
            <a class="btn btn-xs" wire:click="$emit('eventAddLetterNumberComponent', {{$event->id}})"><i class="fa fa-xs fa-envelope" style="color:green" aria-hidden="true"></i> Add</a>

        </div>
    </div>
    @if($event->event_type ===
                        \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id
        )


        <div class="row">
            <div class="col-md-3 offset-md-0">
                <b>Number of Yudicium Proposal</b>
            </div>
            <div class="col-md-9 offset-md-0">
                @if($event->letter != null)
                    @foreach($event->letter as $letter)
                        @if($letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'YUDPRO')->first()->id)
                            <button wire:click="deleteLetter({{$letter->id}})" class="btn btn-xs">
                                <i class="fa fa-trash" style="color:red" aria-hidden="true"></i>
                            </button>
                            {{$letter->number}} - {{$letter->program->description}}
                            <br>
                        @endif
                    @endforeach
                @endif
                <a class="btn btn-xs" wire:click="$emit('eventAddLetterNumberComponent', {{$event->id}})"><i class="fa fa-xs fa-envelope" style="color:green" aria-hidden="true"></i> Add</a>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3 offset-md-0">
                <b>Number of Dean Invitation</b>
            </div>
            <div class="col-md-9 offset-md-0">
                @if($event->letter != null)
                    @foreach($event->letter as $letter)
                        @if($letter->type_id == \Modules\ArSys\Entities\EventLetterType::where('code', 'DEANINV')->first()->id)
                            <button wire:click="deleteLetter({{$letter->id}})" class="btn btn-xs">
                                <i class="fa fa-trash" style="color:red" aria-hidden="true"></i>
                            </button>
                            {{$letter->number}} - {{$letter->program->description}}
                            <br>
                        @endif
                    @endforeach
                @endif
                <a class="btn btn-xs" wire:click="$emit('eventAddLetterNumberComponent', {{$event->id}})"><i class="fa fa-xs fa-envelope" style="color:green" aria-hidden="true"></i> Add</a>

            </div>
        </div>
    @endif
    @if($rooms->isNotEmpty())
        <div class="row">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%">Code</th>
                        <th width="10%">Mod</th>
                        <th width="10%">Exa</th>
                        <th width="45%">Participant</th>
                        <th class="text-center" width="15%">Schedule</th>
                        <th class="text-right" width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="users-table">

                        @foreach($rooms as $number => $room)
                            <tr>

                                <td>{{$rooms->firstItem() + $number}}
                                </td>
                                <td>
                                    {{$room->room_code}}
                                </td>

                                <td>
                                    @if($room->moderator !=  null)
                                        @foreach($room->moderator as $moderator)
                                        <button class="btn btn-sm" wire:click="unAssignModerator({{$moderator->id}})"><i class="fa fa-xs fa-user-minus" style="color:red" aria-hidden="true"></i>
                                            <u>{{$moderator->faculty->code}}</u>
                                        </button>
                                        <br>
                                        @endforeach
                                    @endif
                                    <button wire:click="$emit('seminarModeratorComponent', {{$room->id}})" class="btn btn-xs">
                                        <i class="fa fa-xs fa-user-plus" style="color:green" aria-hidden="true"></i>
                                         Add
                                    </button>
                                </td>
                                <td>
                                    @if($room->examiner)
                                        @foreach($room->examiner as $examiner)
                                            <button class="btn btn-sm" wire:click="unAssignExaminer({{$examiner->id}})"><i class="fa fa-xs fa-user-minus" style="color:red" aria-hidden="true"></i>
                                                <u>{{$examiner->faculty->code}}</u>
                                            </button>
                                            <br>
                                        @endforeach
                                    @endif
                                    <button wire:click="$emit('seminarExaminerComponent', {{$room->id}})" class="btn btn-xs">
                                        <i class="fa fa-xs fa-user-plus" style="color:green" aria-hidden="true"></i>
                                         Add
                                    </button>
                                </td>

                                <td>
                                    @foreach($room->applicant as $applicant)
                                        <button class="btn btn-sm" wire:click="unAssignApplicant({{$applicant->id}})"><i class="fa fa-xs fa-user-minus" style="color:red" aria-hidden="true"></i>
                                       
                                            {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                            |
                                            @if($applicant->research->supervisor != null)
                                                @forelse ($applicant->research->supervisor as $supervisor)
                                                    <i>{{$supervisor->faculty->code}}</i>
                                                    &nbsp;
                                                @empty
                                                @endforelse
                                            @endif
                                            |
                                            @if($applicant->previous != null)
                                                @foreach ($applicant->previous->examiner as $examiner)
                                                    @if($examiner->presence != null)
                                                        <i>{{$examiner->faculty->code}}</i>
                                                        &nbsp;
                                                    @endif
                                                @endforeach
                                            @endif
                                        </button>
                                        <br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <button wire:click="$emit('eventAdminSeminarEditRoomSpace', {{$room->id}})" class="btn btn-sm">
                                        <u>
                                            @if($room->space)
                                                {{$room->space->description}} Meeting
                                            @else
                                                Null
                                            @endif
                                        </u>
                                    </button>
                                    <br>
                                    <button wire:click="$emit('eventAdminSeminarEditRoomSession', {{$room->id}})" class="btn btn-sm">
                                        <u>
                                            @if($room->session)
                                                {{$room->session->time}}
                                            @else
                                                Null
                                            @endif
                                        </u>
                                    </button>
                                </td>
                                <td>
                                    <button wire:click="$emit('seminarDeleteRoomComponent', {{$room->id}}, {{$room->event->id}})" class="btn btn-sm">
                                        Delete <i class="fa fa-sm fa-trash" style="color:red" aria-hidden="true"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$rooms->render()}}
            </div>
        </div>
    @endif
    <hr>
    <div class="row">
        <div class="text-left col-sm-4">
            <b>Registered Participants:</b> {{$registeredParticipants}}
        </div>
        <div class="text-right col-sm-8">
            @if($addWaitingApplicantForm)
                <button wire:click="addWaitingApplicant" class="btn btn-sm"><i class="fa fa-lg fa-toggle-on" style ="color:green" aria-hidden="true"></i> Waiting Applicant</button>
            @else
                <button wire:click="addWaitingApplicant" class="btn btn-sm"><i class="fa fa-lg fa-toggle-off" aria-hidden="true" style ="color:gray"></i> Waiting Applicant</button>
            @endif
        </div>
    </div>
    @if($addWaitingApplicantForm)
        @livewire('arsys::event.admin.seminar.applicant-waiting', ['event_id' => $event->id])
        <hr>
    @endif
    {{$applicants->links()}}
    @if($waitingApplicant->isNotEmpty())
        <div class="row">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Student</th>
                        <th width="50%">Research</th>
                        <th class="text-center" width="10%">SPV</th>
                        <th class="text-right" width="10%">Action</th>

                    </tr>
                    </thead>
                    <tbody id="users-table">

                        @forelse ($waitingApplicant as $number => $applicant)
                            <tr>
                                <td>
                                    {{++$number}}
                                </td>
                                <td>
                                    @if($applicant->research->student->program != null)
                                        {{$applicant->research->student->program->code}}.{{$applicant->research->student->student_number}}
                                    @endif
                                    <br>
                                    {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                </td>
                                <td>
                                    <b>{{$applicant->research->research_code}}</b>
                                    <br>
                                    {{$applicant->research->title}}
                                </td>
                                <td class="text-center">
                                    @if($applicant->research->supervisor != null)
                                        @forelse ($applicant->research->supervisor as $supervisor)

                                            @foreach($rooms as $room)
                                                @if($room->examiner->contains('examiner_id', $supervisor->supervisor_id))
                                                    <i class="fa fa-xs fa-check-circle" style="color:green" aria-hidden="true"></i>
                                                @endif
                                            @endforeach
                                            {{$supervisor->faculty->code}}
                                            <br>
                                        @empty
                                        @endforelse
                                    @endif
                                </td>
                                <td class="text-right">
                                    <button wire:click = "fixingApplicant({{$applicant->id}})" class="btn btn-sm"><i class="fa fa-edit" style ="color:green"></i> Fix</button>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan = "6">
                                No data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="table-responsive users-table">
            <table class="table table-striped table-sm data-table">
                <thead class="thead">
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Student</th>
                    <th width="30%">Research</th>
                    <th class="text-center" width="10%">SPV</th>
                    <th class="text-center" width="15%">Room</th>
                    <th class="text-right" width="5%">Action</th>

                </tr>
                </thead>
                <tbody id="users-table">

                    @forelse ($applicants as $number => $applicant)
                        <tr>
                            <td>
                                {{$applicants->firstItem() + $number}}
                            </td>
                            <td>
                                @if($applicant->research->student->program != null)
                                    {{$applicant->research->student->program->code}}.{{$applicant->research->student->student_number}}
                                @endif
                                <br>
                                {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                            </td>
                            <td>
                                <b>{{$applicant->research->research_code}}</b>
                                <br>
                                {{$applicant->research->title}}
                            </td>
                            <td class="text-center">
                                @if($applicant->research->supervisor != null)
                                    @forelse ($applicant->research->supervisor as $supervisor)

                                        @foreach($rooms as $room)
                                            @if($room->examiner->contains('examiner_id', $supervisor->supervisor_id))
                                                <i class="fa fa-xs fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            @endif
                                        @endforeach
                                        {{$supervisor->faculty->code}}
                                        <br>
                                    @empty
                                    @endforelse
                                @endif
                            </td>

                            
                            <td class="text-center">
                                @if($applicant->room != null)
                                    @foreach($applicant->room as $room)
                                        <button wire:click="selectRoom({{ $applicant->id }}, {{$room->id}})" class="btn btn-sm">
                                            @if($room->id == $applicant->room_id)
                                                <i class="fa fa-xs fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            @endif
                                            <u>{{$room->room_code}}</u> | {{$room->applicant->count()}} -
                                            @foreach($room->moderator as $moderator)
                                                {{$moderator->faculty->code}}
                                                <br>
                                            @endforeach
                                        </button>
                                        <br>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-right">
                                <button wire:click = "$emit('eventChangeScheduleComponent', {{$applicant->id}}, 'Seminar')" class="btn btn-sm"><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan = "6">
                            No data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{$applicants->links()}}
    </div>
    @livewire('arsys::event.admin.seminar.add-room')
    @livewire('arsys::event.admin.seminar.edit-room-space')
    @livewire('arsys::event.admin.seminar.edit-room-session')
    @livewire('arsys::event.admin.seminar.print-schedule')
    @livewire('arsys::event.admin.seminar.add-examiner')
    @livewire('arsys::event.admin.seminar.add-moderator')
    @livewire('arsys::event.admin.change-applicant')
    @livewire('arsys::event.admin.common.letter-number')
    @livewire('arsys::event.admin.common.letter-time')
    @include('arsys::livewire.sweetalert.error-alert')
    @include('arsys::livewire.sweetalert.success-alert')
</div>


