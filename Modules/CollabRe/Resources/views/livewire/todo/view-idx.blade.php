@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>CollabRe</b> | Research Collaboration
                </div>
                <div class="card-body">
                    @livewire('collabre::todo.view', ['todo_id' => $todo_id])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
