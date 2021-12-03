@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Profile | Duty of faculty member
                </div>
                <div class="card-body">
                    @livewire('arsys::profile.admin.faculty-duty-management')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



