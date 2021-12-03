<!-- Modal -->
<div wire:ignore.self class="modal fade" id="superviseDiscussionModal" tabindex="-1" role="dialog" aria-labelledby="superviseDiscussionModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="superviseDiscussionModal">Supervise Discussion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('arsys::livewire.message.message')
                @if($supervise != null)
                        <b>{{$supervise->topic}}</b>
                        <br>
                        <i>{{$supervise->message}}</i>
                        <hr>

                        @foreach ($supervise->discussion as $discussion)
                            <div class="row">
                                <div class="col-md-1 offset-md-0">
                                    &nbsp;
                                </div>
                                <div class="col-md-11 offset-md-0">

                                    @if($discussion->discussant_role === \Modules\ArSys\Entities\Role::where('name', 'faculty')->first()->id)
                                        <b>{{$discussion->faculty->first_name}} {{$discussion->faculty->last_name}}</b>
                                    @else
                                        <b class="text-primary">{{$discussion->student->first_name}} {{$discussion->student->last_name}}</b>
                                    @endif

                                    | {{$discussion->created_at}}
                                    @if($discussion->discussant_id === $discussion->student->id)
                                        <button type="button" wire:click.prevent="deleteDiscussion({{$discussion->id}})" class="btn btn-sm"><i class="fa fa-trash" style ="color:red" aria-hidden="true"></i></button>
                                    @endif
                                    <br>
                                    {{$discussion->message}}


                                </div>
                            </div>
                            <hr>
                        @endforeach
                    <div class="form-group">
                        <textarea row="3" class="form-control" wire:model="discussionMessage" id="discussionMessage" placeholder="Write your message"></textarea>
                        @error('discussionMessage') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="discussionStore" class="btn btn-primary btn-sm" ><i class="fas fa-paper-plane"></i> Submit</button>
            </div>

       </div>
    </div>
</div>
