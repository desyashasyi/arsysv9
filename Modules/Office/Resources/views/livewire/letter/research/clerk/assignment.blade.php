<div>
    @livewire('office::letter.research.clerk.add-letter')
    @include('office::livewire.message.message')
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
                <tr>

                    <th width="5%">No</th>
                    <th width="25%">Student</th>
                    <th width="40%">Research</th>
                    <th width="20%">Status</th>
                    <th class="text-right" width="10%">Action</th>
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
                            Supervisor: 
                            <br>
                            @foreach ($research->supervisor as $supervisor)
                                {{$supervisor->faculty->first_name}} 
                                {{$supervisor->faculty->last_name}}
                                <br>
                            @endforeach
                        </td>
                        <td>
                            <b>Approval</b>
                            <br>
                            <u>{{ \Carbon\Carbon::parse($research->approval_date)->format('d-m-Y') }}</u>
                            <br>
                            <br>
                            @if($research->letter->isNotEmpty())
                                @if($research->letter->contains('type_id',\Modules\Office\Entities\ResearchLetterType::where('code', 'SPV')->first()->id ))
                                    <b>Letter</b>
                                    <br>
                                    @foreach($research->letter as $letter)
                                        @if($letter->type_id == \Modules\Office\Entities\ResearchLetterType::where('code', 'SPV')->first()->id)
                                            No: {{$letter->number}} - 
                                            <u>{{ \Carbon\Carbon::parse($letter->date)->format('d-m-Y') }}</u>
                                            <br>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        </td>
                        <td class="text-right">
                            <a class="btn btn-xs" wire:click="$emit('addResearchAssignmentLetter_Clerk', {{$research->id}})">
                                <i class="fa fa-envelope" style="color: blue">
                                </i>
                                <u> Add</u>
                            </a>
                            <br>
                            <a class="btn btn-xs" wire:click="printDraft({{$research->id}})">
                                <i class="fa fa-print" style="color: blue">
                                </i>
                                <u> Print Draft</u>
                            </a>
                            <br>
                            <a class="btn btn-xs" wire:click="printFinal({{$research->id}})">
                                <i class="fa fa-print" style="color: blue">
                                </i>
                                <u> Print Final</u>
                            </a>
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
