<!-- Modal -->
<div>
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" wire:model="event_id">
                        <div class="row">
                            <div class="col-md-3 offset-md-0">
                                <label class="control-label">Event ID</label>
                            </div>
                            <div class="col-md-7 offset-md-0">
                                <div class="form-group">
                                    {{$eventId}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-0">
                                <label for="event_date">Event Type</label>
                            </div>
                            <div class="col-md-7 offset-md-0">
                                <p>{{$eventType}}</p>
                                <div wire:ignore class="form-group">
                                    <select class="eventTypeEdit" id='eventTypeEdit' style='width: 260px;' name="eventTypeEdit">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-0">
                                <label for="event_date">Event Date</label>
                            </div>
                            <div class="col-md-7 offset-md-0">
                                <p>{{$event_date}}</p>
                                <div class="form-group">
                                    <x-inputs.date id="event_date" wire:model="event_date" />
                                    @error('event_date') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-0">
                                <label for="event_date">Application Deadline</label>
                            </div>
                            <div class="col-md-7 offset-md-0">
                                <p>{{$application_deadline}}</p>
                                <div class="form-group">
                                    <x-inputs.date id="application_deadline" wire:model="application_deadline" />

                                    @error('application_deadline') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-0">
                                <label for="event_date">Draft Deadline</label>
                            </div>
                            <div class="col-md-7 offset-md-0">
                                <p>{{$draft_deadline}}</p>
                                <div class="form-group">
                                    <x-inputs.date id="draft_deadline" wire:model="draft_deadline" />

                                    @error('draft_deadline') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-0">
                                <label for="quota">Quota</label>
                            </div>
                            <div class="col-md-3 offset-md-0">
                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="quota" id="quota" placeholder="Enter quota">
                                    @error('quota') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-0">
                                <label for="event_name">Current</label>
                            </div>
                            <div class="col-md-3 offset-md-0">
                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="current" readonly>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="update({{$event_id}})" class="btn btn-primary">Update</button>
                </div>
        </div>
        </div>
    </div>
</div>

