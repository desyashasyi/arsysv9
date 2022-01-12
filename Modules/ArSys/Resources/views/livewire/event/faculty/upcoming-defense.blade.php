<div>
        @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PRE')->first()->id)
            <div class="row">
                <div class="col-md-12 offset-md-0">
                    <b><i>
                    {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('l,') }}
                    {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                    </i></b>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 offset-md-0">
                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead">
                        <tr>
                            <th width="2%">No</th>
                            <th width="20%">Student</th>
                            <th width="35%">Research</th>
                            <th width="18%">Schedule</th>
                            <th width="5%" >SPV</th>
                            <th width="10%" >EXA</th>
                            <th width="10%" class="text-center">Mark</th>
                        </tr>
                        </thead>
                        <tbody id="users-table">
                            @php($number = 0)
                            @forelse($event->applicant as $applicant)
                                @if($applicant->supervisor->contains('supervisor_id', Auth::user()->faculty->id)
                                    ||
                                    ($applicant->examiner->contains('examiner_id', Auth::user()->faculty->id)))

                                    <tr>
                                        <td>
                                            {{++$number}}
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
                                            <hr>
                                            @if(\Modules\ArSys\Entities\ArSysConfig::where('code', 'PRE_DEFENSE_REQUIREMENT')->first()->status)
                                                @if($applicant->research->draftthesisdoc)
                                                    <a href="{{url('/')}}{{ Storage::disk('local')->url($applicant->research->draftthesisdoc->filename)}}" target="blank">Draft of Thesis</a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <b>Session:</b>
                                            <br>
                                            {{$applicant->session->time}}
                                            <br>
                                            <b>Media:</b>
                                            <br>
                                            @if($applicant->space != null)
                                                @if($applicant->space->passcode != '')
                                                    ID: <a href="{{$applicant->space->link}}" target="_blank"><u>{{$applicant->space->space}}</u></a>
                                                    <br>
                                                    Pass: {{$applicant->space->passcode}}
                                                    <br>
                                                    @if($applicant->space != null)
                                                        Host-key: {{$applicant->space->host_key}}
                                                    @endif
                                                @else
                                                    Dikelola pembimbing
                                                @endif
                                            @endif

                                            <br>
                                            <a class="btn btn-xs btn-info" wire:click="preDefensePrintAssignment({{$applicant->id}})"><i class="fa fa-print" aria-hidden="true"></i>
                                                Print assignment
                                            </a>

                                        </td>
                                        <td >
                                            @foreach($applicant->supervisor as $supervisor)
                                                {{$supervisor->faculty->code}}
                                                <br>
                                            @endforeach
                                        </td>
                                        <td >
                                            @if($applicant->supervisor->contains('supervisor_id', Auth::user()->faculty->id))
                                                @foreach($applicant->examiner as $examiner)
                                                    @if($examiner->presence)
                                                        <a class="btn btn-sm" wire:click="setPresence({{$examiner->id}})"><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                                            {{$examiner->faculty->code}}
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm" wire:click="setPresence({{$examiner->id}})"><i class="fa fa-ban" style="color:red"  aria-hidden="true"></i>
                                                            {{$examiner->faculty->code}}
                                                        </a>
                                                    @endif
                                                    <br>
                                                @endforeach
                                                <a class="btn btn-sm btn-sucess" wire:click="$emit('defenseFacultyAddExaminer',{{$applicant->id}})"><i class="fa fa-user-plus" style="color:green" aria-hidden="true"></i>
                                                    Add
                                                </a>
                                            @endif
                                            @if($applicant->examiner->contains('examiner_id', Auth::user()->faculty->id))
                                                @foreach($applicant->examiner as $examiner)
                                                    @if($examiner->presence)
                                                        <a class="btn btn-sm"><i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                                            {{$examiner->faculty->code}}
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm"><i class="fa fa-ban" style="color:red"  aria-hidden="true"></i>
                                                            {{$examiner->faculty->code}}
                                                        </a>
                                                    @endif
                                                    <br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="text-center" wire:poll>
                                            @if($applicant->research->supervisor->contains('supervisor_id', Auth::user()->faculty->id))
                                                @foreach($applicant->research->supervisor as $supervisor)
                                                    @if($supervisor->supervisor_id == Auth::user()->faculty->id)

                                                        <a class="btn btn-sm" wire:click="$emit('defenseFacultySubmitSupervisorScore',{{$supervisor->id}}, {{$applicant->id}})"><i class="fa fa-edit" style="color:green"  aria-hidden="true"></i>
                                                            @if($supervisor->supervisorscore !=null )
                                                            @foreach($supervisor->supervisorscore as $score)
                                                                @if($score->event_id == $applicant->event_id)
                                                                    @if($score->mark != null)
                                                                        {{$score->mark}}
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            @else
                                                                NULL
                                                            @endif
                                                        </a>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if($applicant->examiner->contains('examiner_id', Auth::user()->faculty->id))
                                                @foreach($applicant->examiner as $examiner)
                                                    @if($examiner->examiner_id == Auth::user()->faculty->id)
                                                            @if($examiner->presence != null)
                                                                <a class="btn btn-sm" wire:click="$emit('defenseFacultySubmitExaminerScore',{{$examiner->id}})"><i class="fa fa-edit" style="color:green"  aria-hidden="true"></i>
                                                            @else
                                                                <a class="btn btn-sm" disable><i class="fa fa-edit" style="color:gray"  aria-hidden="true"></i>
                                                            @endif
                                                            @if($examiner->examinerscore != null)
                                                                {{$examiner->examinerscore->mark}}
                                                            @else
                                                                NULL
                                                            @endif
                                                        </a>
                                                    @endif
                                                @endforeach
                                            @endif
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
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    @livewire('arsys::defense.faculty.submit-score')
    @livewire('arsys::defense.faculty.add-examiner')
    @include('arsys::livewire.sweetalert.success-alert')

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            @this.on('removeExaminerPresence', presenceId => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'The examiner\'s presence will be removed!',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Remove!'
                }).then((result) => {
             //if user clicks on delete
                    if (result.value) {
                 // calling destroy method to delete
                        @this.call('removePresence',presenceId)
                 // success response
                    }
                });
            });
        })
    </script>
</div>
