@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Research | Completed research
                </div>
                <div class="card-body">
                    @livewire('arsys::research.specialization.completed')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
