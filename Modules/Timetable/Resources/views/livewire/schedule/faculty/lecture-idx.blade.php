@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>Schedule</b> | Schedule of lectures
                </div>
                <div class="card-body">
                    @livewire('timetable::schedule.faculty.lecture')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

