<div>
<style>
    .form-control {
        border: 0;
    }
</style>
<div>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('collabre.index')!!}">
                <u><i>{{$collabre->name}}</i></u> 
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="text-right col-md-12">
            <button type="button" wire:click="enableNewList" class="btn btn-default btn-sm">
                <i class="fa fa-sm fa-plus-circle" aria-hidden="true"></i>
                New List
            </button>
        </div>
    </div>
    <hr>
    @if($newListFlag)
        
                        <div class="row">
                            <div class="text-right col-sm-12">
                                <button type="button" wire:click="disableNewList" class="btn btn-xs">
                                    <i class="fa fa-window-close" style="color: red"></i> Cancel
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-left col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="text-left col-md-12">
                                                <input class="form-control" wire:model="newList" aria-describedby="newList" placeholder="New to-do list...">
                                                @error('newList') <span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        
                                        <div>
                                            <div style="color:grey; cursor:pointer" wire:click="enableTrixEditor">
                                            @if($enableTrixEditor)
                                                <livewire:collabre::editor.trix :value="$description">
                                            @else
                                                Add extra detail...
                                            @endif
                                            </div>
                                            <br>
                                            <button type="button" wire:click="submitNewList" class="btn btn-default btn-sm">
                                                <i class="fa fa-sm fa-save" aria-hidden="true"></i>
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

    @endif
    @foreach($todoLists as $number => $list)
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
                <a class="btn btn-xs" wire:click="personalTodo({{$list->id}})"> 
                    <i class="fa fa-plus-circle" style="color: green"></i>  
                    View
                </a>
                @if($listId != $list->id)
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
                
            
                @if($addTodo && $listId == $list->id)
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
                            {{$todo->title}}
                            <button class="btn btn-xs" wire:click="viewTodo({{$todo->id}})"><i class="fas fa-sticky-note"></i></button>
                            <button class="btn btn-xs" wire:click="viewTodo({{$todo->id}})"><span class="badge badge-pill badge-info">1</span></button> 

                            <br>
                        @endif
                    @endforeach
                    @endif
                    </div>
                </div>

                

            </div>
        </div>
        <hr>
    @endforeach
</div>

