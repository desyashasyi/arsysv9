<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="changeApplicantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeApplicantModal">Change Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($applicant != null)
                        <div class="row">
                            <div class="col-sm-3">
                                <b>Student</b>
                            </div>
                            <div class="col-sm-9">
                                {{$applicant->research->student->first_name}} {{$applicant->research->student->last_name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <b>Current Event</b>
                            </div>
                            <div class="col-sm-9">
                                {{$applicant->event->type->description}} {{ \Carbon\Carbon::parse($applicant->event->event_date)->format('d F Y') }}
                            </div>
                        </div>
                    @endif
                    <br>
                    @if($events != null)

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th width="80%">Event</th>
                                    <th class="text-right" width="20%">Action</th>

                                </tr>
                                </thead>
                                <tbody id="users-table">
                                    @forelse ($events as $event)
                                    <tr>
                                        <td>
                                            {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}
                                        </td>


                                        <td class="text-right">
                                            <button wire:click="change({{$event->id}})" class="btn btn-xs"><i class="fa fa-user fa-plus" style ="color:green" aria-hidden="true"></i> Exchange</button>
                                        </td>
                                    </tr>
                                    @empty
                                        There is no event schedule
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    @endif
                @if($events != null)
                    {{$events->links()}}
                @endif

                </div>
                <div class="modal-footer">
                </div>
        </div>
        </div>
    </div>
</div>

