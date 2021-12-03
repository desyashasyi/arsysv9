<div>
    @livewire('arsys::utilities.admin.add-supervisor')
    @if($research->supervisortemp->count() == $research->type->supervisor_number && !$research->supervisortemp->contains('file', null))
        <i class="text-danger">
            Supervisor data has been updated, please be patient for admin to approve your supervisor submission.
        </i>
        <br>
        <br>
        Your supervisor are:
        <br>
        @php($count = 0)
        @foreach($research->supervisortemp as $supervisor)
            {{++$count}}.
            {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}
            <br>
        @endforeach

        <br> If there is a mistake submission, You could edit the supervisor data
        <button class="btn btn-primary btn-xs" wire:click="$emit('emiterUtilSetSupervisor', {{$research->id}})"><i class="fa fa-user-plus" aria-hidden="true"></i> Update</button>
        </button>
    @else

        Due to unknown situation, the supervisor data was missing from your research.<br>
        Hence, Please update the supervise data by
        <button class="btn btn-primary btn-xs" wire:click="$emit('emiterUtilSetSupervisor', {{$research->id}})"><i class="fa fa-user-plus" aria-hidden="true"></i> Update Supervisor</button>
        </button>
        <br>
        <b>if you have STE and Skripsi research, you should fill both of the research supervisor data.<br>
    @endif
</div>
