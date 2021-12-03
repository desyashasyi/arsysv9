<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="eventAdminSeminarEditRoomSpaceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document" id="editSpace">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventAdminSeminarEditRoomSpaceModal">Edit Room Space</h5>
                    <button type="button" wire:click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th width="30%">Space</th>
                                    <th width="30%">Passcode</th>
                                    <th width="20%" class="text-center">Desc</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody id="users-table">
                                    @foreach($spaces as $space)
                                    <tr>

                                        <td>
                                            {{$space->space}}
                                        </td>
                                        <td>
                                            {{$space->passcode}}
                                        </td>
                                        <td class="text-center">
                                            {{$space->description}}
                                        </td>
                                        <td>
                                            <button wire:click="submitSpace({{$space->id}})" class="btn btn-sm">
                                                @if($space->id == $spaceId)
                                                    <i class="fa fa-xs fa-check-circle" style="color:green" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-xs fa-check-circle" style="color:gray" aria-hidden="true"></i>
                                                @endif
                                                 Select
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$spaces->render()}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>

