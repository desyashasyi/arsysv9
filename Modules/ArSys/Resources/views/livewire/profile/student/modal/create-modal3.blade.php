<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createStudentProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStudentProfileCreate">Create Student's Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="student_number">Student Number</label>
                        </div>
                        <div class="col-md-6 offset-md-0">
                            <div class="form-group">
                                <input type="text" class="form-control" wire:model="student_number" id="student_number" placeholder="Enter student number">
                                @error('student_number') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="study_program" class="control-label">Study Program</label>
                    </div>
                    <div class="col-md-8 offset-md-0">
                        <div class="form-group">

                            <select class="studyProgram" id='studyProgram' style='width: 260px;' name="study_program">
                            </select>

                            @error('study_program') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click="store" class="btn btn-sm btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
            </div>
       </div>
    </div>
</div>
