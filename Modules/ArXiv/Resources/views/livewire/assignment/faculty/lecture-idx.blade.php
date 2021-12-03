<div>
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <b>ArXiv</b> | Assignment of Lecture
                    </div>
                    <div class="card-body">
                        @livewire('arxiv::assignment.faculty.lecture')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>
