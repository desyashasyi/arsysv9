<!-- Modal -->
<div wire:ignore.self class="modal fade" id="eventSeminarApplicantModal_Student" tabindex="-1" role="dialog" aria-labelledby="eventSeminarApplicantModal_Student" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventSeminarApplicantModal_Student">
                    Applicant of
                    @if($event != null)
                        {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('d-m-Y') }}
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if($event != null)
                    @foreach($event->room as $room)
                        @if($room->applicant->contains('research_id', $researchId))
                            <div class="row">
                                <div class="table-responsive users-table">
                                    <table class="table table-striped table-sm data-table">
                                        <thead class="thead">
                                            <tr>
                                                <th width="10%">Code</th>
                                                <th width="20%">Schedule</th>
                                                <th width="35%">Examiners</th>
                                                <th width="30%">Participants</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users-table">
                                            <tr>
                                            <td>
                                                {{$room->room_code}}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                                                <br>
                                                {{$room->session->time}}
                                                <br>
                                                <br>
                                                <b>Meeting ID</b>
                                                <br>
                                                {{$room->space->space}}
                                                <br>
                                                <b>Passcode</b>
                                                <br>
                                                {{$room->space->passcode}}
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
                                                <br>
                                                <b>Examiner</b><br>
                                                @foreach($room->examiner as $examiner)
                                                    {{$examiner->faculty->front_title}}
                                                    {{$examiner->faculty->first_name}}
                                                    {{$examiner->faculty->last_name}},
                                                    {{$examiner->faculty->rear_title}}
                                                    <br>
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach($room->applicant as $number => $applicant)
                                                    {{++$number}}. {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                                    <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        @endif
                    @endforeach
                @endif

            </div>
            <div class="modal-footer">
            </div>

       </div>
    </div>
</div>
