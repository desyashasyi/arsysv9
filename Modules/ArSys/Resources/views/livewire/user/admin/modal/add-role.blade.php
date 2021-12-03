<!-- Modal -->
<div wire:ignore.self class="modal fade" id="setRole" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign role to faculty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                            <b>Roles</b>
                            <br>
                            @foreach($faculty->user->roles as $role)
                                {{$role->display_name}}
                                <button wire:click="removeRole({{$role->id}})"  class="btn btn-xs"><i class="fa fa-user fa-user-minus" style ="color:red" aria-hidden="true"></i></button>
                                <br>
                            @endforeach
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
                            @foreach($roles as $role)
                                <tr>
                                    <td>
                                        {{$role->display_name}}
                                    </td>

                                    <td class="text-right">
                                    <button wire:click="addRole({{$role->id}})"  class="btn btn-xs"><i class="fa fa-user fa-user-plus" style ="color:green" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>
</div>
