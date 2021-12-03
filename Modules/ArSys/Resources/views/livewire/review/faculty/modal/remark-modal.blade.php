<!-- Modal -->

<div wire:ignore.self class="modal fade" id="submitReviewFacultyRemarkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitReviewFacultyRemarkModal">Final Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        <div class="form-group">
                            <label for="finalRemark">Remark</label>
                            <br>
                            <textarea rows="3" wire:model = "finalRemark" class="form-control"></textarea>
                            @error('finalRemark') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        <button wire:click="submitFinalRemark"class="btn btn-sm btn-primary">
                            <i class="fa fa-plus-circle"></i>
                            Submit
                        </button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>
</div>
