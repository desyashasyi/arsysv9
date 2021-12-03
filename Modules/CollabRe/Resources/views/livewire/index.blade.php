@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>CollabRe</b> | Research Collaboration
                </div>
                <div class="card-body">
                    @if(Auth::user()->hasRole('faculty'))
                        @livewire('collabre::front.founder')
                    @elseif(Auth::user()->hasRole('student'))
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
