<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="eventAdminSeminarPrintScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventAdminSeminarPrintScheduleModal">Schedule of Seminar</h5>
                    <button type="button" wire:click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    @if($event)
                        @foreach($rooms as $number => $room)
                            <div class="row">
                                <div class="table-responsive users-table">
                                    <table class="table table-striped table-sm data-table">
                                        <thead class="thead">
                                            <tr>
                                                <th width="2%">No</th>
                                                <th width="8%">Code</th>
                                                <th width="20%">Schedule</th>
                                                <th width="35%">Examiners</th>
                                                <th text-align="right" width="35%">Participants</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users-table">
                                            <tr>
                                                <td>
                                                    {{$rooms->firstItem() + $number}}
                                                </td>
                                                <td>
                                                    {{$room->room_code}}
                                                </td>
                                                <td>
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
                                                        {{$room->space->space}}
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
                                                    <b>Examiner</b>
                                                    <br>
                                                    @foreach($room->examiner as $examiner)
                                                        {{$examiner->faculty->front_title}}
                                                        {{$examiner->faculty->first_name}}
                                                        {{$examiner->faculty->last_name}},
                                                        {{$examiner->faculty->rear_title}}
                                                        <br>
                                                    @endforeach

                                                </td>
                                                <td text-align="right">
                                                    @foreach($room->applicant as $applicant)
                                                        {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                                        @if($applicant->mark)
                                                            <sup>{{$applicant->mark->sign}}</sup>
                                                        @endif
                                                        <br>
                                                    @endforeach
                                                    <hr>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if($rooms)
                        {{$rooms->render()}}
                    @endif
                </div>
                <div class="modal-footer">
                </div>
        </div>
        </div>
    </div>
</div>

