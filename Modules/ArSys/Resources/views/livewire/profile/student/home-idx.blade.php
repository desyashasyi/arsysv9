@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Profile | Student Profile
                </div>
                <div class="card-body">
                    @livewire('arsys::profile.student.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



