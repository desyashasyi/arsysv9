@extends('adminlte::page')

@section('title', 'ArSys')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-sm-0">
            <div class="card">

                <div class="card-header">
                <b>Event</b> | Event Presence
                </div>
                <div class="card-body">
                    @livewire('arsys::event.admin.defense.presence', ['id' => $id])
                </div>

                <div class="card-footer">
                </div>

            </div>
        </div>

    </div>
</div>
@endsection










