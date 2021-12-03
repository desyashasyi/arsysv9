<!-- Modal -->
<div wire:ignore.self class="modal fade" id="inProgressSetSupervisorModal" tabindex="-1" role="dialog" aria-labelledby="reviewSetSupervisorModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inProgressSetSupervisorModal">Supervisor Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        @if($research !=null)
                            <b>{{$research->student->program->code}}.{{$research->student->student_number}}</b>
                            |
                            {{$research->student->first_name}} {{$research->student->last_name}}
                            <br>
                            <b>{{$research->research_code}}</b> | {{$research->type->description}}
                            <br>
                            <i>{{$research->title}}</i>
                            <br>
                            <br>

                            @if($research->supervisor != null)
                                <b>Supervisor</b>
                                <br>
                                @php($counter = 0)
                                @foreach ($research->supervisor as $supervisor)
                                    {{++$counter}}.
                                    {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}
                                    <button wire:click="unAssign({{ $researchId }}, {{ $supervisor->faculty->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-minus" style ="color:red" aria-hidden="true"></i></button>
                                    @if($supervisor->supervisor_id == \Modules\ArSys\Entities\Faculty::where('code','EXT')->first()->id)
                                        <br>
                                        @if($supervisor->research->supervisorexternal != null)
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{$supervisor->research->supervisorexternal->supervisor_name}}
                                            -
                                            {{$supervisor->research->supervisorexternal->institution}}
                                        @else
                                            <div class="row">
                                                <div class="col-md-8 offset-md-0">
                                                <div class="text-danger">
                                                    Please input the external supervisor name!
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 offset-md-0">
                                                    <div class="form-group">
                                                        <label for="externalSupervisor">External Supervisor</label>
                                                        <br>
                                                        <textarea rows="1" wire:model = "externalSupervisor" class="form-control"></textarea>
                                                        @error('externalSupervisor') <span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 offset-md-0">
                                                    <div class="form-group">
                                                        <label for="externalInstitution">Institution of External Supervisor</label>
                                                        <br>
                                                        <textarea rows="1" wire:model = "externalInstitution" class="form-control"></textarea>
                                                        @error('externalInstitution') <span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-xs" wire:click="assignExternalSupervisor"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                                        @endif
                                    @endif
                                    <br>
                                @endforeach
                                <br>
                                
                            @endif
                        @endif
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-5 offset-md-0">
                        <input wire:model="search" type="text" class="my-3 form-control" placeholder="Search faculty name">
                    </div>
                </div>
                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead">
                        <tr>
                            <th width="10%">Code</th>
                            <th width="40%">Name</th>
                            @if($research != null)
                                @if($research->type->research_model == 'defense')
                                    <th width="40%">Aggregate</th>
                                @endif
                            @endif
                            @if($research != null)
                                @if($research->type->research_model == 'seminar')
                                    <th width="40%">Aggregate</th>
                                @endif
                            @endif
                            <th class="text-right" width="10%">Action</th>

                        </tr>
                        </thead>
                        <tbody id="users-table">
                            @foreach ($faculties as $faculty)
                            <tr>
                                <td>
                                    {{$faculty->code}}
                                </td>
                                <td>
                                    {{$faculty->first_name}} {{$faculty->last_name}}
                                </td>

                                @if($research != null)
                                    @if($research->type->research_model == 'seminar')
                                        <td>Seminar Supervise</td>
                                    @endif
                                @endif
                                @if($research != null)
                                    @if($research->type->research_model == 'defense')
                                        <td>{{$faculty->defenseSupervisor->count()}}</td>
                                    @endif
                                @endif

                                <td class="text-right">
                                    <button wire:click="assign({{ $researchId }}, {{ $faculty->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-plus" style ="color:green" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$faculties->links()}}

            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>
</div>
