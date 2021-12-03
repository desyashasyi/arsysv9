<!-- Modal -->
<div wire:ignore.self class="modal fade" id="importPresenceModal">
    <div class="modal-dialog  modal-dialog-scrollable" >
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importPresence">Import Presence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                @if($lecture != null)
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <b>Subject</b>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            {{$lecture->subject_code}} | {{$lecture->subject_name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <b>Class & University</b>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            {{$lecture->class}} | {{$lecture->university}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <b>Teachers</b>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            @if($lecture->teacher != null)
                                @foreach($lecture->teacher as $teacher)
                                    {{$teacher->faculty->first_name}} {{$teacher->faculty->last_name}}
                                    <br>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="meeting_date">Latest Meeting</label>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            @if(!$lecture->meeting->isEmpty())
                                Meeting number {{$lecture->meeting->count()}} - 
                                {{$lecture->meeting->where('id', $meetingId)->where('lecture_id', $lectureId)->first()->meeting_date}}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-0">
                            <label for="meeting_date"></label>
                        </div>
                        <div class="col-md-8 offset-md-0">
                            <button type="button" wire:click.prevent="resetMeeting({{$meetingId}})" class="btn btn-warning btn-sm" ><i class="fa fa-undo"></i> Reset Meeting</button>
                        </div>
                    </div>
                    @endif
                </div>
            <div>
            <br>
                <div class="row">
                    <div class="col-md-12 offset-md-0">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="15%">Student Number</th>
                                    <th width="60%">Student Name</th>
                                    <th width="15%">Presence</th>
                                    <th width="15%">Aggregate</th>

                                </tr>
                                </thead>
                                <tbody id="users-table">
                                    @php($number = 0)
                                    @if($lecture != null)
                                            
                                         @forelse($students as $student)
                                            <tr>
                                                <td>
                                                    {{++$number}}
                                                </td>
                                                <td>
                                                    {{$student->student_number}}
                                                </td>
                                                <td>
                                                    {{$student->student_name}}
                                                </td>
                                                <td class="text-center">
                                                    @foreach($lecture->meeting->where('lecture_id', $lectureId) as $meeting)  
                                                        @if($meeting->id == $meetingId)
                                                            @if ($meeting->presence->contains('student_id', $student->id))
                                                                <i class="fa fa-user fa-user" style ="color:green" aria-hidden="true"></i>
                                                            @else
                                                                <i class="fa fa-user fa-user" style ="color:red" aria-hidden="true"></i>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @php($counter = 0)
                                                    @foreach($lecture->meeting->where('lecture_id', $lectureId) as $meeting)
                                                        @if ($meeting->presence->contains('student_id', $student->id))
                                                            @php($counter++)
                                                        @endif
                                                    @endforeach
                                                    {{$counter}} | <b>{{$lecture->meeting->where('lecture_id', $lectureId)->count()}}</b>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if(!$students->isEmpty())
                            {{$students->links()}}
                        @endif
                    </div>
                </div>
            </div>

            <hr>
            <form>
                <div class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="meeting_date">Meeting Date</label>
                    </div>
                    <div class="col-md-8 offset-md-0">
                        <div class="form-group">
                            <x-inputs.date2 id="meeting_date" wire:model="meeting_date" />
                            @error('meeting_date') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </form>
                
                <div class="row">
                    <div class="col-md-4 offset-md-0">
                        <label for="filePresence">Chat file</label>
                    </div>
                    <div class="col-md-7 offset-md-0">
                        <input type="file" wire:model="filePresence">
                        @error('filePresence') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-1 offset-md-0">
                        <button type="button" wire:click.prevent="submitPresence" class="btn btn-warning btn-sm" ><i class="fa fa-paper-plane"></i></button>
                    </div>
                </row>
       </div>
    </div>
</div>
