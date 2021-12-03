<div>

    <div class="my-2 row">
        <div class="text-left col-sm-10">

            <button wire:click = "$emit('seminarAddRoomComponent', {{$event->id}})" class="btn btn-sm btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i> Add Room</button>
            <button wire:click="publish" class="btn btn-sm btn-primary"><i class="fa fa-globe"></i> Publish</button>
            <button wire:click = "sortUpApplicant" class="btn btn-sm btn-primary"><i class="fa fa-sort" aria-hidden="true"> </i> Sort</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2 offset-md-0">
            <b>Event Code</b>
        </div>
        <div class="col-md-8 offset-md-0">
            {{$event->event_id}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 offset-md-0">
            <b>Event Description</b>
        </div>
        <div class="col-md-8 offset-md-0">
            {{$event->type->description}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 offset-md-0">
            <b>Letter Number</b>
        </div>
        <div class="col-md-8 offset-md-0">
            @if($event->letter != null)
                @foreach($event->letter as $letter)
                    {{$letter->number}} - {{$letter->program->description}}
                    <br>
                @endforeach
            @endif
            <a class="btn btn-sm" wire:click="addLetterNumber"><i class="fa fa-envelope" style="color:green" aria-hidden="true"></i> Add</a>

        </div>
    </div>
    <br>
    @if($rooms->isNotEmpty())
        <div class="row">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="10%">Code</th>
                        <th width="15%">Schedule</th>
                        <th width="15%">Moderator</th>
                        <th width="30%">Participant</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="users-table">

                        @foreach($rooms as $room)
                            <tr>

                                <td>
                                    {{$room->room_code}}
                                </td>
                                <td>
                                    {{$room->session->time}}
                                    <br>
                                    <br>
                                    {{$room->space->space}}
                                    <br>
                                    {{$room->space->passcode}}
                                </td>

                                <td>
                                    <b>Moderator</b>
                                    <br>
                                    {{$room->moderator->first_name}} {{$room->moderator->last_name}}
                                    <br>
                                    <br>
                                    <b>Examiner</b><br>
                                    <button wire:click="$emit('addSeminarExaminerComponent', {{$room->id}})" class="btn btn-xs">
                                        <i class="fa fa-xs fa-check-circle" style="color:green" aria-hidden="true"></i>
                                         Add
                                    </button>

                                </td>

                                <td>
                                    @foreach($room->applicant as $applicant)
                                        {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                        <br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <hr>
    <br>
    <div class="row">
        <div class="table-responsive users-table">
            <table class="table table-striped table-sm data-table">
                <thead class="thead">
                <tr>
                    <th width="25%">Student</th>
                    <th width="45%">Research</th>
                    <th class="text-center" width="10%">SPV</th>
                    <th class="text-center" width="10%">EXA</th>
                    <th class="text-right" width="10%">Room</th>

                </tr>
                </thead>
                <tbody id="users-table">

                    @forelse ($applicants as $applicant)
                        <tr>
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
                                        {{$supervisor->faculty->code}}
                                        <br>
                                    @empty
                                    @endforelse
                                @endif
                            </td>

                            <td class="text-center">
                                @if($applicant->previous != null)
                                    @foreach ($applicant->previous->examiner as $examiner)
                                        @if($examiner->presence != null)
                                            {{$examiner->faculty->code}}
                                            <br>
                                        @endif
                                    @endforeach
                                @endif
                            </td>

                            <td class="text-right">
                                @if($applicant->room != null)
                                    @foreach($applicant->room as $room)
                                        <button wire:click="selectRoom({{ $applicant->id }}, {{$room->id}})" class="btn btn-sm">
                                            @if($room->id === $applicant->room_id)
                                                <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            @endif
                                            <u>{{$room->room_code}}</u>
                                        </button>
                                        <br>
                                    @endforeach
                                @endif
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
    @livewire('arsys::event.admin.seminar.add-examiner')

</div>


