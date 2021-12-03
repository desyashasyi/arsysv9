@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Event | Upcoming events
                </div>
                <div class="card-body">
                    @livewire('arsys::event.faculty.upcoming')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

