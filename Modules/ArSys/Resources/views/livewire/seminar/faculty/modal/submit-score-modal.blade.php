<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="submitSeminarScoreModal" tabindex="-1" role="dialog" aria-labelledby="defenseFacultySubmitScoreModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitSeminarScoreModal">Seminar Score</h5>
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
                                    <br>
                                    <br>
                                    <b>Score:</b>
                                @endif
                            </div>
                        </div>
                        <br>
                        <b>Guidance of Student Mark</b>
                        @if($scoreGuide != null)
                            <div class="row">
                                <div class="col-md-12 offset-md-0" style="width: 100%; height: 120px; overflow-y: scroll; overflow-x: hidden">
                                    <div class="table-responsive users-table">
                                        <table class="table table-striped table-sm data-table">
                                            <thead class="thead">
                                            <tr>
                                                <th width="15%">Code</th>
                                                <th width="30%">Value</th>
                                                <th width="45%">Description</th>
                                            </tr>
                                            </thead>
                                            <tbody id="users-table">
                                                @foreach($scoreGuide as $score)
                                                    <tr>
                                                        <td>
                                                            {{$score->code}}
                                                        </td>
                                                        <td>
                                                            {{$score->value}}
                                                        </td>
                                                        <td>
                                                            {{$score->description}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
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

                        <div class="row">
                            <div class="col-md-4 offset-md-0">
                                <label for="score">Seminar's note</label>
                            </div>
                            <div class="col-md-7 offset-md-0">
                                <div class="form-group">
                                    <textarea type="text" class="form-control" wire:model="seminarNote" id="seminarNote"></textarea>
                                    @error('seminarScore') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    @if($scoreId != null)
                        <a class="btn btn-sm btn-sucess" wire:click="store({{$scoreId}})"><i class="fa fa-paper-plane" style="color:green" aria-hidden="true"></i>
                            Submit
                        </a>
                    @endif
                </div>
        </div>
        </div>
    </div>


</div>




