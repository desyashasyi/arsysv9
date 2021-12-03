<!-- Modal -->
<div wire:ignore.self class="modal fade" id="importStudentModal">
    <div class="modal-dialog  modal-dialog-scrollable" >
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importStudent">Import student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if($lecture != null)
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <b>Subject</b>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            {{$lecture->subject_code}} | {{$lecture->subject_name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <b>Class & University</b>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            {{$lecture->class}} | {{$lecture->university}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <b>Teachers</b>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            @if($lecture->teacher != null)
                                @foreach($lecture->teacher as $teacher)
                                    {{$teacher->faculty->first_name}} {{$teacher->faculty->last_name}}
                                    <br>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="fileStudent">Excel File</label>
                    </div>
                    <div class="col-md-7 offset-md-0">
                        <input type="file" wire:model="fileStudent" class="form-controll">
                    </div>
                    <div class="col-md-1 offset-md-0">
                        <button type="button" wire:click.prevent="submitStudents" class="btn btn-warning btn-sm" ><i class="fa fa-paper-plane"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        @error('fileStudent') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <br>
                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead">
                        <tr>
                            <th width="10%">No.</th>
                            <th width="30%">Student Number</th>
                            <th width="60%">Student Name</th>

                        </tr>
                        </thead>
                        <tbody id="users-table">
                            @php($number = 0)
                            @forelse($students as $student)
                                <tr>
                                    <td>
                                        {{++$number}}
                                    </td>
                                    <td>
                                        {{$student->student_number}}
                                    </td>
                                    <td>
                                        {{$student->student_name}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        No Data
                                    </td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
                @if(!$students->isEmpty())
                    {{$students->links()}}
                @endif
            <div class="modal-footer">
            </div>

       </div>
    </div>
</div>
