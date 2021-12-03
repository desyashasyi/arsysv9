<div>
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

    @if($rooms->isNotEmpty())
        <div class="row">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%">Code</th>
                        <th width="10%">Mod</th>
                        <th width="35%">Examiner</th>
                        <th width="30%">Participant</th>
                        <th class="text-center" width="15%">Schedule</th>
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
                                            <u>{{$moderator->faculty->code}}</u>
                                        <br>
                                        @endforeach
                                    @endif

                                </td>
                                <td>
                                    @if($room->examiner)
                                        @foreach($room->examiner as $examiner)
                                                <u>{{$examiner->faculty->first_name}} <u>{{$examiner->faculty->last_name}}</u>
                                            <br>
                                        @endforeach
                                    @endif

                                </td>

                                <td>
                                    @foreach($room->applicant as $applicant)
                                        @if($applicant->research->student->program_id== Auth::user()->faculty->program_id)
                                            <b>
                                            {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                            </b>
                                        @else
                                            {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                        @endif
                                        <br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                        <u>
                                            @if($room->space)
                                                {{$room->space->description}} Meeting
                                            @else
                                                Null
                                            @endif
                                        </u>
                                    <br>
                                        <u>
                                            @if($room->session)
                                                {{$room->session->time}}
                                            @else
                                                Null
                                            @endif
                                        </u>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$rooms->render()}}
            </div>
        </div>
    @endif
</div>
