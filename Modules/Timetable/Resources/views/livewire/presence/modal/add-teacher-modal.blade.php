<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addTeacherModal">
    <div class="modal-dialog  modal-dialog-scrollable" >
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTeacher">Add Teacher</h5>
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
                                    <button wire:click="removeTeacher({{ $teacher->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-minus" style ="color:red" aria-hidden="true"></i></button>
                                    <br>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-5 offset-md-0">
                        <input wire:model="searchFaculty" type="text" class="form-control my-3" placeholder="Search faculty name">
                    </div>
                </div>
                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead">
                        <tr>
                            <th width="10%">Code</th>
                            <th width="40%">Name</th>
                            <th width="20%">Status</th>
                            <th class="text-right" width="30%">Action</th>

                        </tr>
                        </thead>
                        <tbody id="users-table">
                            @foreach ($faculties as $faculty)
                            <tr>
                                <td>
                                    {{$faculty->code}}
                                </td>
                                <td>
                                    {{$faculty->first_name}} {{$faculty->last_name}}
                                </td>
                                <td>
                                    Status
                                </td>


                                <td class="text-right">
                                <button wire:click="assignTeacher({{ $faculty->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-plus" style ="color:green" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$faculties->links()}}

                
            <div class="modal-footer">
            </div>

       </div>
    </div>
</div>
