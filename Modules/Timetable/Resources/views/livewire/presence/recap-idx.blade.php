@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Lectures | Presence recap
                </div>
                <div class="card-body">
                    @livewire('timetable::presence.recap', ['lecture_id' => $id])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection