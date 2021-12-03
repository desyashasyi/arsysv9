<div>

    @include('arsys::livewire.review.faculty.modal.remark-modal')
    <div class="col-md-3 offset-md-0">
        <input wire:model="search" type="text" class="my-3 form-control" placeholder="Search student name">
    </div>


    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th class="text-center" width="100%">Research Data</th>

            </tr>
            </thead>
            <tbody id="users-table">
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-12 offset-md-0">
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
                                        @php($counter = 0)
                                        @foreach($student->research as $research)
                                            @if($research->research_milestone == 3)
                                            @if(!$research->proposalReview->isEmpty())

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
                                                                                    <i>{{$research->milestoneseminar->description}}</i>
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
                                                                    <div class="row">
                                                                        <div class="col-md-9 border-right offset-md-0">
                                                                            <b>Decision:</b>
                                                                            @foreach($research->proposalReview as $reviewer)
                                                                                    @if($reviewer->decision_id == \Modules\ArSys\Entities\ResearchDecisionType::where('code', 'RJC')->first()->id)
                                                                                        <span class="badge badge-pill badge-danger">
                                                                                        {{$reviewer->faculty->code}}
                                                                                        </span>
                                                                                    @elseif($reviewer->decision_id == \Modules\ArSys\Entities\ResearchDecisionType::where('code', 'APP')->first()->id)
                                                                                        <span class="badge badge-pill badge-success">
                                                                                            {{$reviewer->faculty->code}}
                                                                                        </span>
                                                                                    @elseif($reviewer->decision_id == \Modules\ArSys\Entities\ResearchDecisionType::where('code', 'RVS')->first()->id)
                                                                                        <span class="badge badge-pill badge-info">
                                                                                            {{$reviewer->faculty->code}}
                                                                                        </span>
                                                                                    @elseif($reviewer->decision_id == \Modules\ArSys\Entities\ResearchDecisionType::where('code', 'PRS')->first()->id)
                                                                                        <span class="badge badge-pill badge-warning">
                                                                                            {{$reviewer->faculty->code}}
                                                                                        </span>
                                                                                    @elseif($reviewer->decision_id == null)
                                                                                        <span class="badge badge-pill badge-secondary">
                                                                                            {{$reviewer->faculty->code}}
                                                                                        </span>
                                                                                    @endif
                                                                            @endforeach

                                                                        </div>
                                                                        <div class="col-md-3 offset-md-0">
                                                                            <a class="btn btn-sm"><i class="fa fa-watch"></i><u>Review History</u></a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-12 offset-md-0">
                                                                            <div class="row">
                                                                                <div class="col-md-12 offset-md-0">
                                                                                    <i class="fas fa-quote-right"></i><b> Discussion</b>

                                                                                            <sup style="color:red">
                                                                                                <i class="fa fa-envelope"></i>
                                                                                                @if($research->reviewDiscussion != null)
                                                                                                    @php($notfication = \Modules\ArSys\Entities\ResearchReviewDiscussionRead::where('research_id', $research->id)
                                                                                                        ->where('reader_id', Auth::user()->faculty->id)
                                                                                                        ->where('status', null)
                                                                                                        ->get()->count())
                                                                                                    {{$notfication}}
                                                                                                @endif
                                                                                            </sup>
                                                                                    <button wire:click="$emit('proposalReviewDiscussionComponent', {{$research->id}})" class="btn btn-sm"><i class="fa fa-plus-circle"></i> Add</button>
                                                                                    <br>
                                                                                    @if($research != null)
                                                                                        @if($research->reviewDiscussion != null)
                                                                                            @php($number = 0)
                                                                                            @foreach($research->reviewDiscussion as $discussion)
                                                                                                @if($number < 3)
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-1 offset-md-0">
                                                                                                        </div>
                                                                                                        <div class="col-md-1.5 offset-md-0">
                                                                                                            @if($discussion->discussant_type == 1)
                                                                                                                <b style="color:blue">{{$discussion->faculty->code}}</b>
                                                                                                            @else
                                                                                                                <b style="color:red">{{$discussion->student->first_name}}</b>
                                                                                                            @endif
                                                                                                                :
                                                                                                        </div>
                                                                                                        <div class="col-md-9 offset-md-0">
                                                                                                            <i>{{$discussion->message}}</i>
                                                                                                            @if($discussion->discussant_id == Auth::user()->faculty->id)
                                                                                                                <a class="btn btn-xs" wire:click="$emit('deleteReviewDiscussionMessage_faculty',{{$discussion->id}})"><i class="fa fa-minus-circle" style="color:red"></i></a>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @php(++$number)
                                                                                                @endif
                                                                                            @endforeach
                                                                                            @if ($number >=3)
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 offset-md-0,5">
                                                                                                    <a wire:click="$emit('proposalReviewDiscussionComponent', {{$research->id}})"
                                                                                                        class="btn btn-sm">
                                                                                                        <u>view all</u>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <!--<div class="row">

                                                                        <div class="col-md-12 offset-md-0">
                                                                            <i class="fas fa-quote-right"></i></i><b> Final Remark</b>
                                                                            <button wire:click="submitRemark({{$research->id}})" class="btn btn-sm"><i class="fa fa-plus-circle"></i> Add/Edit</button>
                                                                            <br>
                                                                            @php($number = 0)
                                                                            @foreach($research->proposalReview as $reviewer)

                                                                                @if($reviewer->comment != null)
                                                                                    @if($number < 3)
                                                                                        <b>{{$reviewer->faculty->code}}:</b> {{$reviewer->comment}}
                                                                                        <br>
                                                                                    @endif
                                                                                    @php(++$number)
                                                                                @endif
                                                                            @endforeach
                                                                            @if ($number >=3)
                                                                                <a class = "btn"><u>view all</u></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <hr>
                                                                -->
                                                                    <div class="row">
                                                                        <div class="col-md-12 offset-md-0">
                                                                        <button wire:click="decision({{$research->id}}, 'RJC')" class="btn btn-xs btn-danger">Reject</button>
                                                                        <button wire:click="decision({{$research->id}}, 'PRS')" class="btn btn-xs btn-primary">Presentation</button>
                                                                        <button wire:click="decision({{$research->id}}, 'RVS')" class="btn btn-xs btn-warning">Revise</button>
                                                                        <button wire:click="decision({{$research->id}}, 'APP')" class="btn btn-xs btn-success">Approve</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                @php($counter++)
                                            @endif
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

    @livewire('arsys::review.faculty.discussion')

    <script type="text/javascript">

        window.livewire.on('submitReviewFacultyRemarkModal', () => {
            $('#submitReviewFacultyRemarkModal').modal('show');
        });

        window.livewire.on('hideAll', () => {
            $('.modal').modal('hide');
        });

    </script>
</div>

