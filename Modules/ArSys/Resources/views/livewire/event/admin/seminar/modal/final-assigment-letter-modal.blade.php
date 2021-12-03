<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="addFinalAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="eventAddLetterNumberModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFinalAssignmentModal">Add Assignment Letter</h5>
                    <button type="button" wire:click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div wire:ignore class="row">
                        <div class="col-md-12 offset-md-1">
                            <b>Study Program</b>
                            <div class="form-group">

                                <select class="study_program" id='programStudy' style='width: 260px;' name="study_program">
                                </select>

                                @error('study_program') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="text-left col-md-12 offset-md-1">
                            <b>File</b>
                            <form wire:submit.prevent="documentStore">
                                <input type="file" wire:model="documentFile">
                                <br>
                                @error('documentFile') <span class="text-danger">{{ $message }}</span> @enderror
                            </form>
                            <div wire:loading wire:target="documentFile" class="mx-auto text-xs">Uploading...</div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-sm" wire:click="documentStore"><i class="fa fa-paper-plane" style="color:green" aria-hidden="true"></i> Submit</a>
                </div>
        </div>
        </div>
    </div>

</div>




