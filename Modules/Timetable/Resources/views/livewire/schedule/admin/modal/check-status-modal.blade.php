<!-- Modal -->
<div>
@if($schedules)
    <div wire:ignore.self class="modal fade" id="adminScheduleSIAKInputModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable" >
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminScheduleSIAKInputModal">SIAK Input</h5>
                    <button type="button" wire:click="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($schedules as $number => $schedule)
                        <div class="row">
                            <div class="col-md-4 offset-md-0">
                                <b>Student sets</b>
                            </div>
                            <div class="col-md-8 offset-md-0">
                                {{$schedule->student->code}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 offset-md-0">
                                <b>Student year</b>
                            </div>
                            <div class="col-md-8 offset-md-0">
                                {{intval(\Carbon\Carbon::parse($schedule->daytime)->translatedformat('Y')) - ($schedule->student->grade-1)}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 offset-md-0">
                                <b>Subject</b>
                            </div>
                            <div class="col-md-8 offset-md-0">
                                <b>{{$schedule->subject->code}}</b> | {{$schedule->subject->name}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 offset-md-0">
                                <b>Teaching team</b>
                            </div>

                            <div class="col-md-8 offset-md-0">
                                @foreach($schedule->team as $teacher)
                                    @if($teacher->faculty->upi_code)
                                        <b>{{$teacher->faculty->upi_code}}</b>
                                    @else
                                    xxxx
                                    @endif
                                    |
                                    {{$teacher->faculty->first_name}}
                                    {{$teacher->faculty->last_name}}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 offset-md-0">
                                <b>Room, day and time</b>
                            </div>
                            <div class="col-md-8 offset-md-0">
                                @if($schedule->room != null)
                                    {{$schedule->room->name}}
                                @endif
                                <br>
                                @if($schedule->daytime != null)
                                    {{ \Carbon\Carbon::parse($schedule->daytime)->translatedformat('l,') }}
                                    {{ \Carbon\Carbon::parse($schedule->daytime)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($schedule->daytime)->addMinute($schedule->subject->credit*50)->format('H:i') }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-right col-md-4 offset-md-0">
                                @if($schedule->siak_status)
                                    <button wire:click="complete" class="btn btn-sm btn-danger"><i class="fas fa-check-circle"></i>
                                    Mark Uncomplete
                                @else
                                    <button wire:click="complete" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i>
                                    Mark Complete
                                @endif

                                </button>
                            </div>
                        </div>
                        <hr>


                    @endforeach
                </div>


                <div class="modal-footer">

                </div>

        </div>
        </div>
    </div>
@endif
</div>
