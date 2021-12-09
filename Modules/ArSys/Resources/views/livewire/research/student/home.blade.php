<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row">
        <div class="col-sm-12">
            <button wire:click="$emit('researchCreateComponent')" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Add Research</button>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="table-responsive users-table">
            <table class="table table-striped table-sm data-table">
                <thead class="thead">
                <tr>
                    <th class="text-center" width="100%">Research Data</th>
                </tr>
                </thead>
                <tbody id="users-table">
                    @if($researchs != null)
                        @foreach ($researchs as $research)

                            <tr>
                                <td>
                                <div class="row">
                                    <div class="col-md-12 offset-md-0">
                                        <div class='row'>
                                            <div class="col-md-4 offset-md-0">
                                                <div class="card">
                                                    <div class="card-header">
                                                        @if($research != null)
                                                            {{$research->research_code}} |
                                                            @if($research->type->research_model == 'defense')

                                                                <b>{{$research->milestone->milestone}}</b>
                                                            @else
                                                                @if($research->milestoneseminar != null)
                                                                    <b>{{$research->milestoneseminar->milestone}}</b>
                                                                @endif
                                                            @endif

                                                            <br>
                                                            @if($research->type->research_model == 'defense')
                                                                <i>{{$research->milestone->description}}</i>
                                                            @else
                                                                @if($research->milestoneseminar != null)
                                                                    @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'PI')->first()->id)
                                                                        <i>{{$research->milestoneseminar->description_pi}}</i>
                                                                    @endif
                                                                    @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'SE')->first()->id)
                                                                        <i>{{$research->milestoneseminar->description}}</i>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="card-body">
                                                        @if(($research->supervisor->isNotEmpty() && $research->research_milestone >= 4) || $research->research_milestone < 4)
                                                        @if($deleteConfirmation == true)
                                                            @if ($researchId == $research->id)
                                                                <button wire:click="deleteProceed({{ $research->id }})"
                                                                    class="btn btn-danger btn-sm">Are you sure?</button>
                                                                <button wire:click="deleteCancel"
                                                                    class="btn btn-success btn-sm ">Cancel</button>
                                                            @endif
                                                        @else
                                                            <button wire:click="$emit('researchEditComponent', {{$research->id}} )"
                                                                class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</button>

                                                            @if($research->research_milestone <= 3)
                                                                <button wire:click="deleteResearch({{ $research->id }})"
                                                                    class="btn btn-danger btn-sm"><i class="fa fa-bin"></i>Delete</button>
                                                            @endif

                                                            @if($research->research_milestone == 1)
                                                            <button wire:click="propose({{ $research->id }})"
                                                                class="btn btn-primary btn-sm">Submit Proposal</button>
                                                            @endif

                                                            @if($research->research_milestone > 3)
                                                                @if($research->type->research_model == 'defense')
                                                                    @if($research->research_milestone == 9)
                                                                        <br>
                                                                        <br>
                                                                        <i class="fa fa-exclamation-triangle fa-xs" style ="color:red" aria-hidden="true"></i>
                                                                        <i>You should write the report of defense to continue the milestone</i>
                                                                        <button wire:click="$emit('defenseStudentSubmitReportComponent', {{$research->id}})" class="btn btn-primary btn-xs"><i class="fa fa-xs fa-paper-plane"></i> Submit</button>
                                                                    @endif

                                                                    @if($research->milestone->propose_button == true)
                                                                        <button wire:click="propose({{ $research->id }})"
                                                                        class="btn btn-primary btn-sm">Propose Defense</button>
                                                                    @endif
                                                                    @if($research->approvalRequest->isNotEmpty())
                                                                        <button wire:click="cancelDefenseApproval({{ $research->id }})"
                                                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Cancel Defense Approval</button>
                                                                    @endif
                                                                    @if($research->research_milestone ==
                                                                        \Modules\ArSys\Entities\ResearchMilestone::where('milestone', 'Pre-defense')
                                                                        ->where('phase', 'Approved')->first()->id)

                                                                        @if(\Modules\ArSys\Entities\ArSysConfig::where('code', 'PRE_DEFENSE_REQUIREMENT')->first()->status)
                                                                            @if($research->draftthesisdoc)
                                                                                <button wire:click="$emit('studentEventApplyComponent', {{$research->id}}, {{$research->research_milestone}})"
                                                                                    class="btn btn-primary btn-sm">Apply Pre Defense
                                                                                </button>
                                                                            @else
                                                                                <button disabled
                                                                                    class="btn btn-default btn-sm">Apply Pre Defense
                                                                                </button>
                                                                                <br>
                                                                                <br>
                                                                                <i class="fa fa-exclamation-triangle fa-xs" style ="color:red" aria-hidden="true"></i>
                                                                                <i>{{$research->milestone->message}}</i>
                                                                            @endif
                                                                        @else
                                                                            <button wire:click="$emit('studentEventApplyComponent', {{$research->id}}, {{$research->research_milestone}})"
                                                                                class="btn btn-primary btn-sm">Apply Pre Defense
                                                                            </button>
                                                                        @endif
                                                                    @endif
                                                                    @if($research->research_milestone ==
                                                                        \Modules\ArSys\Entities\ResearchMilestone::where('milestone', 'Final-defense')
                                                                        ->where('phase', 'Approved')->first()->id)

                                                                        @if(\Modules\ArSys\Entities\ArSysConfig::where('code', 'FINAL_DEFENSE_REQUIREMENT')->first()->status)
                                                                            @if($research->thesisdoc && $research->pdfartdoc && $research->spvdoc && $research->cospvdoc)
                                                                                <button wire:click="$emit('studentEventApplyComponent', {{$research->id}}, {{$research->research_milestone}})"
                                                                                    class="btn btn-primary btn-sm">Apply Final Defense
                                                                                </button>
                                                                            @else
                                                                                <button disabled
                                                                                    class="btn btn-default btn-sm">Apply Final Defense
                                                                                </button>
                                                                                <br>
                                                                                <br>
                                                                                <i class="fa fa-exclamation-triangle fa-xs" style ="color:red" aria-hidden="true"></i>
                                                                                <i>{{$research->milestone->message}}</i>
                                                                            @endif
                                                                        @else
                                                                            <button wire:click="$emit('studentEventApplyComponent', {{$research->id}}, {{$research->research_milestone}})"
                                                                                class="btn btn-primary btn-sm">Apply Final Defense
                                                                            </button>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if($research->milestoneseminar->propose_button == true)
                                                                        <button wire:click="propose({{ $research->id }})"
                                                                        class="btn btn-primary btn-sm">Propose Seminar</button>
                                                                    @endif
                                                                    @if($research->research_milestone == 6)
                                                                        <button wire:click="$emit('studentEventApplyComponent', {{$research->id}}, {{$research->research_milestone}})"
                                                                            class="btn btn-primary btn-sm">Apply {{$research->milestoneseminar->milestone}}
                                                                        </button>

                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 offset-md-0">
                                                @include('arsys::livewire.message.message')
                                                <div class="row">
                                                    <div class="col-md-12 offset-md-0">
                                                        <div class="card">
                                                            <div class="text-white card-header bg-secondary">
                                                                <a href="#" wire:click="$emit('researchViewComponent', {{$research->id}})"><b><u>{{$research->title}}</u></b></a>
                                                            </div>
                                                            <div class="card-body">

                                                                @if($research->research_milestone == 3)
                                                                    <div class="row">
                                                                        <div class="col-md-12 offset-md-0">
                                                                            <div class="row">
                                                                                <div class="col-md-12 offset-md-0">
                                                                                    <i class="fas fa-quote-right"></i><b> Discussion</b>

                                                                                            <sup style="color:red">
                                                                                                <i class="fa fa-envelope"></i>
                                                                                                @if($research->reviewDiscussion != null)
                                                                                                    @php($notfication = \Modules\ArSys\Entities\ResearchReviewDiscussionRead::where('research_id', $research->id)
                                                                                                        ->where('reader_id', Auth::user()->student->id)
                                                                                                        ->where('status', null)
                                                                                                        ->get()->count())
                                                                                                    {{$notfication}}
                                                                                                @endif
                                                                                            </sup>
                                                                                    <button wire:click="$emit('reviewDiscussion_Student', {{$research->id}})" class="btn btn-sm"><i class="fa fa-plus-circle"></i> Add</button>
                                                                                    <br>
                                                                                    @if($research != null)
                                                                                        @if($research->reviewDiscussion != null)
                                                                                            @php($number = 0)
                                                                                            @foreach($research->reviewDiscussion as $discussion)
                                                                                                @if($number < 5)
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
                                                                                                            @if($discussion->discussant_id == Auth::user()->student->id)
                                                                                                                <a class="btn btn-xs" wire:click="$emit('deleteReviewDiscussionMessage_Student', {{$discussion->id}})"><i class="fa fa-minus-circle" style="color:red"></i></a>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @php(++$number)
                                                                                                @endif
                                                                                            @endforeach
                                                                                            @if ($number >=5)
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 offset-md-0,5">
                                                                                                    <a wire:click="$emit('reviewDiscussion_Student', {{$research->id}})"
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
                                                                @endif
                                                                @if($research->research_milestone < 4)
                                                                    @if($research->supervisor != null)
                                                                        @foreach($research->supervisor as $supervisor)
                                                                            {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}
                                                                            <br>
                                                                        @endforeach
                                                                    @endif
                                                                @else
                                                                    @if($research->supervisor->isNotEmpty())
                                                                    <div class="row">
                                                                        <div class="col-md-6 border-right offset-md-0">
                                                                            <div class="row">
                                                                                <div class="col-md offset-md-0">
                                                                                    @include('arsys::livewire.supervise.supervise-idx', ['id' => $research->id])
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md offset-md-0">
                                                                                    @include('arsys::livewire.todo.todo-idx', ['id' => $research->id])
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 offset-md-0">
                                                                            @if($research->research_milestone ===
                                                                                \Modules\ArSys\Entities\ResearchMilestone::where('milestone', 'Pre-defense')
                                                                                ->where('phase', 'Applied')->first()->id
                                                                                )
                                                                                @if(\Modules\ArSys\Entities\ArSysConfig::where('code', 'PRE_DEFENSE_REQUIREMENT')->first()->status)
                                                                                    @foreach ($research->applicant as $applicant)
                                                                                        @if($applicant->event->event_type ==
                                                                                            \Modules\ArSys\Entities\EventType::where('defense_model', 'Pre-defense')->first()->id
                                                                                            )
                                                                                            @if(\Carbon\Carbon::parse($applicant->event->draft_deadline)->gte(\Carbon\Carbon::now()))
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 offset-md-0">
                                                                                                        <b>Document for Pre-defense</b>
                                                                                                        <br>
                                                                                                        @if($research->draftthesisdoc)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->draftthesisdoc->filename)}}" target="blank">
                                                                                                                <u>1. Draft of Thesis (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            1. Draft of Thesis (PDF)
                                                                                                        @endif

                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'DRAFTTHESIS')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <hr>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endif
                                                                            @if($research->research_milestone ===
                                                                                \Modules\ArSys\Entities\ResearchMilestone::where('milestone', 'Pre-defense')
                                                                                ->where('phase', 'Approved')->first()->id
                                                                                )
                                                                                @if(\Modules\ArSys\Entities\ArSysConfig::where('code', 'PRE_DEFENSE_REQUIREMENT')->first()->status)
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 offset-md-0">
                                                                                                        <b>Document for Pre-defense</b>
                                                                                                        <br>
                                                                                                        @if($research->draftthesisdoc)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->draftthesisdoc->filename)}}" target="blank">
                                                                                                                <u>1. Draft of Thesis (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            1. Draft of Thesis (PDF)
                                                                                                        @endif

                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'DRAFTTHESIS')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <hr>

                                                                                @endif
                                                                            @endif
                                                                            @if($research->research_milestone ==
                                                                                \Modules\ArSys\Entities\ResearchMilestone::where('milestone', 'Final-defense')
                                                                                ->where('phase', 'Applied')->first()->id
                                                                                )
                                                                                @if(\Modules\ArSys\Entities\ArSysConfig::where('code', 'FINAL_DEFENSE_REQUIREMENT')->first()->status)
                                                                                    @foreach ($research->applicant as $applicant)
                                                                                        @if($applicant->event->event_type == \Modules\ArSys\Entities\EventType::where('defense_model', 'Final-defense')->first()->id
                                                                                            ||
                                                                                            $applicant->event->event_type == \Modules\ArSys\Entities\EventType::where('defense_model', 'Seminar')->first()->id
                                                                                            )
                                                                                            @if(\Carbon\Carbon::parse($applicant->event->draft_deadline)->gte(\Carbon\Carbon::now()))

                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 offset-md-0">
                                                                                                        <b>Documents for Final-defense</b>
                                                                                                        <br>
                                                                                                        @if($research->pdfartdoc)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->pdfartdoc->filename)}}" target="blank">
                                                                                                            <u>1. Defense article (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            1. Defense article (PDF)
                                                                                                        @endif
                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'PDFART')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>

                                                                                                        @if($research->spvdoc != null)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->spvdoc->filename)}}" target="blank">
                                                                                                                <u>2. SPV assignment (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            2. SPV assignment (PDF)
                                                                                                        @endif
                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'SPV')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>

                                                                                                        @if($research->cospvdoc != null)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->cospvdoc->filename)}}" target="blank">
                                                                                                                <u>3. Co-SPV assigntment (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            3. Co-SPV assigntment (PDF)
                                                                                                        @endif
                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'COSPV')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>

                                                                                                        @if($research->thesisdoc != null)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->thesisdoc->filename)}}" target="blank">
                                                                                                                <u>4. Thesis (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            4. Thesis (PDF)
                                                                                                        @endif
                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'THESIS')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <i>You may revise the defense documents before
                                                                                                    {{\Carbon\Carbon::parse($applicant->event->draft_deadline)
                                                                                                    ->format('d-m-Y - H:i')}}</i>
                                                                                                <hr>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endif
                                                                            @if($research->research_milestone ==
                                                                                \Modules\ArSys\Entities\ResearchMilestone::where('milestone', 'Final-defense')
                                                                                ->where('phase', 'Approved')->first()->id
                                                                                )
                                                                                @if(\Modules\ArSys\Entities\ArSysConfig::where('code', 'FINAL_DEFENSE_REQUIREMENT')->first()->status)
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 offset-md-0">
                                                                                            <b>Documents for Final-defense</b>
                                                                                            <br>
                                                                                            @if($research->pdfartdoc)
                                                                                                <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                <a href="{{url('/')}}{{ Storage::disk('local')->url($research->pdfartdoc->filename)}}" target="blank">
                                                                                                    <u>1. Defense article (PDF)</u>
                                                                                                </a>
                                                                                            @else
                                                                                                <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                    1. Defense article (PDF)
                                                                                                        @endif
                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'PDFART')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>

                                                                                                        @if($research->spvdoc != null)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->spvdoc->filename)}}" target="blank">
                                                                                                                <u>2. SPV assignment (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            2. SPV assignment (PDF)
                                                                                                        @endif
                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'SPV')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>

                                                                                                        @if($research->cospvdoc != null)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->cospvdoc->filename)}}" target="blank">
                                                                                                                <u>3. Co-SPV assigntment (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            3. Co-SPV assigntment (PDF)
                                                                                                        @endif
                                                                                                        <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'COSPV')->first()->id}})"
                                                                                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                        </button>
                                                                                                        <br>

                                                                                                        @if($research->thesisdoc != null)
                                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            <a href="{{url('/')}}{{ Storage::disk('local')->url($research->thesisdoc->filename)}}" target="blank">
                                                                                                                <u>4. Thesis (PDF)</u>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                                            4. Thesis (PDF)
                                                                                            @endif
                                                                                                <button wire:click="$emit('emiterResearchStudentDocumentSubmit', {{$research->id}}, {{\Modules\ArSys\Entities\ResearchFileType::where('code', 'THESIS')->first()->id}})"
                                                                                                    class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                                                                                </button>
                                                                                                <br>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                @endif
                                                                            @endif
                                                                            <div class="row">
                                                                                <div class="col-md-12 offset-md-0">

                                                                                    <b> Approval of Defense/Seminar</b>
                                                                                    <br>
                                                                                    @foreach($research->defenseApproval as $approval)
                                                                                        @if($approval->approver_role === \Modules\ArSys\Entities\DefenseRole::where('code', 'PRG')->first()->id)
                                                                                            <br>
                                                                                            <b>Head of Program Approval</b>
                                                                                            <br>
                                                                                        @endif
                                                                                        @if($approval->decision == true)
                                                                                            <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                        @else
                                                                                            <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                                                                        @endif


                                                                                        {{$approval->defenseModel->description}} |
                                                                                        {{$approval->faculty->code}}
                                                                                        <br>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="row">
                                                                                <div class="col-md-12 offset-md-0">
                                                                                    <b>Applied Event</b>
                                                                                    <br>


                                                                                    @foreach ($research->applicant as $applicant)
                                                                                        @if($applicant->event->event_type == \Modules\ArSys\Entities\EventType::where('defense_model', 'Final-defense')->first()->id
                                                                                            ||
                                                                                            $applicant->event->event_type == \Modules\ArSys\Entities\EventType::where('defense_model', 'Seminar')->first()->id
                                                                                            )

                                                                                            @if($applicant->room != null)
                                                                                                <a href="{{$applicant->applicantroom->space->link}}" target="_blank"><u>{{$applicant->event->type->description}}
                                                                                                {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d-m-Y') }}</u></a>
                                                                                            @else
                                                                                                {{$applicant->event->type->description}}
                                                                                                {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d-m-Y') }}
                                                                                            @endif
                                                                                            <a title="Detail of event" class="btn btn-sm" wire:click="$emit('eventSeminarApplicantComponent_Student', {{$applicant->event_id}}, {{$applicant->research->id}})"><i class="fa fa-eye"></i></a>
                                                                                        @else
                                                                                            @if($applicant->space != null)
                                                                                                <a href="{{$applicant->space->link}}" target="_blank"><u>{{$applicant->event->type->description}}
                                                                                                {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d-m-Y') }}</u></a>
                                                                                            @else
                                                                                                {{$applicant->event->type->description}}
                                                                                                {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d-m-Y') }}
                                                                                            @endif
                                                                                            <a title="Detail of event" class="btn btn-sm" wire:click="$emit('emiterStudentEventApplicant', {{$applicant->event_id}})"><i class="fa fa-eye"></i></a>
                                                                                        @endif
                                                                                        @if ($applicant->event->status == null)
                                                                                            <a class="btn btn-sm" wire:click="removeEventApplication({{$applicant->id}}, {{$research->id}})"><i class="fa fa-trash" style="color:red"></i></a>
                                                                                        @endif
                                                                                        <br>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                            <br>

                                                                            <div class="row">
                                                                                <div class="col-md-12 offset-md-0">
                                                                                    <b>Report of defense</b>
                                                                                    <br>

                                                                                    @forelse ($research->applicant as $applicant)
                                                                                        @if($applicant->report != null )
                                                                                            @foreach($applicant->report as $report)
                                                                                                {{$report->applicant->event->type->description}} :
                                                                                                {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d-m-Y') }}
                                                                                                <a class="btn btn-sm" wire:click="$emit('defenseStudentEditReportComponent', {{$report->id}})"><i class="fa fa-edit"></i></a>
                                                                                                <br>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    @empty
                                                                                    @endforelse
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                @elseif($research->research_milestone == 4 || $research->research_milestone == 5)
                                                                    @include('arsys::livewire.research.student.home-warning')
                                                                @endif
                                                                <div class="row">
                                                                    <div class="col-md-12 offset-md-0">
                                                                        @livewire('arsys::research.student.history')
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        <br>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td>
                                There is no data of research
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @livewire('arsys::research.student.create')
    @livewire('arsys::research.student.view')
    @livewire('arsys::research.student.edit')
    @livewire('arsys::research.student.review-discussion')
    @livewire('arsys::research.student.document.submit')
    @livewire('arsys::event.student.apply')
    @livewire('arsys::event.student.applicant')
    
    @livewire('arsys::defense.student.submit-report')
    @livewire('arsys::defense.student.edit-report')
    @include('arsys::livewire.sweetalert.success-alert')
    @livewire('arsys::event.student.seminar-applicant')


    <script>
        window.livewire.on('hideAll', () => {
            $('.modal').modal('hide');
        });

        $('.modal').on('hidden.bs.modal', function () {
            window.livewire.emit('refreshComponent');
        });
    </script>
</div>
