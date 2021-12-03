@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>FET Management</b> | Exporter for FET
                </div>
                <div class="card-body">
                    @livewire('timetable::fet.admin.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

