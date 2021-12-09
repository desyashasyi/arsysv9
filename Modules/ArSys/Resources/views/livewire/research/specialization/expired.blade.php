<div>
    @livewire('arsys::research.specialization.supervisor')
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
                <tr>

                    <th width="5%">No</th>
                    <th width="25%">Student</th>
                    <th width="45%">Research</th>
                    <th width="15%">Status</th>
                    <th width="10%">Supervisor</th>
                </tr>
            </thead>
            <tbody id="users-table">
                @php($counter = 0)
                @forelse ($researchs as $number => $research)
                    <tr>
                        <td>
                            {{++$number}}
                        </td>
                        <td>
                            <i>{{$research->student->program->code}}. {{$research->student->student_number}}
                            <br>
                            {{$research->student->specialization->description}} 
                            ({{$research->student->program->abbrev}})</i>
                            <br>
                            {{$research->student->first_name}} {{$research->student->last_name}}
                            
                        </td>
                        <td>
                            <i>{{$research->research_code}} - {{$research->type->description}}</i>
                            <br>
                            {{$research->title}}
                            <br>
                            <br>
                            
                        </td>
                        <td>
                            <b>Approval</b>
                            <br>
                            <u>{{ \Carbon\Carbon::parse($research->approval_date)->format('d-m-Y') }}</u>
                            
                        </td>
                        <td>
                            @foreach ($research->supervisor as $supervisor)
                                {{$supervisor->faculty->code}} 
                                <br>
                            @endforeach
                            <button class="btn btn-xs" wire:click="$emit('inProgressSetSupervisor_Specialization', {{$research->id}})"><i class="fa fa-user-plus" aria-hidden="true"></i> 
                                <u>Edit</u>
                            </button>
                            
                        </td>
                    </tr>
                @empty
                        No Data
                @endforelse
            </tbody>
        </table>
    </div>
    {{$researchs->links()}}
</div>
