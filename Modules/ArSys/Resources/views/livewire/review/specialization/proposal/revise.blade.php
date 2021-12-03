<div>

    @include('arsys::livewire.review.specialization.proposal.modal.set-supervisor')
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
                                        @if($research->status == \Modules\ArSys\Entities\ResearchDecisionType::where('code', 'RVS')->first()->id
                                            &&
                                            $research->research_type != \Modules\ArSys\Entities\ResearchType::where('code', 'PI')->first()->id
                                            &&
                                            ($research->research_milestone == \Modules\ArSys\Entities\ResearchMilestone::
                                            where(['milestone_model' => 'defense', 'milestone' => 'Proposal', 'phase' => 'Reviewed'])->first()->sequence
                                            ||
                                            $research->research_milestone == \Modules\ArSys\Entities\ResearchMilestone::
                                            where(['milestone_model' => 'seminar', 'milestone' => 'Proposal', 'phase' => 'Reviewed'])->first()->sequence)
                                            )
                                            <div class='row'>
                                                <div class="col-md-12 offset-md-0">
                                                        <div class="card">

                                                            <div class="text-white card-header bg-primary">
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
                                                                    <div class="col-md-6 offset-md-0">
                                                                        <b>Reviewer(s) of Student's Proposal</b>
                                                                        <br>

                                                                        @php($counter = 0)

                                                                        @forelse($research->proposalReview as $reviewer)
                                                                            @if($reviewer->faculty != null)
                                                                                {{++$counter}}. {{$reviewer->faculty->first_name}} {{$reviewer->faculty->last_name}}&nbsp; &nbsp;
                                                                                @if($reviewer->decision == '1')
                                                                                    <i class="fa fa-ban" style ="color:red" aria-hidden="true"></i>
                                                                                @elseif($reviewer->decision == 2)
                                                                                    <i class="fa fa-check-circle" style ="color:green" aria-hidden="true"></i>
                                                                                @elseif($reviewer->decision == 4)
                                                                                    <i class="fa fa-edit" style ="color:blue" aria-hidden="true"></i>
                                                                                @elseif($reviewer->decision == 3)
                                                                                    <i class="fa fa-desktop" style ="color:orange" aria-hidden="true"></i>
                                                                                @elseif($reviewer->decision == null)
                                                                                    <i class="fa fa-hourglass" style ="color:gray" aria-hidden="true"></i>
                                                                                @endif
                                                                                <br>
                                                                            @endif
                                                                        @empty
                                                                            <i>The proposal reviewer might be assigned</i>
                                                                            <br>
                                                                        @endforelse


                                                                    </div>
                                                                    <div class="col-md-6 offset-md-0">
                                                                        <b>Supervisor of Student's Research</b>
                                                                        <br>
                                                                        @php($counter = 0)
                                                                        @forelse($research->supervisordummy as $supervisor)
                                                                            {{++$counter}}. {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}&nbsp; &nbsp;
                                                                             <br>
                                                                        @empty
                                                                            <i>The research supervisor should be assigned</i>
                                                                            <br>
                                                                        @endforelse

                                                                        <hr>
                                                                        <button data-toggle="modal" data-target="#setSupervisor" wire:click="setSupervisor({{ $research->id }})"
                                                                            class="btn btn-primary btn-xs"><i class="fa fa-user-plus" aria-hidden="true"></i> Assign</button>
                                                                    </div>


                                                                </div>
                                                                <hr>
                                                                        <b>Decision</b>
                                                                        <br>
                                                                        <button wire:click="reject({{$research->id}})" class="btn btn-xs btn-danger">Reject</button>
                                                                        <button wire:click="presentation({{$research->id}})" class="btn btn-xs btn-primary">Presentation</button>
                                                                        <button wire:click="approve({{$research->id}})" class="btn btn-xs btn-success">Approve</button>

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

