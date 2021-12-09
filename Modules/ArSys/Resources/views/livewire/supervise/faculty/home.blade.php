<div>
    <div class='row'>
        <div class="col-md-3 offset-md-0">
            <input wire:model="search" type="text" class="my-3 form-control" placeholder="Search student name">
        </div>
    </div>

    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th width="25%">Name</th>
                <th width="75%">Research

                </th>

            </tr>
            </thead>
            <tbody id="users-table">
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                @if (($student->program != null) && ($student->student_number != null))
                                    {{$student->program->code}}.{{$student->student_number}}
                                    <br>
                                    @if($student->specialization != null)
                                        {{$student->specialization->description}} {{$student->program->abbrev}}
                                    @endif
                                @endif
                                <br>
                                <b>{{$student->first_name}} {{$student->last_name}}</b>

                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-12 offset-md-0">
                                        @foreach ($student->research as $research)
                                        @if($research->status == 1)
                                            @if($research->supervisor->contains('supervisor_id', $user->faculty->id))
                                                @if($research->type->research_model == 'defense')
                                                    @php($milestone = $research->milestone)
                                                @else
                                                    @php($milestone = $research->milestoneseminar)
                                                @endif
                                                <div class='row'>
                                                    <div class="col-md-12 offset-md-0">
                                                        <div class="col-md-12 offset-md-0">
                                                            <div class="card">

                                                                <div class="text-white card-header bg-secondary">
                                                                    <div class="row">
                                                                        <div class="col-md-12 offset-md-0">
                                                                            @if($milestone != null)
                                                                                <b>{{$milestone->milestone}}</b> |
                                                                                <i>{{$milestone->description}}</i> |
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
                                                                    <div class="row">
                                                                        <div class="col-md-6 border-right offset-md-0">
                                                                            <div class="row">
                                                                                <div class="col-md offset-md-0">
                                                                                    <i class="fas fa-spinner"></i><b> Progress of Supervision</b>
                                                                                <hr>
                                                                                @foreach($research->supervisor as $supervisor)
                                                                                    @if($supervisor->faculty->code != 'EXT')
                                                                                        <div class="row">
                                                                                            <div class="col-md offset-md-0">
                                                                                                <i class="text-success">{{$supervisor->faculty->code}}</i>
                                                                                                @if($supervisor->faculty->id == $user->faculty->id)
                                                                                                    <button wire:click="$emit('researchCreateSuperviseComponent', {{$supervisor->id}})" class="btn btn-sm"><i class="fas fa-plus-circle"></i> Add</button>
                                                                                                    @if($supervisor->bypass === 1)
                                                                                                        <button wire:click="bypassMeeting({{$supervisor->id}})" class="btn btn-sm"><i class="fa fa-check" style ="color:green" aria-hidden="true"></i> bypass</button>
                                                                                                    @else
                                                                                                        <button wire:click="bypassMeeting({{$supervisor->id}})" class="btn btn-sm"><i class="fa fa-ban" aria-hidden="true" style ="color:red"></i> bypass</button>
                                                                                                    @endif
                                                                                                @endif



                                                                                                @php($counter=0)
                                                                                                @if($research->supervise != null)
                                                                                                    @forelse ($research->supervise as $supervise)
                                                                                                        @if ($supervise->supervisor_id == $supervisor->supervisor_id)
                                                                                                            <br>
                                                                                                            @if($supervise->status == true)
                                                                                                                <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                                                                                            @else
                                                                                                                <i class="fa fa-check-circle fa-xs" style ="color:gray" aria-hidden="true"></i>
                                                                                                            @endif
                                                                                                            Meeting {{++$counter}}:

                                                                                                            @if($supervise->share === 1 || $supervisor->faculty->id == $user->faculty->id)
                                                                                                                @if($research->research_milestone != 0 && $research->research_milestone != 17)
                                                                                                                    <a href="#" wire:click="$emit('superviseDiscussionComponent', {{$supervise->id}})">
                                                                                                                @endif
                                                                                                                <u>{{ \Carbon\Carbon::parse($supervise->created_at)->format('d-m-Y') }}</u>
                                                                                                                </a>
                                                                                                            @else
                                                                                                                <u>{{ \Carbon\Carbon::parse($supervise->created_at)->format('d-m-Y') }}</u>
                                                                                                            @endif

                                                                                                            @if($supervisor->faculty->id == $user->faculty->id)
                                                                                                                @if($supervise->threader_role === \Modules\ArSys\Entities\Role::where('name', 'student')->first()->id)
                                                                                                                    @if($supervise->status === null)
                                                                                                                        <a class="btn btn-xs" wire:click="approveSupervise({{$supervise->id}}, 'Approve')"><i class="fa fa-check"  style ="color:green" aria-hidden="true"></i> Approve</a>
                                                                                                                    @else
                                                                                                                        <a class="btn btn-xs" wire:click="approveSupervise({{$supervise->id}}, 'Cancel')"><i class="fa fa-ban"  style ="color:red" aria-hidden="true"></i> Cancel</a>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif

                                                                                                        @endif
                                                                                                    @empty
                                                                                                    @endforelse
                                                                                                @endif
                                                                                                <hr>
                                                                                            </div>

                                                                                        </div>
                                                                                    @endif

                                                                                    @if($research->supervisorexternal != null)
                                                                                        <b>External Supervisor: </b>
                                                                                        <br>
                                                                                        {{$research->supervisorexternal->supervisor_name}}-{{$research->supervisorexternal->institution}}
                                                                                    @endif
                                                                                    <hr>

                                                                                @endforeach
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md offset-md-0">
                                                                                    <i class="fas fa-tasks"></i><b> To-do List</b>
                                                                                    @if($research->research_milestone != 0 && $research->research_milestone != 17)
                                                                                        <button wire:click="$emit('createTodoComponent', {{$research->id}})" class="btn btn-sm "><i class="fas fa-plus-circle"></i> Add</button>
                                                                                    @endif
                                                                                    <br>


                                                                                    @if($research->todo != null)
                                                                                        @php($counter = 0)
                                                                                        @foreach($research->todo as $todo)

                                                                                            @if($counter < 2)
                                                                                                @php(++$counter)
                                                                                                    <button class="btn btn-sm" wire:click="$emit('todoCompleted', {{$todo->id}})"> <i class="fa fa-check-square fa-sm" style ="color:gray" aria-hidden="true"></i>
                                                                                                    </button>
                                                                                                    <a href="#" wire:click="$emit('singleTodoComponent', {{$todo->id}})">
                                                                                                    <u>{{$todo->todo_title}}</u>
                                                                                                    </a>

                                                                                                    <br>
                                                                                            @endif
                                                                                        @endforeach
                                                                                        @if($research->todo->count() > 2)
                                                                                            <a href="#" wire:click="$emit('allTodoComponent', {{$research->id}})">
                                                                                            <u>And more {{$research->todo->count()-$counter}} uncompleted todo...</u>
                                                                                            </a>
                                                                                        @endif
                                                                                        <br>
                                                                                    @endif

                                                                                    @if($research->completedtodo != null)
                                                                                        @php($counter = 0)
                                                                                        @foreach($research->completedtodo as $todo)

                                                                                            @if($counter < 2)
                                                                                                @php(++$counter)
                                                                                                    <button class="btn btn-sm" wire:click="$emit('todoUncompleted', {{$todo->id}})"> <i class="fa fa-check-square fa-sm" style ="color:green" aria-hidden="true"></i>
                                                                                                    </button>
                                                                                                    <a href="#" wire:click="$emit('singleTodoComponent', {{$todo->id}})">
                                                                                                        <u>{{$todo->todo_title}}</u>
                                                                                                    </a>
                                                                                                    <br>
                                                                                            @endif
                                                                                        @endforeach
                                                                                        @if($research->completedtodo->count() > 2)
                                                                                            <a href="#" wire:click="$emit('allTodoComponent', {{$research->id}})">
                                                                                            <u>And more {{$research->completedtodo->count()-$counter}} completed todo...</u>
                                                                                            </a>
                                                                                        @endif
                                                                                        <br>
                                                                                    @endif

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 offset-md-0">
                                                                            <div class="row">
                                                                                <div class="col-md-12 offset-md-0">
                                                                                    <b>Defense/Seminar Approval</b>
                                                                                    <br>
                                                                                    @if(!$research->defenseApproval->isEmpty())
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
                                                                                            @if ($approval->approver_id === $user->faculty->id)
                                                                                                @if($approval->decision == false)
                                                                                                    <a class="btn btn-info btn-xs" wire:click="approve({{$approval->id}})"><i class="fa fa-check"  aria-hidden="true"></i> Approve</a>
                                                                                                @endif
                                                                                            @endif
                                                                                            <br>
                                                                                        @endforeach
                                                                                    @else
                                                                                        There is no approval request
                                                                                    @endif

                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <div class="row">
                                                                                <div class="col-md-12 offset-md-0">
                                                                                    <b>Applied Event</b>
                                                                                    <br>

                                                                                    @forelse ($research->applicant as $applicant)

                                                                                        {{$applicant->event->type->description}}
                                                                                        {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d-m-Y') }}
                                                                                        <br>
                                                                                    @empty
                                                                                    @endforelse
                                                                                </div>
                                                                            </div>
                                                                            <hr>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        {{$students->links()}}
        @livewire('arsys::supervise.create')
        @livewire('arsys::supervise.discussion')
        @livewire('arsys::todo.create')
        @livewire('arsys::todo.all-to-do')
        @livewire('arsys::todo.single-to-do')
    </div>
    </div>
