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
                                            <div class="card-body">
                                                @if (($student->program != null) && ($student->student_number != null))
                                                    <i>{{$student->program->code}}.{{$student->student_number}}</i>
                                                    <br>
                                                    {{$student->specialization->description}}
                                                    <br>
                                                @endif
                                                <b>{{$student->first_name}}
                                                {{$student->last_name}}</b>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8 offset-md-0">
                                        @foreach($student->research as $research)
                                        @if($research->research_milestone == 17 || $research->research_milestone == 10)
                                            <div class='row'>
                                                <div class="col-md-12 offset-md-0">
                                                        <div class="card">

                                                            <div class="text-white card-header bg-secondary">
                                                                <div class="row">
                                                                    <div class="col-md-12 offset-md-0">
                                                                        @if($research->milestone != null || $research->milestoneseminar != null)
                                                                            @if($research->type->research_model == 'defense')
                                                                                <b>{{$research->milestone->milestone}}</b>
                                                                            @elseif($research->type->research_model == 'seminar')
                                                                                <b>{{$research->milestoneseminar->milestone}}</b>
                                                                            @endif
                                                                            |
                                                                            @if($research->type->research_model == 'defense')
                                                                                <i>{{$research->milestone->description}}</i>
                                                                            @elseif($research->type->research_model == 'seminar')
                                                                                @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'PI')->first()->id)
                                                                                    <i>{{$research->milestoneseminar->description_pi}}</i>
                                                                                @endif
                                                                                @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'SE')->first()->id)
                                                                                    <i>{{$research->milestoneseminar->description}}</i>
                                                                                @endif
                                                                            @endif
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
                                                            <div class=card-body>

                                                                @if($alertResearchId != null)
                                                                    @if($alertResearchId == $research->id)
                                                                        <div class="row">
                                                                            <div class="col-md-12 offset-md-0">
                                                                                @if ($message = Session::get('success'))
                                                                                    <div class="alert alert-success alert-block">
                                                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @endif

                                                                                @if ($message = Session::get('error'))
                                                                                    <div class="alert alert-danger alert-block">
                                                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                    {{ $message }}
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                                <div class="row">

                                                                    <div class="col-md-12 offset-md-0">
                                                                        <b>Supervisor of Student's Research</b>
                                                                        <br>
                                                                        @php($counter = 0)
                                                                        @forelse($research->supervisor as $supervisor)
                                                                            {{++$counter}}. {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}&nbsp; &nbsp;
                                                                             <br>
                                                                        @empty
                                                                            <i>The research supervisor should be assigned</i>
                                                                            <br>
                                                                        @endforelse

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

