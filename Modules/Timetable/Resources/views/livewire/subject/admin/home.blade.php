<div>
    <div>
        @livewire('timetable::subject.admin.import')
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
                <button wire:click="$emit('subjectImporterAdmin')" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Import</button>
            </div>
        </div>
    </div>
    <hr>
    <div>
        @if($programId != null)
            @if($subject != null)
                <div class="row">
                    <div class="col-md-2 offset-md-0">
                        <b>Study Program</b>
                    </div>
                    <div class="col-md-4 offset-md-0">
                        :
                            {{$subject->program->description}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 offset-md-0">
                        <b>Curriculum</b>
                    </div>
                    <div class="col-md-4 offset-md-0">
                        :
                       
                    </div>
                </div>
            @else
                There is no subject
            @endif
        @else
            <i class="text-danger">Please select program of study to show the curriculum</i>
        @endif

    </div>
    <br>
    <div>
    @if($subject != null)
        @if($subjects != null)
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="5%">
                            No
                        </th>
                        <th class="text-center" width="10%">
                            <button type="button" wire:click.prevent="sort('code')" class="btn btn-xs" >
                                <i class="fa fa-sort"></i>
                            </button>
                            Code
                        </th>
                        <th class="text-center" width="10%">
                            Credit
                        </th>
                        <th class="text-center" width="10%">Semester</th>
                        <th width="45%">
                            <button type="button" wire:click.prevent="sort('name')" class="btn btn-xs" >
                                <i class="fa fa-sort"></i>
                            </button>
                            Subject
                        </th>
                        <th class="text-center" width="10%">Specialization</th>
                        <th  width="10%">action</th>
                    </tr>
                    </thead>
                    <tbody id="users-table">
                        @php($number = null)
                        @foreach($subjects as $subject)
                            <tr>
                                <td>
                                    {{++$number}}
                                </td>
                                <td>
                                    {{$subject->code}}
                                </td>
                                <td class="text-center">
                                    {{$subject->credit}}
                                </td>
                                <td class="text-center">
                                    {{$subject->semester}}
                                </td>
                                <td>
                                    {{$subject->name}}
                                  
                                </td>
                                <td class="text-center">
                                    @if($subject->specialization_id != null)
                                        {{$subject->specialization->code}}
                                    @endif
                                </td>
                                <td>
                                    <button type="button" wire:click.prevent="$emit('editSubject',{{$subject->id}})" class="btn btn-sm" >
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$subjects->links()}}
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
