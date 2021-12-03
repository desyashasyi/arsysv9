
<div wire:ignore.self class="modal fade" id="reviewDiscussionModal_Student" tabindex="-1" role="dialog" aria-labelledby="reviewDiscussionModal_Student" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewDiscussionModal_Student">Discussion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('arsys::livewire.message.message')
                    @if($research != null)
                        <div class="row">
                            <div class="col-md-12 offset-md-0">
                                {{$research->code}} |
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 offset-md-0" style="width: 100%; height: 280px; overflow-y: scroll; overflow-x: hidden">

                                @if($research->reviewDiscussion != null)
                                    @foreach($research->reviewDiscussion as $discussion)
                                        <div class="row">
                                            <div class="col-md-1 offset-md-0">
                                            </div>
                                            <div class="col-md-1.5 offset-md-0">
                                                @if($discussion->discussant_type == 1)
                                                    <b style="color:blue">{{$discussion->faculty->code}}</b>
                                                @else
                                                    <b style="color:red">{{$discussion->student->first_name}}</b>
                                                @endif
                                                    :
                                            </div>
                                            <div class="col-md-9 offset-md-0">
                                                <i>{{$discussion->message}}</i>

                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12 offset-md-0">
                            <div class="row">
                                <div class="col-md-12 offset-md-0">
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <br>
                                        <textarea rows="3" wire:model = "comment" class="form-control"></textarea>
                                        @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 offset-md-0">
                                    <button wire:click="submitComment"class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-circle"></i>
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>
</div>
