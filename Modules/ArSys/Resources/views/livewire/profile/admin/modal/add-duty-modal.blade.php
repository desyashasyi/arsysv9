<!-- Modal -->
<div wire:ignore.self class="modal fade" id="adminFacultyProfileAssignDuty" tabindex="-1" role="dialog" aria-labelledby="adminFacultyProfileAssignDuty" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminFacultyProfileAssignDuty">Assign duty to faculty</h5>
                <button type="button" wire:clisk = "close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        @if($faculty != null)
                            <b> {{$faculty->code}} | {{$faculty->nip}} </b>
                            <br>
                            {{$faculty->first_name}}  {{$faculty->last_name}}
                            <br>
                            <br>
                            @if($faculty->duty->isNotEmpty())
                                <b>Duties</b>
                                <br>
                                @foreach($faculty->duty as $duty)
                                    {{$duty->type->display_name}}
                                    <button wire:click="unAssignDuty({{$duty->id}})"  class="btn btn-xs"><i class="fa fa-user fa-user-minus" style ="color:red" aria-hidden="true"></i></button>
                                    <br>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 offset-md-0">
                        <input wire:model="searchSupervisor" type="text" class="my-3 form-control" placeholder="Search faculty name">
                    </div>
                </div>
                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead">
                        <tr>
                            <th class="text-left" width="70%">Display Name</th>
                            <th class="text-right" width="30%">Action</th>


                        </tr>
                        </thead>
                        <tbody id="users-table">
                            @if($dutyTypes != null)
                                @foreach($dutyTypes as $duty)
                                    <tr>
                                        <td>
                                            {{$duty->display_name}}
                                        </td>

                                        <td class="text-right">
                                        <button wire:click="assignDuty({{$faculty->id}}, {{$duty->id}})"  class="btn btn-xs"><i class="fa fa-user fa-user-plus" style ="color:green" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>
</div>
