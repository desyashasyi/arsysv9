@extends('adminlte::page')

@section('title', 'ArSys')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-sm-0">
            <div class="card">

                <div class="card-header">
                <b>Event</b> | Event Administration
                </div>
                <div class="card-body">
                    @if(\Modules\ArSys\Entities\Event::where('id', $id)->first()->event_type ===
                        \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id
                        ||
                        \Modules\ArSys\Entities\Event::where('id', $id)->first()->event_type ===
                        \Modules\ArSys\Entities\EventType::where('abbrev', 'STE')->first()->id
                        ||
                        \Modules\ArSys\Entities\Event::where('id', $id)->first()->event_type ===
                        \Modules\ArSys\Entities\EventType::where('abbrev', 'PRA')->first()->id
                        )
                        @livewire('arsys::event.admin.seminar.applicant', ['event_id' => $id])
                    @elseif(\Modules\ArSys\Entities\Event::where('id', $id)->first()->event_type ===
                        \Modules\ArSys\Entities\EventType::where('abbrev', 'PRE')->first()->id
                        )
                        @livewire('arsys::event.admin.applicant', ['event_id' => $id])
                    @endif
                </div>

                <div class="card-footer">
                </div>

            </div>
        </div>

    </div>
</div>
@endsection










