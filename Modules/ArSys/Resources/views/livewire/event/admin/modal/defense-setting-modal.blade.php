<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="adminApplicantDefenseSettingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminApplicantDefenseSettingModal">Defense Setting</h5>
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
                                                        <button type="button" wire:click.prevent="unAssignExaminer({{$examiner->id}})" class="btn btn-xs"><i class="fa fa-user-minus" style="color:red"></i></button>{{$examiner->faculty->first_name}} {{$examiner->faculty->last_name}}
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
                                            <b>Space</b>
                                            <br>
                                            @if($applicant->space != null)
                                                {{$applicant->space->space}}
                                            @endif

                                        </div>
                                    </div>

                                @endif
                            </div>

                        </div>
                    @endif


                    <hr>
                    <div class="row">

                        <div wire:ignore class="form-group row">
                            <div class="col-md-3 offset-md-0">
                                <label for="event_type" class="control-label">Event session</label>

                            </div>
                            <div class="col-md-6 offset-md-0">
                                <div class="form-group @if ($errors->has('sessionId')) has-error @endif">
                                    <select class="eventSessionDefense" id='eventSessionDefense' style='width: 350px;' name="eventSessionDefense">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div wire:ignore class="form-group row">
                            <div class="col-md-3 offset-md-0">
                                <label fclass="control-label">Event Space</label>
                            </div>
                            <div class="col-md-6 offset-md-0">
                                <div class="form-group @if ($errors->has('spaceId')) has-error @endif">
                                    <select class="eventSpace" id='eventSpace' style='width: 350px;' name="eventSpace">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('arsys::livewire.message.message')

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
                                    <th width="40%">Name</th>
                                    <th width="20%">Ex Counter</th>
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

                                            <td>
                                                {{$faculty->eventExaminer($eventId)}} -

                                                ({{$faculty->allEventExaminer($eventId)}})
                                            </td>

                                            <td class="text-right">
                                                <button type="button" wire:click.prevent="assignExaminer({{$faculty->id}})" class="btn btn-sm"><i class="fa fa-user-plus" style="color:green"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{$faculties->render()}}
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <!--
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary" data-dismiss="modal">Submit</button>
                    -->
                </div>
        </div>
        </div>
    </div>


</div>




