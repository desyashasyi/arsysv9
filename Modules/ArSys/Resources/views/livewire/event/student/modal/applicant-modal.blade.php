<!-- Modal -->
<div wire:ignore.self class="modal fade" id="studentEventApplicantModal" tabindex="-1" role="dialog" aria-labelledby="studentEventApplicantModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentEventApplicantModal">
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
                @if($applicants != null)
                <div class="row">
                    <div class="table-responsive users-table">
                        <table class="table table-striped table-sm data-table">
                            <thead class="thead">
                            <tr>
                                <th width="25%">Student</th>
                                <th width="35%">Research</th>
                                <th class="text-center" width="10%">SPV(s)</th>
                                <th class="text-center" width="10%">EX(s)</th>
                                <th class="text-center" width="25%">Schedule</th>
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
                                            @if($event->status == 1)
                                                @if($applicant->examiner != null)
                                                    @foreach ($applicant->examiner as $examiner)
                                                        {{$examiner->faculty->code}}
                                                        <br>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($event->status == 1)
                                                @if($applicant->session != null)
                                                    {{$applicant->session->time}}
                                                @endif
                                                <br>
                                                @if ($applicant->space != null)
                                                    {{$applicant->space->space}}-{{$applicant->space->passcode}}
                                                @endif
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
                @endif

                @if($applicants != null)
                    {{$applicants->links()}}
                @endif
            </div>
            <div class="modal-footer">
            </div>

       </div>
    </div>
</div>
