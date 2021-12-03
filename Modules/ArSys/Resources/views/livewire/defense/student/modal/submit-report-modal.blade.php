<!-- Modal -->

<div wire:ignore.self class="modal fade" id="defenseStudentSubmitReportModal" tabindex="-1" role="dialog" aria-labelledby="defenseStudentSubmitReportModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defenseStudentSubmitReportModal">Report of Defense</h5>
                <button wire:click = "closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>

            </div>
            <div class="modal-body">
                @php($applicant_id = null)
                @if($research != null)
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Research ID</b>
                        </div>
                        <div class="col-sm-9">
                            {{$research->research_code}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Title</b>
                        </div>
                        <div class="col-sm-9">
                            {{$research->title}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Supervisor</b>
                        </div>
                        <div class="col-sm-9">
                            @php($counter = 0)
                            @if($research->supervisor != null)
                                @foreach($research->supervisor as $supervisor)
                                    @php(++$counter)
                                    {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}
                                    @if($counter != count($research->supervisor))
                                        <br>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Examiner</b>
                        </div>
                        <div class="col-sm-9">
                            @foreach($research->applicant as $applicant)
                                @php($applicant_id = $applicant->id)
                                @foreach($applicant->examiner as $examiner)
                                    @if($examiner->presence != null)
                                        {{$examiner->faculty->first_name}} {{$examiner->faculty->last_name}}
                                        <br>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3 offset-md-0">
                            <label for="defenseDate">Event Date</label>
                        </div>
                        <div class="col-md-7 offset-md-0">
                            <div class="form-group">
                                <x-inputs.date id="defenseDate" wire:model="defenseDate" />
                                @error('defenseDate') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Resume</b>
                        </div>
                        <div class="col-sm-9">
                            <textarea row="3" class="form-control" wire:model="defenseResume" id="defenseResume" placeholder="Write your message"></textarea>
                            @error('defenseResume') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="submitDefenseReport({{$applicant_id}})" class="btn btn-success btn-sm">Submit</button>
            </div>
       </div>
    </div>
</div>
