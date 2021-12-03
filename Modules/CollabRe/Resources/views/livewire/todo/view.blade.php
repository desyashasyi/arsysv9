<div>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('collabre.index')!!}">
                <u><i>{{$todo->list->collabre->name}}</i></u> 
            </a>
             > 
            <a href="{!! route('collabre.todo.directory', ['collabre_id'=>$todo->list->collabre_id]) !!}">
                <u><i>To-do List</i></u>
            </a>
            >
            <a href="{!! route('collabre.todo.personal', ['list_id' => $todo->list_id]) !!}">
                <u><i>To-do</i></u>
            </a>
            
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="text-left col-md-12">
            <div class="row">
                <div class="text-right col-md-3">
                    Added by
                </div>
                <div class="text-left col-md-9">
                </div>
            </div>
            <div class="row">
                <div class="text-right col-md-3">
                    Added by
                </div>
                <div class="text-left col-md-9">
                </div>
            </div>
            <div class="row">
                <div class="text-right col-md-3">
                    Added by
                </div>
                <div class="text-left col-md-9">
                </div>
            </div>
            <div class="row">
                <div class="text-right col-md-3">
                    Added by
                </div>
                <div class="text-left col-md-9">
                </div>
            </div>
            
        </div>
    </div>
</div>
