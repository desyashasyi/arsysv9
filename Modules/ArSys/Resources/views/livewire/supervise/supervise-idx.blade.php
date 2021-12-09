<div>
        <i class="fas fa-spinner"></i><b> Progress of Supervision</b>
        <hr>
        @foreach($research->supervisor as $supervisor)
            @if($supervisor->faculty->code != 'EXT')
                <div class="row">
                    <div class="col-md offset-md-0">
                        <i class="text-success">{{$supervisor->faculty->code}}</i>
                        @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'SE')->first()->id ||
                            $research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'PI')->first()->id)
                            @if($research->research_milestone != 0 && $research->research_milestone != 10)
                                <button wire:click="$emit('researchCreateSuperviseComponent', {{$supervisor->id}})" class="btn btn-sm"><i class="fas fa-plus-circle"></i> Add Meeting</button>
                            @endif
                        @endif
                        @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'TA')->first()->id ||
                            $research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'SK')->first()->id ||
                            $research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'TM')->first()->id ||
                            $research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'DD')->first()->id)
                            @if($research->research_milestone != 0 && $research->research_milestone != 17)
                                <button wire:click="$emit('researchCreateSuperviseComponent', {{$supervisor->id}})" class="btn btn-sm"><i class="fas fa-plus-circle"></i> Add Meeting</button>
                            @endif
                        @endif

                        @if($supervisor->bypass === 1)
                            <i class="fa fa-check fa-xs" style ="color:green" aria-hidden="true"></i> bypass
                        @else
                            <i class="fa fa-ban fa-xs" aria-hidden="true" style ="color:red"></i> bypass
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
                                    <a style="cursor:pointer; color:blue" wire:click="$emit('superviseDiscussionComponent', {{$supervise->id}})">
                                    <u>{{ \Carbon\Carbon::parse($supervise->created_at)->format('d-m-Y') }}</u>
                                    </a>

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
    @livewire('arsys::supervise.create')
    @livewire('arsys::supervise.discussion')
</div>
