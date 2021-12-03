<div>
    @if($events->isNotEmpty())
        <div class="row">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th width="2%">No</th>
                            <th width="20%">Date</th>
                            <th width="68%">Event</th>
                            <th class="text-right" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="users-table">
                        @php($number = 0)
                        @foreach($events as $event)
                            <tr>
                                <td>
                                    {{++$number}}.
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                                </td>
                                <td>
                                    {{$event->type->description}} - {{\Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                                </td>
                                <td class="text-right">
                                    @php($program_id = null)
                                    @foreach($event->finaldefenseassignmentletter as $assignment)
                                        @foreach($event->applicant as $applicant)
                                            @if($applicant->supervisor->contains('supervisor_id', Auth::user()->faculty->id))
                                                @if($assignment->program_id == $applicant->research->student->program_id)

                                                    @if($program_id != $assignment->program_id)
                                                        <a class="btn btn-sm" href="{{url('/')}}{{ Storage::disk('local')->url($assignment->filename)}}" target="blank"><i class="fa fa-print" aria-hidden="true"></i>
                                                            {{$assignment->program->code}}
                                                        </a>
                                                        <br>
                                                        @php($program_id = $assignment->program_id)
                                                    @endif
                                                @endif
                                            @endif
                                            @if($applicant->previous->examiner->contains('examiner_id', Auth::user()->faculty->id))
                                                @foreach($applicant->previous->examiner as $examiner)
                                                    @if($examiner->examiner_id == Auth::user()->faculty->id)
                                                        @if(\Carbon\Carbon::parse($event->event_date)->gte(\Carbon\Carbon::parse(\Carbon\Carbon::createFromFormat('d/m/Y',  '01/04/2021'))))
                                                            @if($examiner->presence != null)
                                                                @if($assignment->program_id == $applicant->research->student->program_id)
                                                                    @if($program_id != $assignment->program_id)
                                                                        <a class="btn btn-sm" href="{{url('/')}}{{ Storage::disk('local')->url($assignment->filename)}}" target="blank"><i class="fa fa-print" aria-hidden="true"></i>
                                                                            {{$assignment->program->code}}
                                                                        </a>
                                                                        <br>
                                                                        @php($program_id = $assignment->program_id)
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if($assignment->program_id == $applicant->research->student->program_id)
                                                                @if($program_id != $assignment->program_id)
                                                                    <a class="btn btn-sm" href="{{url('/')}}{{ Storage::disk('local')->url($assignment->filename)}}" target="blank"><i class="fa fa-print" aria-hidden="true"></i>
                                                                        {{$assignment->program->code}}
                                                                    </a>
                                                                    <br>
                                                                    @php($program_id = $assignment->program_id)
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @else
                                                    @endif
                                                @endforeach
                                            @endif

                                        @endforeach
                                    @endforeach

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        No data
    @endif
</div>
