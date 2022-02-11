

<div>
    @php(\Carbon\Carbon::setLocale('id'))
    <div>
        @livewire('timetable::schedule.admin.import')
        @livewire('timetable::schedule.admin.schedule-edit')
        @livewire('timetable::schedule.admin.siak-input')
    </div>
    <div>
        <div wire:ignore class="row">
            <div class="col-md-4 offset-md-0">
                <div class="form-group">
                    <select class="study_program" id='programStudy' style='width: 360px;' name="study_program">
                    </select>
                    @error('study_program') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>



            <div class="text-right col-sm-8">
                <b>Semester:</b>
                <button wire:click="semesterAll" class="btn btn-sm btn-info"> All</button>
                <button wire:click="semesterOdd" class="btn btn-sm btn-info"> Odd</button>
                <button wire:click="semesterEven" class="btn btn-sm btn-info"> Event</button>
                <button wire:click="$emit('FETTimetableImporterAdmin')" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Import</button>
            </div>
        </div>
    </div>
    <hr>
    <div>
        @if($programId != null)
            @if($schedule != null)
                <div class="row">
                    <div class="col-md-2 offset-md-0">
                        <b>Study Program</b>
                    </div>
                    <div class="col-md-4 offset-md-0">
                            {{$schedule->program->description}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 offset-md-0">
                        <b>Curriculum</b>
                    </div>
                    <div class="col-md-4 offset-md-0">
                        {{$schedule->desc->year}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 offset-md-0">
                        <b>Letter Number</b>
                    </div>
                    <div class="col-md-10 offset-md-0">
                        @if($schedule->assignmentletter != null)
                            {{$schedule->assignmentletter->number}}
                        @endif
                        @if ($addEditLetterNumberFlag == true)

                            <input style="width: 100px;" wire:model="letterNumber" type="text" class="form-control" placeholder="000">
                                @error('letterNumber') <span class="text-danger">{{ $message }}</span>@enderror
                                <br>
                                <button wire:click="saveLetterNumber({{$schedule->program_id}},{{$schedule->year_id}})" class="btn btn-xs"><i style="color:green" class="fas fa-arrow-circle-up"></i>
                                    Save
                                </button>
                        @else
                            @if($schedule->assignmentletter != null)
                                <u>
                                    <button wire:click="addEditLetterNumber" class="btn btn-xs"><i style="color:green" class="fas fa-plus-circle"></i>
                                        Edit
                                    </button>
                                </u>
                            @else
                                <u>
                                    <button wire:click="addEditLetterNumber" class="btn btn-xs"><i style="color:green" class="fas fa-plus-circle"></i>
                                        Add
                                    </button>
                                </u>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="text-right col-md-12 offset-md-0">
                        <button wire:click="$emit('adminScheduleSIAKInput', {{$schedule->program_id}},{{$schedule->year_id}})" class="btn btn-sm btn-primary"><i class="fas fa-arrow-up-circle"></i>
                            Entry SIAK Data
                        </button>
                            <button wire:click="printAssignmentLetter({{$schedule->program_id}}, {{$schedule->year_id}})" class="btn btn-sm btn-primary"><i class="fas fa-print"></i>
                                Print Assignment Letter
                            </button>

                        <button wire:click="setProgramId({{$schedule->program_id}},{{$schedule->year_id}})" class="btn btn-sm btn-primary"><i class="fas fa-arrow-up-circle"></i>
                            Set Program ID
                        </button>

                    </div>
                </div>


            @else
                There is no schedule
            @endif
        @else
            <i class="text-danger">Please select program of study to show the schedule</i>
        @endif

    </div>
    <br>
    <div>
    @if($schedule != null)
        @if($schedules != null)
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="2%">
                            No
                        </th>
                        <th class="text-center" width="10%">
                            <button type="button" wire:click.prevent="sortSchedule('subject_id')" class="btn btn-xs" >
                                <i class="fa fa-sort"></i>
                            </button>
                            Code
                        </th>
                        <th class="text-center" width="10%">
                            Teacher
                        </th>
                        <th width="20%">
                            Subject
                        </th>
                        <th class="text-center" width="5%">
                            Credit
                        </th>
                        <th class="text-center" width="10%">
                            Student
                        </th>
                        <th class="text-left" width="10%">
                            Room
                        </th>
                        <th class="text-left" width="15%">
                            Day-Time
                        </th>

                        
                        <th class="text-center" width="10%">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody id="users-table">
                        @php($number = null)
                        @foreach($schedules as $schedule)
                            <tr>
                                <td>
                                    {{++$number}}
                                </td>
                                <td class="text-left">
                                        
                                        @if($schedule->subject != null)
                                            @if($schedule->siak_status)
                                            <a wire:click="adminScheduleStatusCheck({{$schedule->id}})" class="btn btn-sm"><i style="color:green" class="fas fa-check-circle"></i>
                                                    <i style="color:green" class="fas fa-check-circle"></i></a>
                                            @else
                                                <a wire:click="adminScheduleStatusCheck({{$schedule->id}})" class="btn btn-sm"><i style="color:green" class="fas fa-check-circle"></i>
                                                <i style="color:gray" class="fas fa-check-circle"></i> </a>
                                            @endif
                                            {{$schedule->subject->code}}
                                        @endif
                                       
                                    </div>
                                </td>
                                <td class="text-center">
                                    @foreach($schedule->teams as $team)
                                    {{$team->faculty->upi_code}}-{{$team->faculty->code}}<br>
                                    @endforeach
                                    </div>
                                </td>
                                <td class="text-left">
                                    @if($schedule->subject != null)
                                        {{$schedule->subject->name}}
                                        @if($schedule->activitytags->isNotEmpty())
                                            <hr>
                                            <b>Tags:</b>
                                            @foreach($schedule->activitytags as $tag)
                                                {{$tag->tag->description}} &nbsp;
                                            @endforeach
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($schedule->subject != null)
                                        {{$schedule->subject->credit}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    
                                    @if($schedule->studentsets != null)
                                        @foreach($schedule->studentsets as $student)
                                            {{$student->student->code}}<br>
                                        @endforeach
                                    @endif
                                    
                                </td>
                                <td class="text-left">
                                    @if($schedule->room != null)
                                        {{$schedule->room->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($schedule->daytime != null)
                                        {{ \Carbon\Carbon::parse($schedule->daytime)->translatedformat('l') }}<br>
                                        {{ \Carbon\Carbon::parse($schedule->daytime)->format('H:i') }} -
                                        @if($schedule->subject != null)
                                            @if($schedule->activitytags->contains('tag_id', \Modules\Timetable\Entities\Tags::where('code', 'PRA')->first()->id))
                                                {{ \Carbon\Carbon::parse($schedule->daytime)->addMinute(8*50)->format('H:i') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($schedule->daytime)->addMinute($schedule->subject->credit*50)->format('H:i') }}
                                            @endif
                                        @endif
                                    @endif
                                </td>

                                

                                <td class="text-center">
                                    <button wire:click="$emit('editSchedule_Admin', {{$schedule->id}})" class="btn btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    @if($schedule->siak_status)
                                        <button wire:click="complete({{$schedule->id}})" class="btn btn-sm"><i style="color:green" class="fas fa-check-circle"></i>
                                    @else
                                        <button wire:click="complete({{$schedule->id}})" class="btn btn-sm"><i style="color:read" class="fas fa-check-circle"></i>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$schedules->render()}}
            </div>
        @endif
    @endif
    </div>
        <script>
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function(){
                $( "#programStudy" ).select2({
                    placeholder: "Select study program",
                    allowClear: true,
                    ajax: {
                        url: "{{route('timetable.data.study-program')}}",
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
            });
        </script>
</div>
