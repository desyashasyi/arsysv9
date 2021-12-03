<!-- Modal -->
<div wire:ignore.self class="modal fade" id="studentEventApplyModal" tabindex="-1" role="dialog" aria-labelledby="studentApplyEventModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentEventApplyModal">Apply Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if($research != null)
                    <div class="row bg-secondary">
                        <div class="col-sm-3">
                            <b>Research ID</b>
                        </div>
                        <div class="col-sm-9">
                            {{$research->research_code}}
                        </div>
                </div>
                <div class="row bg-secondary">
                        <div class="col-sm-3">
                            <b>Title</b>
                        </div>
                        <div class="col-sm-9">
                            {{$research->title}}
                        </div>
                    </div>
                    <div class="row bg-secondary">
                        <div class="col-sm-3">
                            <b>Supervisor</b>
                        </div>
                        <div class="col-sm-9">
                            @php($counter = 0)
                            @foreach($research->supervisor as $supervisor)
                                @php(++$counter)
                                {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}
                                @if($counter != count($research->supervisor))
                                    |
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <hr>

                    @foreach ($events as $event)
                    <div class="row">
                            <div class="col-sm-3">
                                <b>Event Id</b>
                            </div>
                            <div class="col-sm-9">
                                {{$event->event_id}}
                                |
                                @if($event->appplicant != null)
                                    @if($event->appplicant->contains('applicant_id', $research->student->id)))
                                        Applied
                                    @endif
                                @endif
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-3">
                                <b>Event Name</b>
                            </div>
                            <div class="col-sm-9">
                                {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <b>Deadline</b>
                            </div>
                            <div class="col-sm-9">
                            {{ \Carbon\Carbon::parse($event->application_deadline)->format('d F Y,  H:i') }}
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-sm-3">
                                <b>Draft deadline</b>
                            </div>
                            <div class="col-sm-9">
                            {{ \Carbon\Carbon::parse($event->draft_deadline)->format('d F Y,  H:i') }}
                            </div>
                        </div>
                    -->
                        <div class="row">
                            <div class="col-sm-3">
                                <b>Seats</b>
                            </div>
                            <div class="col-sm-9">
                                {{($event->quota - $event->current)}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-6">
                            </div>
                            <div class="text-right col-sm-3">
                                <button wire:click="submitApplication({{$event->id}},{{$research->id}})" class="btn btn-xs btn-success"><i class="fas fa-plus-circle"></i> Apply</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
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
