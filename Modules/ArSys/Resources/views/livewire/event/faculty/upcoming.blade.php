<div>
    @if($events != null)
        {{$events->render()}}
        @foreach($events as $event)
            @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id
            ||
            $event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'STE')->first()->id
            )
                 <div class="row">
                    <div class="col-md-12 offset-md-0">
                        <b><i>
                        {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('l,') }}
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                        </i></b>
                    </div>
                </div>
                @include('arsys::livewire.event.faculty.upcoming-seminar', ['id' => $event->id])
            @endif
            <br>
            @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PRE')->first()->id)
               @include('arsys::livewire.event.faculty.upcoming-defense', ['id' => $event->id])
            @endif
        @endforeach
        {{$events->render()}}
    @else
        There is no upcoming event
    @endif
</div>
