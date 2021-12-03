<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="eventFacultyApplicantAddLetterNumberModal" tabindex="-1" role="dialog" aria-labelledby="eventFacultyApplicantAddLetterNumberModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventFacultyApplicantAddLetterNumberModal">Add Letter Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div wire:ignore class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="study_program" class="control-label">Study Program</label>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            <div class="form-group">

                                <select class="study_program" id='programStudy' style='width: 260px;' name="study_program">
                                </select>

                                @error('study_program') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="study_program" class="control-label">Number</label>
                        </div>
                        <div class="text-left col-md-6 offset-md-0">
                            <input wire:model="letterNumber" type="text" class="form-control" placeholder="Number of Letter">
                            @error('letterNumber') <span class="text-danger">{{ $message }}</span>@enderror

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="study_program" class="control-label">Date</label>
                        </div>
                        <div class="col-md-6 offset-md-0">
                            <p>{{$letterDate}}<p>
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




