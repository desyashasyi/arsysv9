<div>
    <div class="row">
        <div class="col-md-12 offset-md-0">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th width="2%">No</th>
                            <th width="17%">Event</th>
                            <th width="30%">Student</th>
                            <th width="35%">Research</th>
                            <th class="text-right" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="users-table">
                        @php($number = 0)
                        @forelse($events as $event)

                            @forelse($event->applicant as $applicant)
                                @if($applicant->supervisor->contains('supervisor_id', Auth::user()->faculty->id)
                                    ||
                                    ($applicant->examiner->contains('examiner_id', Auth::user()->faculty->id)))
                                    <tr>
                                        <td>
                                            {{++$number}}.
                                        </td>
                                        <td>
                                            {{$applicant->event->type->description}}
                                            <br>
                                            {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('l,') }}
                                            {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d F Y')}}
                                        </td>
                                        <td>
                                            {{$applicant->research->student->program->code}}.{{$applicant->research->student->student_number}}
                                            <br>
                                            {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                        </td>
                                        <td>
                                            {{$applicant->research->research_code}}
                                            <br>
                                            {{$applicant->research->title}}
                                        </td>
                                        <td class="text-right">
                                            @foreach($applicant->examiner as $examiner)
                                                @if($examiner->examiner_id == Auth::user()->faculty->id)
                                                    @if ($examiner->presence != null)
                                                        <a class="btn btn-xs btn-info" wire:click="printAssignment({{$applicant->id}})" target="blank"><i class="fa fa-print" aria-hidden="true"></i>
                                                            Print
                                                        </a>
                                                    @else
                                                        Not present
                                                    @endif
                                                    <br>
                                                @endif
                                            @endforeach
                                            @foreach($applicant->research->supervisor as $supervisor)
                                                @if($supervisor->supervisor_id == Auth::user()->faculty->id)
                                                    <a class="btn btn-xs btn-info" wire:click="printAssignment({{$applicant->id}})" target="blank"><i class="fa fa-print" aria-hidden="true"></i>
                                                        Print
                                                    </a>
                                                @endif
                                            @endforeach
                                        </td>

                                    </tr>
                                @endif
                        @empty
                            <tr>
                                <td colspan = "">
                                    No data
                                </td>
                            </tr>
                        @endforelse
                    @empty
                        There is no upcoming event
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
