<!-- Modal -->
<div wire:ignore.self class="modal fade" id="researchCreateSuperviseModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Supervise History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('arsys::livewire.message.message')

                @if($user->hasRole('student'))
                    <div class="form-group">
                        <label for="supervisor">Supervisor</label>
                    <input type="text" class="form-control" wire:model="supervisor" readonly>
                    </div>
                @endif
                <form>
                    <div class="form-group">
                        <input type="hidden" wire:model="supervisorId">
                        <label for="supervisionTopic">Topic</label>
                        <input type="text" class="form-control" wire:model="supervisionTopic" id="supervisionTopic" placeholder="Enter topic">
                        @error('supervisionTopic') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="supervisionMessage">Message</label>
                        <textarea row="3" class="form-control" wire:model="supervisionMessage" id="supervisionMessage" placeholder="Write your message"></textarea>
                        @error('supervisionMessage') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <hr>

                    @if($user->hasRole('faculty'))
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" wire:model="shareDiscussion">
                            <label class="form-check-label" for="shareDiscussion">Share with other supervisor?</label>
                        </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="superviseStore" class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i> Submit</button>
            </div>
       </div>
    </div>
</div>
