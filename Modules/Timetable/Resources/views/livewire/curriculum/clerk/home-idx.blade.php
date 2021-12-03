@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Timetable | Dashboard
                </div>
                <div class="card-body">
                    @livewire('timetable::curriculum.clerk.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
