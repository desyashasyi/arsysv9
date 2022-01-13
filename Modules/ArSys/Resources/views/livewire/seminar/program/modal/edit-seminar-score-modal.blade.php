<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="editSeminarScoreModal_Program" tabindex="-1" role="dialog" aria-labelledby="defenseFacultySubmitScoreModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSeminarScoreModal_Program">Supervisor Seminar Score | Program</h5>
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
                                    | {{$applicant->research->research_code}}
                                    <br>
                                    <br>
                                    <i>{{$applicant->research->title}}</i>
                                   
                                @endif
                            </div>
                        </div>
                        <br>
                        
                        <br>
                        <div class="row">
                            <div class="col-md-4 offset-md-0">
                                <label for="score"> Student's mark</label>
                            </div>
                            <div class="col-md-5 offset-md-0">
                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="seminarScore" id="seminarScore" placeholder="Enter student's mark">
                                    @error('seminarScore') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        
                    @endif
                </div>
                <div class="modal-footer">
                    @if($scoreSupervisorId != null)
                        <a class="btn btn-sm btn-sucess" wire:click="storeSupervisor({{$scoreSupervisorId}})"><i class="fa fa-paper-plane" style="color:green" aria-hidden="true"></i>
                            Submit
                        </a>
                    @endif
                </div>
        </div>
        </div>
    </div>


</div>




