<!-- Modal -->
<div wire:ignore.self class="modal fade" id="reviewSetExternalSupervisorModal" tabindex="-1" role="dialog" aria-labelledby="reviewSetExternalSupervisorModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewSetExternalSupervisorModal">Assignment of External Supervisor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        <div class="form-group">
                            <label for="externalSupervisor">External Supervisor</label>
                            <br>
                            <textarea rows="1" wire:model = "externalSupervisor" class="form-control"></textarea>
                            @error('externalSupervisor') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        <div class="form-group">
                            <label for="externalInstitution">Institution of External Supervisor</label>
                            <br>
                            <textarea rows="1" wire:model = "externalInstitution" class="form-control"></textarea>
                            @error('externalInstitution') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-xs" wire:click="assignExternalSupervisor"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                </button>
            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>
</div>
