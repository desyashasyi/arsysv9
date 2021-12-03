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
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-4 offset-md-0">
                                        <div class="card">
                                            <div class="card-body">
                                                @if (($student->program != null) && ($student->student_number != null))
                                                    <i>{{$student->program->code}}.{{$student->student_number}}</i>
                                                    <br>
                                                    {{$student->specialization->description}} {{$student->program->abbrev}}
                                                    <br>
                                                @endif
                                                <b>{{$student->first_name}} {{$student->last_name}}</b>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8 offset-md-0">
                                        @foreach($student->research as $research)
                                            @if($research->research_type != \Modules\ArSys\Entities\ResearchType::where('code', 'PI')->first()->id
                                                &&
                                                $research->supervisor->isEmpty()
                                                &&
                                                ($research->research_milestone == 4)
                                                )
                                            <div class='row'>
                                                <div class="col-md-12 offset-md-0">
                                                        <div class="card">

                                                            <div class="text-white card-header bg-info">
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
                                                                                @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'PI')->first()->id)
                                                                                    <i>{{$research->milestoneseminar->description_pi}}</i>
                                                                                @endif
                                                                                @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'SE')->first()->id)
                                                                                    <i>{{$research->milestoneseminar->description}}</i>
                                                                                @endif
                                                                            @endif
                                                                            |
                                                                            @forelse ($research->proposalFile as $file)

                                                                                @if ($research->proposalFile != null)
                                                                                    File: <a class="text-white" href="{{url('/')}}{{ Storage::disk('local')->url($file->filename)}}" target="blank">{{$research->research_code}}</a>
                                                                                @else
                                                                                    {{$research->research_code}}
                                                                                @endif
                                                                            @empty
                                                                                {{$research->research_code}} (file missing)
                                                                            @endforelse
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
                                                                        <b class="text-black">{{$research->title}}</b>
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
                                                                        @forelse($research->supervisortemp as $supervisor)
                                                                            {{++$counter}}. {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}&nbsp; &nbsp;
                                                                            |
                                                                            @if($supervisor->file != null)
                                                                                <a href="{{url('/')}}{{ Storage::disk('local')->url($supervisor->file)}}" target="blank">File</a>
                                                                            @endif
                                                                            <br>
                                                                        @endforeach
                                                                        <hr>
                                                                        @php($counter = 0)
                                                                        @forelse($research->supervisordummy as $supervisor)
                                                                            {{++$counter}}. {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}&nbsp; &nbsp;
                                                                             <br>
                                                                        @empty
                                                                            <i>The research supervisor should be assigned</i>
                                                                            <br>
                                                                        @endforelse

                                                                        <hr>
                                                                        <!--<button data-toggle="modal" data-target="#setSupervisor" wire:click="setSupervisor({{ $research->id }})"
                                                                            class="btn btn-primary btn-xs"><i class="fa fa-user-plus" aria-hidden="true"></i> Assign</button>
                                                                        -->
                                                                        <button class="btn btn-primary btn-xs" wire:click="$emit('emiterReviewSetSupervisor', {{$research->id}})"><i class="fa fa-user-plus" aria-hidden="true"></i> Assign</button>
                                                                        </button>

                                                                        <button wire:click="approve({{$research->id}})" class="btn btn-xs btn-success">Set Supervisor</button>


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
                    @endforeach
            </tbody>
        </table>
    </div>
    {{$students->links()}}
    @livewire('arsys::review.specialization.set-supervisor')
</div>

