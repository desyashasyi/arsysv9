<!-- Modal -->
<div wire:ignore.self class="modal fade" id="importSubjectModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Subject</h5>
                <button type="button" wire:click = "closeModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-2 offset-md-0">
                        <label for="fileSubject">Excel File</label>
                    </div>
                    <div class="col-md-7 offset-md-0">
                        <input type="file" wire:model="fileSubject" class="form-controll">
                    </div>
                    <div class="col-md-3 offset-md-0">
                        <button type="button" wire:click.prevent="submitSubject" class="btn btn-warning btn-sm" ><i class="fa fa-file"></i> Upload</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        @error('fileSubject') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>
            <div class="modal-footer">
            </div>

       </div>
    </div>
</div>
