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
                                        @if($research->status == 2)
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
                                                                                <i>{{$research->milestoneseminar->description}}</i>
                                                                            @endif
                                                                            |
                                                                            @foreach ($research->proposalFile as $file)
                                                                                @if ($research->proposalFile != null)
                                                                                    File: <a class="text-white" href="{{url('/')}}{{ Storage::disk('local')->url($file->filename)}}" target="blank">{{$research->research_code}}</a>
                                                                                @else
                                                                                    {{$research->research_code}}
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

                                                                        <hr>
                                                                        <b>Decision</b>
                                                                        <br>
                                                                        <button wire:click="reject({{$research->id}})" class="btn btn-xs btn-danger">Reject</button>
                                                                        <button wire:click="presentation({{$research->id}})" class="btn btn-xs btn-primary">Presentation</button>
                                                                        <button wire:click="approve({{$research->id}})" class="btn btn-xs btn-success">Approve</button>
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
                                                                            class="btn btn-info btn-xs">Assign Supervisor</button>

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

