@extends('adminlte::page')

@section('title', 'ArSys')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 offset-sm-0">
            <div class="card">

                <div class="card-header">
                <b>Document</b> | Letter of application
                </div>
                <div class="card-body">
                    @livewire('arsys::document.clerk.application-letter')
                </div>

                <div class="card-footer">
                </div>

            </div>
        </div>

    </div>
</div>
@endsection










