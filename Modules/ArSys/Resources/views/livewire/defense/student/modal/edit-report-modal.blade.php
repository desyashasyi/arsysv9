<!-- Modal -->
@php ($eventType = null)
<div wire:ignore.self class="modal fade" id="defenseStudentEditReportModal" tabindex="-1" role="dialog" aria-labelledby="defenseStudentEditReportModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defenseStudentEditReportModal">Edit Report of Defense</h5>
                <button wire:click = "closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>

            </div>
            <div class="modal-body">
                @if($report != null)
                    <div class="row">
                        <div class="col-sm-3">
                            <b>Research ID</b>
                        </div>
                        <div class="col-sm-9">
                            {{$report->applicant->research->research_code}}
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <b>Title</b>
                    </div>
                    <div class="col-sm-9">
                        {{$report->applicant->research->title}}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <b>Supervisor</b>
                    </div>
                    <div class="col-sm-9">
                        @php($counter = 0)
                        @if($report->applicant->research->supervisor != null)
                            @foreach($report->applicant->research->supervisor as $supervisor)
                                @php(++$counter)
                                {{$supervisor->faculty->first_name}} {{$supervisor->faculty->last_name}}
                                @if($counter != count($report->applicant->research->supervisor))
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

                            @foreach($report->applicant->examiner as $examiner)
                                @if($examiner->presence != null)
                                    {{$examiner->faculty->first_name}} {{$examiner->faculty->last_name}}
                                    <br>
                                @endif
                            @endforeach

                        </div>


                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3 offset-md-0">
                            <label for="defenseDate">Event Date</label>
                        </div>
                        <div class="col-md-7 offset-md-0">
                            {{\Carbon\Carbon::parse($report->defense_date)->format('l,')}}
                            {{\Carbon\Carbon::parse($report->defense_date)->format('d-m-Y')}}
                            {{\Carbon\Carbon::parse($report->defense_date)->format('H:i')}}
                            <br>
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
                            <textarea row="3" class="form-control" wire:model="defenseResume" id="defenseResume">

                            </textarea>
                            @error('defenseResume') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>


                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="updateDefenseReport({{$reportId}})" class="btn btn-success btn-sm">Update</button>
            </div>

       </div>
    </div>


</div>
