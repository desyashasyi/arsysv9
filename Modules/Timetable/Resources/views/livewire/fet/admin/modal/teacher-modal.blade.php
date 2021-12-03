<!-- Modal -->
<div wire:ignore.self class="modal fade" id="fetTeachersDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" style="width: 80%; height: 100%; overflow-y: hidden; overflow-x: hidden">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importStudent">Data of FET Techers</h5>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 border-right offset-md-0">
                       <b>List of Faculty Members</b>

                        <div class="row">
                            <div class="col-md-5 offset-md-0">
                                <input wire:model="searchFaculty" type="text" class="my-1 form-control" placeholder="Search faculty name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 border-right offset-md-0">
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
                                                        <button type="button" wire:click.prevent="assignTeacher({{$faculty->id}})" class="btn btn-sm"><i class="fa fa-user-plus" style="color:green"></i></button>
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
                    </div>
                    <div class="col-md-6 border-right offset-md-0">
                        <b>List of Teachers</b>
                        @if($teachers != null)
                            <div class="row">
                                <div class="col-md-5 offset-md-0">
                                    <input wire:model="searchTeacher" type="text" class="my-1 form-control" placeholder="Search teacher name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 border-right offset-md-0" style="width: 100%; height: 450px; overflow-y: scroll; overflow-x: hidden">
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

                                                @foreach ($teachers as $teacher)
                                                    <tr>
                                                    <td>
                                                        {{$teacher->faculty->code}}
                                                    </td>
                                                    <td>
                                                        {{$teacher->faculty->first_name}} {{$teacher->faculty->last_name}}
                                                    </td>
                                                    <td class="text-right">
                                                        <button type="button" wire:click.prevent="unAssignTeacher({{$teacher->id}})" class="btn btn-sm"><i class="fa fa-user-minus" style="color:red"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        </div>

                    </div>
                <div class="row">
            <div class="modal-footer">
            </div>

       </div>
    </div>
</div>
