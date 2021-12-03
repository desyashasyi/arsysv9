<div>

    <div class="col-md-3 offset-md-0">
        <input wire:model="search" type="text" class="my-3 form-control" placeholder="Search student name">
    </div>


    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th class="text-left" width="2%">Number</th>
                <th class="text-left" width="23%">Student</th>
                <th class="text-left" width="46%">Research</th>
                <th class="text-left" width="20%">Approval</th>
                <th class="text-right" width="5%">Milestone</th>

            </tr>
            </thead>
            <tbody id="users-table">
                    @php($number = 0)
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                {{++$number}}
                            </td>
                            <td>
                                {{$student->program->code}}.
                                {{$student->student_number}}
                                <br>
                                {{$student->first_name}}
                                {{$student->last_name}}
                            </td>
                            @foreach($student->research as $research)
                                @if($research->research_milestone == 5)
                                    <td>

                                        {{$research->research_code}}
                                        <br>
                                        {{$research->title}}
                                        <br>
                                        <br>
                                        @if($research->milestone != null || $research->milestoneseminar != null)
                                            @if($research->type->research_model == 'defense')
                                                <b>{{$research->milestone->milestone}}</b> |
                                            @endif

                                            {{$research->type->description}} {{$student->program->description}}
                                            <br>
                                            Status:
                                            @if($research->type->research_model == 'defense')
                                                <i>{{$research->milestone->description}}</i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($research->defenseApproval as $approval)
                                            @if($approval->decision == true)
                                                <i class="fa fa-check-circle fa-xs" style ="color:green" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-ban fa-xs"  style ="color:red" aria-hidden="true"></i>
                                            @endif

                                            {{$approval->defenseModel->description}} |
                                            {{$approval->faculty->code}}
                                            <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button wire:click="upMilestone({{$research->id}})"
                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
                                        </button>
                                        <button wire:click="downMilestone({{$research->id}})"
                                            class="btn btn-sm"><i class="fa fa-arrow-circle-down" style ="color:red" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                @endif
                            @endforeach

                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    {{$students->links()}}
</div>

