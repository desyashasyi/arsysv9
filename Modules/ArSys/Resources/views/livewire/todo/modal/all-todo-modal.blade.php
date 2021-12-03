<!-- Modal -->
<div wire:ignore.self class="modal fade" id="allTodoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" style="width: 100%; height: 100%; overflow-y: scroll; overflow-x: hidden">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Research To-do's</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" >

                <div class="row">
                    <div class="col-md-6 border-right offset-md-0">
                        <h3><i class="fas fa-tasks"></i><b> To-do List</b>
                            <button wire:click="$emit('createTodoComponent', {{$researchId}})" class="btn"><i class="fas fa-plus-circle"></i> Add</button>
                        </h3>
                        <br>
                        @if($todoResearch != null)
                            @if($todoResearch->todo != null)
                                @php($counter = 0)
                                @foreach($todoResearch->todo as $todo)
                                    @php(++$counter)
                                    <i class="fa fa-check-square fa-sm" style ="color:gray" aria-hidden="true"></i>
                                    <a href="#" wire:click="showTodo({{$todo->id}})">
                                    <u>{{$todo->todo_title}}</u>
                                    </a>
                                    <br>
                                @endforeach
                            @endif

                            @if($todoResearch->completedtodo != null)
                                @php($counter = 0)
                                @foreach($todoResearch->completedtodo as $todo)
                                    @php(++$counter)
                                    <i class="fa fa-check-square fa-sm" style ="color:green" aria-hidden="true"></i>
                                    <a href="#" wire:click="showTodo({{$todo->id}})">
                                    <u>{{$todo->todo_title}}</u>
                                    </a>
                                    <br>
                                @endforeach
                            @endif
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($singleTodo != null)
                            @include('arsys::livewire.message.message')
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 offset-md-0">
                                                @if($singleTodo->completed)
                                                    <button class="btn" wire:click="todoUncompleted({{$singleTodo->id}})"> <i class="fa fa-check-square" style ="color:green"></i>
                                                    </button>
                                                @else
                                                    <button class="btn" wire:click="todoCompleted({{$singleTodo->id}})"> <i class="fa fa-check-square" style ="color:gray"></i>
                                                    </button>
                                                @endif

                                                <button class="btn" wire:click="todoEdit({{$singleTodo->id}})"> <i class="fa fa-edit"> </i>
                                                </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 offset-md-0">
                                            <h3>
                                            @if($singleTodo->completed)
                                                <i class="fa fa-check-circle" style ="color:green" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-check-circle" style ="color:gray" aria-hidden="true"></i>
                                            @endif
                                            <b> {{$singleTodo->todo_title}}</b></h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 offset-md-0">

                                                <i>created by:
                                                    @if($singleTodo->creator_type === 1)
                                                        <b class="text-primary">{{$singleTodo->faculty->first_name}} {{$singleTodo->faculty->last_name}}</b>
                                                    @elseif($singleTodo->creator_type === 2)
                                                        <b class="text-primary">{{$singleTodo->student->first_name}} {{$singleTodo->student->last_name}}</b>
                                                    @endif

                                                    on
                                                    {{ \Carbon\Carbon::parse($singleTodo->created_at)->format('l,') }}
                                                    {{ \Carbon\Carbon::parse($singleTodo->created_at)->format('d F Y') }}
                                                    {{ \Carbon\Carbon::parse($singleTodo->created_at)->format('H:i') }}
                                                </i>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 offset-md-0">
                                            &nbsp;
                                        </div>
                                        <div class="col-md-11 offset-md-0">
                                                {{$singleTodo->todo_notes}}
                                                <br>
                                                @if($singleTodo->document_file != null)
                                                    <br>Document File: <a href="{{url('/')}}{{ Storage::disk('local')->url($singleTodo->document_file)}}" target="_blank">Todo {{$singleTodo->id}}{{$discussion->id}}{{$discussion->file->id}}</a>
                                                @endif
                                                @if($singleTodo->url != null)
                                                    br>Document Url: <a href="{{$singleTodo->url}}" target="_blank">Todo {{$singleTodo->id}}{{$discussion->id}}{{$discussion->url->id}}</a>
                                                @endif
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 offset-md-0" style="width: 100%; height: 340px; overflow-y: scroll; overflow-x: hidden">
                                            @if($singleTodo->discussion != null)
                                                @foreach($singleTodo->discussion as $discussion)
                                                    <div class="row">
                                                        <div class="col-md-1 offset-md-0">
                                                            &nbsp;
                                                        </div>
                                                        <div class="col-md-11 offset-md-0">
                                                            <b class="text-primary">
                                                            @if($discussion->discussant_type === 1)
                                                                {{$discussion->faculty->first_name}}  {{$discussion->faculty->last_name}}
                                                            @elseif($discussion->discussant_type === 2)
                                                                {{$discussion->student->first_name}} {{$discussion->student->last_name}}
                                                            @endif
                                                            </b>
                                                            |
                                                            <i>
                                                                {{ \Carbon\Carbon::parse($discussion->created_at)->format('d-m-Y') }}
                                                                {{ \Carbon\Carbon::parse($discussion->created_at)->format('H:i') }}
                                                            </i>
                                                            <br>
                                                            {{$discussion->todo_discussion_notes}}
                                                            <br>
                                                            @if($discussion->file != null)
                                                                <br>Document File: <a href="{{url('/')}}{{ Storage::disk('local')->url($discussion->file->todo_discussion_file)}}"target="_blank">Todo {{$singleTodo->id}}{{$discussion->id}}{{$discussion->file->id}}</a>
                                                            @endif
                                                            @if($discussion->url != null)
                                                                <br>Document Url: <a href="{{$discussion->url->todo_discussion_url}}" target="_blank">Todo {{$singleTodo->id}}{{$discussion->id}}{{$discussion->url->id}}</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            @endif
                                            <form>

                                                <div class="form-group">
                                                    <label for="todoDiscussionNotes">Notes</label>
                                                    <textarea type="text" rows="3" class="form-control" wire:model="todoDiscussionNotes" id="todoDiscussionNotes" placeholder="Enter notes"></textarea>
                                                    @error('todoDiscussionNotes') <span class="text-danger">{{ $message }}</span>@enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="todoDiscussionUrl">Document URL</label>
                                                    <input type="text" class="form-control" wire:model="todoDiscussionUrl" id="todoDiscussionUrl" placeholder="Enter document url">
                                                    @error('todoDiscussionUrl') <span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="todoDiscussionFile">Document file</label>
                                                    <br>
                                                    <input type="file" wire:model="todoDiscussionFile" placeholder="Please enclose file">
                                                    @error('todoDiscussionFile') <span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </form>
                                            <hr>
                                            <button type="button" wire:click.prevent="todoDiscussionStore({{$todoId}})" class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i> Submit notes</button>
                                            <hr>
                                    </div>

                                </div>
                            </div>





                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
       </div>
    </div>
</div>
