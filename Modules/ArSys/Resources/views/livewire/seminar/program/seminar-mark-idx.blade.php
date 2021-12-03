@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Seminar | Mark of seminar
                </div>
                <div class="card-body">
                    @livewire('arsys::seminar.program.seminar-mark')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

