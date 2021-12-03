@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    Review | New research proposal
                </div>
                <div class="card-body">
                    @livewire('arsys::review.specialization.proposal.home')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
