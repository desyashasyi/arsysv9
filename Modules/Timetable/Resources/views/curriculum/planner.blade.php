@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Timetable | Curriculum
                </div>
                <div class="card-body">
                    @livewire('timetable::curriculum.planner')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')