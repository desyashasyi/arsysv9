<div>
    @forelse($events as $event)
    <div class="row">
        <div class="col-md-12 offset-md-0">
            {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('l,') }}
            {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
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
                </tr>
                </thead>
                <tbody id="users-table">
                    @php($number = 0)
                    @forelse($event->applicant as $applicant)
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
                            </td>
                            <td>
                                <b>Session:</b>
                                <br>
                                {{$applicant->session->time}}
                                <br>
                                <b>Media:</b>
                                <br>

                                @if($applicant->space->passcode != '')
                                    ID: {{$applicant->space->space}}
                                    <br>
                                    Pass: {{$applicant->space->passcode}}
                                @else
                                    Dikelola pembimbing
                                @endif
                            </td>
                            <td >
                                @foreach($applicant->supervisor as $supervisor)
                                    {{$supervisor->faculty->code}}
                                    <br>
                                @endforeach
                            </td>
                            <td>
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
                            </td>
                        </tr>
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
    @empty
        There is no applicant
    @endforelse
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
