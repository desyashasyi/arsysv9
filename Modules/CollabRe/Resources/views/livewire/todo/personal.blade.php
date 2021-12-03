<div>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('collabre.index')!!}">
                <u><i>{{$collabre->name}}</i></u> 
            </a>
             > 
            <a href="{!! route('collabre.todo.directory', ['collabre_id'=>$list->collabre_id]) !!}">
                <u><i>To-do List</i></u>
            </a>
            
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="text-left col-md-12">
            
            @if($list->compeletedtodo)
            {{$list->compeletedtodo->count()}}
            @else
            0
            @endif
            / {{$list->todo->count()}} completed
            <br>
            <b>{{$list->title}}</b>
            @if(!$addTodo)
                <a class="btn btn-xs" wire:click="enableTodo({{$list->id}})"> 
                    <i class="fa fa-plus-circle" style="color: green"></i>  
                    Add to-do
                </a>
            @endif

            <div class="row">
                <div class="text-left col-md-11 offset-0">
                @if($list->todo != null)
                @foreach ($list->todo as $todo)
                    @if(!$todo->completed)
                        <button wire:click="completeTodo({{$todo->id}}, 1)" class="btn btn-xs"><i class="fa fa-check-circle" aria-hidden="true" style="color: gray"></i></button>
                        {{$todo->title}}
                        <br>
                    @endif
                @endforeach
                @endif
                </div>
            </div>
            
        
            @if($addTodo)
                <div class="row">
                    <div class="text-right col-sm-12">
                        <button type="button" wire:click="disableTodo" class="btn btn-xs">
                            <i class="fa fa-window-close" style="color: red"></i> Cancel
                        </button>
                    </div>
                </div>
                
                <div class="row">
                    <div class="text-left col-md-11 offset-0">
                        @livewire('collabre::todo.add')
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="text-left col-md-11 offset-0">
                @if($list->todo != null)
                @foreach ($list->todo as $todo)
                    @if($todo->completed)
                    <button wire:click="completeTodo({{$todo->id}}, 0)" class="btn btn-xs"><i class="fa fa-check-circle" aria-hidden="true" style="color: green"></i></button>
                        {{$todo->title}} <button class="btn btn-xs" wire:click="viewTodo({{$todo->id}})"><i class="fas fa-sticky-note"></i></button> 
                        <br>
                    @endif
                @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
