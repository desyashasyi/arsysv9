<div>
    {{-- livewire view --}}
    <i class="fas fa-tasks"></i><b> To-do List</b>

                                                                                    @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'SE')->first()->id ||
                                                                                        $research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'PI')->first()->id)

                                                                                                @if($research->research_milestone != 10 && $research->research_milestone != 0)
                                                                                                <button wire:click="$emit('createTodoComponent', {{$research->id}})" class="btn btn-sm "><i class="fas fa-plus-circle"></i> Add</button>

                                                                                                @endif
                                                                                            @endif
                                                                                    @if($research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'TA')->first()->id ||
                                                                                        $research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'SK')->first()->id ||
                                                                                        $research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'TM')->first()->id ||
                                                                                        $research->research_type == \Modules\ArSys\Entities\ResearchType::where('code', 'DD')->first()->id)
                                                                                                @if($research->research_milestone != 0 && $research->research_milestone != 17)
                                                                                                <button wire:click="$emit('createTodoComponent', {{$research->id}})" class="btn btn-sm "><i class="fas fa-plus-circle"></i> Add</button>

                                                                                                @endif
                                                                                            @endif
                                                                                    <br>
                                                                                    @if($research->todo != null)
                                                                                        @php($counter = 0)
                                                                                        @foreach($research->todo as $todo)
                                                                                            @if($counter < 2)
                                                                                                @php(++$counter)
                                                                                                    <button class="btn btn-sm" wire:click="$emit('todoCompleted', {{$todo->id}})"> <i class="fa fa-check-square fa-sm" style ="color:gray" aria-hidden="true"></i>
                                                                                                    </button>
                                                                                                    <a href="#" wire:click="$emit('singleTodoComponent', {{$todo->id}})">
                                                                                                        <u>{{$todo->todo_title}}</u>
                                                                                                    </a>
                                                                                                    <br>
                                                                                            @endif
                                                                                        @endforeach
                                                                                        @if($research->todo->count() > 2)
                                                                                            <a href="#" wire:click="$emit('allTodoComponent', {{$research->id}})">
                                                                                            <u>And more {{$research->todo->count()-$counter}} uncompleted todo...</u>
                                                                                            </a>
                                                                                        @endif
                                                                                        <br>
                                                                                    @endif

                                                                                    @if($research->completedtodo != null)
                                                                                        @php($counter = 0)
                                                                                        @foreach($research->completedtodo as $todo)

                                                                                            @if($counter < 2)
                                                                                                @php(++$counter)
                                                                                                    <button class="btn btn-sm" wire:click="$emit('todoUncompleted', {{$todo->id}})"> <i class="fa fa-check-square fa-sm" style ="color:green" aria-hidden="true"></i>
                                                                                                    </button>
                                                                                                    <a href="#" wire:click="$emit('singleTodoComponent', {{$todo->id}})">
                                                                                                        <u>{{$todo->todo_title}}</u>
                                                                                                    </a>
                                                                                                    <br>
                                                                                            @endif
                                                                                        @endforeach
                                                                                        @if($research->completedtodo->count() > 2)
                                                                                            <a href="#" wire:click="$emit('allTodoComponent', {{$research->id}})">
                                                                                            <u>And more {{$research->completedtodo->count()-$counter}} completed todo...</u>
                                                                                            </a>
                                                                                        @endif
                                                                                        <br>
                                                                                    @endif
                                                                                    
    @livewire('arsys::todo.create')
    @livewire('arsys::todo.all-to-do')
    @livewire('arsys::todo.single-to-do')
</div>
