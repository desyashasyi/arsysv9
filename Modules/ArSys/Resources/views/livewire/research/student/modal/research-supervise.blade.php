<!-- Modal -->
<div wire:ignore.self class="modal fade" id="proposeSuperviseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supervision Proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $message }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="supervisor">Supervisor</label>
                <input type="text" class="form-control" wire:model="supervisor" readonly>
                </div>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="submitSupervisionProposal" class="btn btn-primary btn-sm" >Submit</button>
                <button type="button" wire:click.prevent="closeModal" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
       </div>
    </div>
</div>
