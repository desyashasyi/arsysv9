<div wire:ignore.self class="modal fade" id="editModal">
    <div class="modal-dialog  modal-dialog-scrollable" >
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit">Edit Lecture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                        <label for="subject_code">Subject Code</label>
                        <br>
                        <input wire:model = "subject_code" class="form-control">
                        @error('subject_code') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="subject_name">Subject Name</label>
                        <br>
                        <input wire:model = "subject_name" class="form-control">
                        @error('subject_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="class">Class</label>
                        <br>
                        <input wire:model = "class" class="form-control">
                        @error('class') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="class">University</label>
                        <br>
                        <select wire:model = "university" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option value ="UPI" selected>UPI</option>
                            <option value="Tel-U">Tel-U</option>
                        </select>
                    </div>
                <div>
                <div class="modal-footer">
                <button type="button" wire:click.prevent="updateLecture" class="btn btn-warning btn-sm" ><i class="fa fa-paper-plane"></i> Update</button>
                </div>
            </div>

       </div>
    </div>
</div>