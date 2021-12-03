<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="defenseFacultyAddExaminerModal" tabindex="-1" role="dialog" aria-labelledby="defenseFacultyAddExaminerModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defenseFacultyAddExaminerModal">Add Examiner</h5>
                    <button wire:click = "closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                </div>
                <div class="modal-body">
                    @if($applicant != null)
                        <div class="row">
                            <div class="col-md-12 offset-md-0">
                                @if($applicant->research->student->program != null)
                                    {{$applicant->research->student->program->code}}.{{$applicant->research->student->student_number}}
                                    | {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                    <br>
                                    {{$applicant->research->research_code}}
                                    <br>
                                    <i>{{$applicant->research->title}}</i>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 offset-md-0">
                                            <b>Supervisor:</b>
                                            <br>
                                            @if ($applicant->research->supervisor != null)
                                                @foreach($applicant->research->supervisor as $supervisor)
                                                    {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}
                                                    <br>
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="col-md-6 offset-md-0">
                                            <b>Examiner:</b>
                                            <br>
                                            @if($applicant->examiner != null)
                                                    @foreach($applicant->examiner as $examiner)
                                                        {{$examiner->faculty->first_name}} {{$examiner->faculty->last_name}}
                                                        @if($examiner->addition == true)
                                                            <button type="button" wire:click.prevent="unAssignExaminer({{$examiner->id}})" class="btn btn-xs"><i class="fa fa-user-minus" style="color:red"></i></button>
                                                        @endif
                                                        <br>
                                                    @endforeach
                                            @endif

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6 offset-md-0">
                                            <b>Session</b>
                                            <br>
                                            @if($applicant->session != null)
                                                {{$applicant->session->time}}
                                            @endif
                                        </div>

                                        <div class="col-md-6 offset-md-0">
                                            <b>Media</b>
                                            <br>
                                            @if($applicant->space != null)
                                                Id: {{$applicant->space->space}}
                                                <br>
                                                Passcode: {{$applicant->space->passcode}}
                                            @endif

                                        </div>
                                    </div>

                                @endif
                            </div>

                        </div>
                    @endif
                    <br>
                    <div class="row">
                        <div class="col-md-5 offset-md-0">
                            <input wire:model="searchExaminer" type="text" class="my-1 form-control" placeholder="Search faculty name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th width="10%">Code</th>
                                    <th width="60%">Name</th>
                                    <th class="text-right" width="30%">Action</th>

                                </tr>
                                </thead>
                                <tbody id="users-table">
                                    @if($faculties != null)
                                        @foreach ($faculties as $faculty)
                                        <tr>
                                            <td>
                                                {{$faculty->code}}
                                            </td>
                                            <td>
                                                {{$faculty->first_name}} {{$faculty->last_name}}
                                            </td>


                                            <td class="text-right">
                                                <button type="button" wire:click.prevent="assignExaminer({{$faculty->id}})" class="btn btn-sm"><i class="fa fa-user-plus" style="color:green"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{$faculties->links()}}
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                </div>
        </div>
        </div>
    </div>


</div>




