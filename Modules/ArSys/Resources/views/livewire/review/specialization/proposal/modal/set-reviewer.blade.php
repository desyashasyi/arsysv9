<!-- Modal -->

<div wire:ignore.self class="modal fade" id="setReviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reviewer Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        @if($studentResearch !=null)
                            <b>{{$studentResearch->research_code}} | {{$studentResearch->type->description}}</b>
                            <br>
                            {{$studentResearch->title}}
                            <br>
                            <br>
                            <b>Reviewer</b>
                            <br>
                            @php($counter = 0)
                            @if($studentResearch->proposalReview != null)
                                @foreach ($studentResearch->proposalReview as $reviewer)
                                    {{++$counter}}.
                                    @if($reviewer->faculty != null)
                                        {{$reviewer->faculty->first_name}} {{$reviewer->faculty->last_name}}
                                        <button wire:click="unAssignReviewer({{ $researchID }}, {{ $reviewer->faculty->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-minus" style ="color:red" aria-hidden="true"></i></button>
                                        <br>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 offset-md-0">
                        <input wire:model="searchFaculty" type="text" class="my-3 form-control" placeholder="Search faculty name">
                    </div>
                </div>
                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead">
                        <tr>
                            <th width="10%">Code</th>
                            <th width="40%">Name</th>
                            <th width="20%">Status</th>
                            <th class="text-right" width="30%">Action</th>

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
                                <td>
                                    Status
                                </td>


                                <td class="text-right">
                                    <button wire:click="assignReviewer({{ $researchID }}, {{ $faculty->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-plus" style ="color:green" aria-hidden="true"></i></button>
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
