<!-- Modal -->
<div wire:ignore.self class="modal fade" id="importSubjectModal">
    <div class="modal-dialog modal-dialog-scrollable" >
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importStudent">Import subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div wire:ignore class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="program" class="control-label">Study Program</label>
                    </div>
                    <div class="col-md-8 offset-md-0">
                        <div class="form-group">

                            <select class="program" id='program' style='width: 260px;' name="program">
                            </select>

                            @error('program') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="fileSubject">Excel File</label>
                    </div>
                    <div class="col-md-7 offset-md-0">
                        <input type="file" wire:model="fileSubject" class="form-controll">
                        <br>
                        @error('fileSubject') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-1 offset-md-0">
                        <button type="button" wire:click.prevent="submitSubjects" class="btn btn-sm" ><i class="fa fa-arrow-circle-up"></i></button>
                    </div>
                </div>
            <div class="modal-footer">
            </div>

       </div>
    </div>
</div>
