@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>Subject</b> | Subject importer
                </div>
                <div class="card-body">
                    @livewire('timetable::subject.admin.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

