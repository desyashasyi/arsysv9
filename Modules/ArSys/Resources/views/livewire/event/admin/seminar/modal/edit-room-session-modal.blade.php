<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="seminarAddRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seminarAddRoomModal">Add Seminar Room</h5>
                    <button type="button" wire:click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                    @if($rooms->isNotEmpty())
                        <div class="row">
                            <div class="table-responsive users-table">
                                <table class="table table-striped table-sm data-table">
                                    <thead class="thead">
                                    <tr>
                                        <th width="30%">Code</th>
                                        <th width="30%">Session</th>
                                        <th width="30%">Space</th>
                                        <th width="30%">Moderator</th>
                                        <th width="30%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="users-table">
                                        @foreach($rooms as $room)
                                        <tr>

                                            <td>
                                                {{$room->room_code}}
                                            </td>
                                            <td>
                                                @if($room->session != null)
                                                    {{$room->session->time}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($room->space)
                                                    {{$room->space->space}}
                                                    <br>
                                                    {{$room->space->passcode}}
                                                @endif

                                            </td>
                                            <td>
                                                @if($room->moderator != null)
                                                    @foreach($room->moderator as $moderator)
                                                        {{$moderator->faculty->code}}
                                                    @endforeach
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                    @endif
                    </div>
                    <div class="row">
                        <div wire:ignore class="form-group row">
                            <div class="col-md-3 offset-md-0">
                                <label for="event_type" class="control-label">Event session</label>

                            </div>
                            <div class="col-md-6 offset-md-0">
                                <div class="form-group @if ($errors->has('sessionId')) has-error @endif">
                                    <select class="eventSessionSeminar" id='eventSessionSeminar' style='width: 350px;' name="eventSessionSeminar">
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
                                <div class="form-group @if ($errors->has('eventSpace')) has-error @endif">
                                    <select class="eventSpace" id='eventSpace' style='width: 350px;' name="eventSpace">
                                    </select>
                                </div>
                                @error('eventSpace') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 offset-md-0">
                            <label fclass="control-label">Moderator</label>
                        </div>
                        <div class="col-md-6 offset-md-0">
                            <div class="form-group @if ($errors->has('moderatorId')) has-error @endif">
                            @if($moderator != null)
                                {{$moderator->first_name}} {{$moderator->last_name}}
                            @endif
                            <br>
                            <input wire:model="searchModerator" type="text" class="form-control" placeholder="Search faculty name">
                            <div class="table-responsive users-table">
                                <table class="table table-striped table-sm data-table">
                                    <tbody id="users-table">
                                        @if($faculties != null)
                                            @foreach ($faculties as $faculty)
                                            <tr>

                                                <td>
                                                    {{$faculty->first_name}} {{$faculty->last_name}}
                                                </td>
                                                <td class="text-right">
                                                    <button type="button" wire:click.prevent="assignModerator({{$faculty->id}})" class="btn btn-sm"><i class="fa fa-user-plus" style="color:green"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="submitRoom" class="btn btn-sm"><i class="fa fa-paper-plane" style="color:green"></i> Add Room</button>
                </div>
        </div>
        </div>
    </div>
</div>

