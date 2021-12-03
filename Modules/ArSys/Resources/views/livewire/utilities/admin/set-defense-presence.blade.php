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
                <th class="text-left" width="60%">Research</th>
                <th class="text-right" width="10%">Examiner</th>
                <th class="text-right" width="5%">Action</th>

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
                                @if($research->research_milestone == 8)
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
                                    <td class="text-right">
                                        @foreach($research->applicant as $appliedEvent)
                                            @foreach($appliedEvent->examiner as $examiner)
                                                @if($examiner->presence)
                                                    <a class="btn btn-sm" wire:click="setPresence({{$examiner->id}})">
                                                        {{$examiner->faculty->code}}
                                                        <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a class="btn btn-sm" wire:click="setPresence({{$examiner->id}})">
                                                        {{$examiner->faculty->code}}
                                                        <i class="fa fa-ban" style="color:red"  aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                                <br>
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td class="text-right">
                                        <button wire:click="upMilestone({{$research->id}})"
                                            class="btn btn-sm"><i class="fa fa-arrow-circle-up" style ="color:blue" aria-hidden="true"></i>
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

