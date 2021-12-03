<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="adminSeminarExaminerModal" tabindex="-1" role="dialog" aria-labelledby="adminSeminarExaminerModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminSeminarExaminerModal">Add Examiner</h5>
                    <button wire:click = "closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                </div>

                <div class="modal-body">
                    <div>
                        @if($room != null)
                            <div class="row">
                                <div class="table-responsive users-table">
                                    <table class="table table-striped table-sm data-table">
                                        <thead class="thead">
                                        <tr>
                                            <th width="10%">Code</th>
                                            <th width="30%">Schedule</th>
                                            <th width="15%">Moderator</th>
                                            <th width="45%">Participant</th>
                                        </tr>
                                        </thead>
                                        <tbody id="users-table">
                                            <tr>
                                                <td>
                                                    {{$room->room_code}}
                                                </td>
                                                <td>
                                                    @if($room->session != null)
                                                        {{$room->session->time}}
                                                    @endif
                                                    <br>
                                                    <br>
                                                    @if($room->space != null)
                                                        {{$room->space->space}}
                                                        <br>
                                                        {{$room->space->passcode}}
                                                    @endif
                                                </td>

                                                <td>
                                                    <b>Moderator</b>
                                                    <br>
                                                    @if($room->moderator != null)
                                                        @foreach($room->moderator as $moderator)
                                                            {{$moderator->faculty->code}}
                                                            <br>
                                                        @endforeach
                                                    @endif
                                                    <br>
                                                    <br>
                                                    <b>Examiner</b><br>
                                                    @foreach($room->examiner as $examiner)
                                                        {{$examiner->faculty->code}}
                                                        <br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($room->applicant as $applicant)
                                                        {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                                                        <br>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr>
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
                            @if($faculties != null)
                                {{$faculties->links()}}
                            @endif
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




