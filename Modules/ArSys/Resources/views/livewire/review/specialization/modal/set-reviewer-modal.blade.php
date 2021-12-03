<!-- Modal -->
<div wire:ignore.self class="modal fade" id="reviewSetReviewerModal" tabindex="-1" role="dialog" aria-labelledby="reviewSetReviewerModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewSetReviewerModal">Reviewer Assignment</h5>
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

                            @php($counter = 0)
                            @if($research->proposalReview != null)
                                <b>Reviewer</b>
                                <br>
                                @foreach ($research->proposalReview as $reviewer)
                                    {{++$counter}}.
                                    @if($reviewer->faculty != null)
                                        {{$reviewer->faculty->first_name}} {{$reviewer->faculty->last_name}}
                                        <button wire:click="unAssign({{ $researchId }}, {{ $reviewer->faculty->id }})" class="btn btn-xs"><i class="fa fa-user fa-user-minus" style ="color:red" aria-hidden="true"></i></button>
                                        <br>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-5 offset-md-0">
                        <button wire:click="assignAllMember({{ $researchId }})" class="btn btn-success btn-sm"><i class="fa fa-user fa-user-plus" style ="color:green" aria-hidden="true"></i> Assign All Member</button>
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
