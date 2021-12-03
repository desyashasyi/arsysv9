<div>

    <div class="col-md-3 offset-md-0">
        <input wire:model="search" type="text" class="my-3 form-control" placeholder="Search student name">
    </div>


    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th width="100%" class="text-center">Research Data</th>

            </tr>
            </thead>
            <tbody id="users-table">
                    @forelse ($students as $student)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-4 offset-md-0">
                                        <div class="card">
                                            <div class="text-white card-header bg-info">
                                                @if (($student->program != null) && ($student->student_number != null))
                                                    <i>{{$student->program->code}}.{{$student->student_number}}</i>
                                                    <br>
                                                    {{$student->specialization->description}} {{$student->program->abbrev}}
                                                    <br>
                                                @endif
                                                <b>{{$student->first_name}}
                                                {{$student->last_name}}</b>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8 offset-md-0">
                                        @foreach($student->research as $research)
                                        @if($research->research_mileston == 1 || $research->research_milestone == 2 || $research->research_milestone == 3)
                                            <div class='row'>
                                                <div class="col-md-12 offset-md-0">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 offset-md-0">
                                                                        @if($research->milestone != null || $research->milestoneseminar != null)
                                                                            @if($research->type->research_model == 'defense')
                                                                                <b>{{$research->milestone->milestone}}</b>
                                                                            @elseif($research->type->research_model == 'seminar')
                                                                                <b>{{$research->milestoneseminar->milestone}}</b>
                                                                            @endif
                                                                            {{$research->type->description}} {{$student->program->description}}
                                                                            <br>
                                                                            Status:
                                                                            @if($research->type->research_model == 'defense')
                                                                                <i>{{$research->milestone->description}}</i>
                                                                            @elseif($research->type->research_model == 'seminar')
                                                                                <i>{{$research->milestoneseminar->description}}</i>
                                                                            @endif
                                                                            @foreach ($research->proposalFile as $file)
                                                                                |
                                                                                @if ($research->proposalFile != null)
                                                                                    File: <a class="text-white" href="{{url('/')}}{{ Storage::disk('local')->url($file->filename)}}" target="blank">{{$research->research_code}}</a>
                                                                                @else
                                                                                    {{$research->research_code}} here
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                        <b>Completed</b> | The student already graduated
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-1 offset-md-0">
                                                                        &nbsp;
                                                                    </div>
                                                                    <div class="col-md-11 offset-md-0">
                                                                        {{$research->title}}
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                No data
                            </td>
                        </tr>
                    @endforelse
            </tbody>
        </table>
    </div>
    {{$students->links()}}

</div>

