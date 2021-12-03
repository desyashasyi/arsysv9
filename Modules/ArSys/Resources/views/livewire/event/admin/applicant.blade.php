<div>

    <div class="my-2 row">
        <div class="text-left col-sm-10">

            <button wire:click="publish" class="btn btn-sm btn-primary"><i class="fa fa-globe"></i> Publish Setting</button>
            <button wire:click = "sortUpApplicant" class="btn btn-sm btn-primary"><i class="fa fa-sort" aria-hidden="true"> Sort</i></button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3 offset-md-0">
            <b>Event Code</b>
        </div>
        <div class="col-md-8 offset-md-0">
            : {{$event->event_id}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-0">
            <b>Event Description</b>
        </div>
        <div class="col-md-8 offset-md-0">
            : {{$event->type->description}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-0">
            <b>Number of applicant</b>
        </div>
        <div class="col-md-8 offset-md-0">
            : {{$event->applicant->count()}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 offset-md-0">
            <b>Letter Number</b>
        </div>
        <div class="col-md-8 offset-md-0">
            @if($event->letter != null)
                @foreach($event->letter as $letter)
                    : {{$letter->number}} - {{$letter->program->description}}
                    <br>
                @endforeach
            @endif
            <a class="btn btn-sm" wire:click="addLetterNumber"><i class="fa fa-envelope" style="color:green" aria-hidden="true"></i> Add</a>

        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive users-table">
            <table class="table table-striped table-sm data-table">
                <thead class="thead">
                <tr>
                    <th width="2%">No</th>
                    <th width="25%">Student</th>
                    <th width="28%">Research</th>
                    <th class="text-center" width="10%">SPV(s)</th>
                    <th class="text-center" width="10%">EX(s)</th>
                    <th class="text-center" width="25%">Schedule</th>
                    <th class="text-right" width="10%">Action</th>

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
                                        {{$supervisor->faculty->code}}
                                        <br>
                                    @empty
                                    @endforelse
                                @endif
                            </td>

                            <td class="text-center">

                                @if($applicant->examiner != null)

                                    @foreach ($applicant->examiner as $examiner)
                                        @if($examiner->event_id == $eventId)
                                            {{$examiner->faculty->code}}
                                            <br>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">
                                @if($applicant->session != null)
                                    {{$applicant->session->time}}
                                @endif
                                <br>
                                @if ($applicant->space != null)
                                    {{$applicant->space->space}}-{{$applicant->space->passcode}}
                                @endif
                            </td>

                            <td class="text-right">
                                <!--<button data-toggle="modal" data-target="#applicantDefenseSettingModal" wire:click = "applicantDefenseSetting({{$applicant->id}})" class="btn btn-md"><i class="fa fa-cog"></i></button>
                                -->
                                <button wire:click = "$emit('emiterEventAdminDefenseSetting', {{$applicant->id}})" class="btn btn-sm"><i class="fa fa-cogs"></i></button>
                                <button wire:click = "$emit('eventChangeScheduleComponent', {{$applicant->id}})" class="btn btn-sm"><i class="fa fa-cog"></i></button>
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
        {{$applicants->render()}}
        @livewire('arsys::event.admin.defense-setting')
        @include('arsys::livewire.event.admin.modal.add-letter-number-modal')
        @livewire('arsys::event.admin.change-applicant')

    </div>
    <script>
        window.livewire.on('eventFacultyApplicantAddLetterNumberModal', () => {
           $('#eventFacultyApplicantAddLetterNumberModal').modal('show');
       });

       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $( "#programStudy" ).select2({
                placeholder: "Select study program",
                allowClear: true,
                ajax: {
                    url: "{{route('arsys.data.study-program')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                        _token: CSRF_TOKEN,
                        search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                        results: response
                        };
                    },
                    cache: true
                }
            });

            $( "#programStudy" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#programStudy').select2("val");
                window.livewire.emit('selectStudyProgram', { studyProgramId : data });

            });

            window.addEventListener('resetSelection', event => {
            $("#programStudy").empty().trigger('opening')
        });
        });
   </script>
</div>


