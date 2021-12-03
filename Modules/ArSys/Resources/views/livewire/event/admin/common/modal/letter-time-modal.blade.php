<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="eventLetterTimeModal" tabindex="-1" role="dialog" aria-labelledby="eventAddLetterNumberModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventLetterTimeModal">Detail of Dean Invitation Letter</h5>
                    <button type="button" wire:click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                </div>
                <div class="modal-body">


                    <div wire:ignore class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="study_program" class="control-label">Opening Room</label>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            <div class="form-group">

                                <select class="eventSpace" id='eventSpace' style='width: 260px;' name="eventSpace">
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="study_program" class="control-label">Date</label>
                        </div>
                        <div class="col-md-6 offset-md-0">
                            <p>{{$openingTime}}<p>
                            <div class="form-group">
                                <x-inputs.date id="letterDate" wire:model.debounce.0ms="letterDate" />
                                @error('letterDate') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-sm" wire:click="saveLetterNumber"><i class="fa fa-paper-plane" style="color:green" aria-hidden="true"></i> Submit</a>
                </div>
        </div>
        </div>
    </div>


</div>




