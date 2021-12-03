<div>
    @forelse($events as $event)
        @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id
                ||
                $event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'STE')->first()->id
            )
            @livewire('arsys::event.faculty.upcoming-seminar')
        @endif
        <br>
        @if($event->event_type == \Modules\ArSys\Entities\EventType::where('abbrev', 'PRE')->first()->id)
            @livewire('arsys::event.faculty.upcoming-defense')
        @endif
    @empty
        There is no upcoming event
    @endforelse
</div>
