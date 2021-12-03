<!-- Modal -->
<div wire:ignore.self class="modal fade" id="researchCreateModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Research</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('arsys::livewire.message.message')
                <div class="row">
                </div>
                <form>
                    <div class="form-group" wire:ignore>
                        <label for="researchFile">Research Type</label>
                        <br>
                        <select id='researchType' style='width: 250px;'>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="researchFile">Title</label>
                        <br>
                        <textarea rows="2" wire:model = "researchTitle" class="form-control">fafsafasfa</textarea>
                        @error('researchTitle') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="researchFile">Abstract</label>
                        <label for="researchFile">Abstract</label>
                    <p class="text-danger">Due to unresolved bug, hence the file uploader now is deactivated.
                        For proposal review purposes, please upload your proposal to google drive and then attach the link to this abstract
                        <br>
                        <br>
                        NOTE: Make sure that your proposal could be accessed when necessary, otherwise it would not be processed
                    </p>
                        <br>
                        <textarea rows="3" wire:model = "researchAbstract" class="form-control"></textarea>
                        @error('researchAbstract') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="researchFile">File</label>
                        <br>
                        <input type="file" wire:model="researchFile">
                        <br>
                        @error('researchFile') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="researchStore" class="btn btn-success btn-sm" ><i class="fa fa-paper-plane"></i> Submit</button>
            </div>

       </div>
    </div>
</div>
