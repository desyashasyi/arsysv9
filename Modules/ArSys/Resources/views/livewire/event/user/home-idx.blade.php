@extends('adminlte::page')

@section('title', 'ArSys')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-sm-0">
            <div class="card">

                <div class="card-header">
                <b>Event</b> | List of event
                </div>
                <div class="card-body">
                    @livewire('arsys::event.user.home')
                </div>

                <div class="card-footer">
                </div>

            </div>
        </div>

    </div>
</div>
@endsection










