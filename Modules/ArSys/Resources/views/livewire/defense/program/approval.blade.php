<div>

    <div class="col-md-3 offset-md-0">
        <input wire:model="search" type="text" class="my-3 form-control" placeholder="Search student name">
    </div>

    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">

            <thead class="thead">

                <tr>

                    <th width="5%">No</th>
                    <th width="25%">Student</th>
                    <th width="50%">Research</th>
                    <th width="10%">SPV</th>
                    <th class="text-right" width="10%">Action</th>
                </tr>
            </thead>
            <tbody id="users-table">
                @php($counter = 0)
                @forelse ($students as $student)
                    <tr>
                        <td> {{++$counter}} </td>
                        <td>
                            {{$student->program->code}}.{{$student->student_number}}
                            <br>
                            {{$student->first_name}} {{$student->last_name}}
                        </td>

                        @foreach($student->research as $research)
                            @if($research->research_milestone ==
                            \Modules\ArSys\Entities\ResearchMilestone::where('milestone', 'Final-defense')
                            ->where('phase', 'submitted')->first()->sequence)
                                <td>
                                    {{$research->title}}
                                </td>

                                <td>
                                    @foreach($research->supervisor as $supervisor)
                                        {{$supervisor->faculty->code}}
                                        <br>
                                    @endforeach
                                </td>

                                <td class="text-right">
                                    @foreach($research->defenseApproval as $approval)
                                        @if($approval->approver_role ==
                                            \Modules\ArSys\Entities\DefenseRole::where('code', 'PRG')->first()->id
                                            &&
                                            $approval->approver_id == Auth::user()->faculty->id
                                            &&
                                            $approval->decision == null)

                                            <a class="btn btn-xs btn-warning" wire:click="approve({{$approval->id}})"><i class="fa fa-check"  aria-hidden="true"></i> Approve</a>
                                        @endif
                                    @endforeach
                                </td>
                            @endif
                        @endforeach
                    </tr>
               @empty
                    <tr>
                        <td colspan="5">
                            No Data
                        </td>
                    </tr>
               @endforelse
            </tbody>
        </table>
    </div>


    {{$students->links()}}
    @include('arsys::livewire.sweetalert.success-alert')

</div>

