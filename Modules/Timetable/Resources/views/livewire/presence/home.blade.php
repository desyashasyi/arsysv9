<div>
    <div class="row">
        <div class="col-sm-12">
        <button wire:click="$emit('addLectureComponent')" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Add Lectures</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="5%">Number</th>
                        <th width="10%">Code</th>
                        <th width="40%">Subject</th>
                        <th width="10%">Teacher</th>
                        <th width="20%">Student Group & Univ.</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="users-table">
                        @php($number=0)
                        @forelse($lectures as $lecture)
                            

                                <td>
                                    {{++$number}}
                                </td>
                                <td>
                                    {{$lecture->subject_code}}
                                </td>
                                <td>
                                    {{$lecture->subject_name}}
                                </td>
                                <td>
                                    @if($lecture->teacher != null)
                                        @foreach($lecture->teacher as $teacher)
                                            {{$teacher->faculty->code}}
                                            <br>
                                        @endforeach
                                    @endif
                                    <button wire:click="$emit('addTeacherComponent', {{$lecture->id}})" class="btn btn-sm"><i class="fas fa-user-plus"></i> <u>Add</u></button>
                                </td>
                                <td>
                                    {{$lecture->class}}
                                    <br>
                                    {{$lecture->university}}
                                </td>
                                
                                <td>
                                    <button wire:click="$emit('importStudentComponent', {{$lecture->id}})" class="btn btn-sm"><i class="fas fa-user"></i> <u>Student</u></button>
                                    <button wire:click="$emit('importPresenceComponent', {{$lecture->id}})" class="btn btn-sm"><i class="fas fa-user"></i> <u>Presence</u></button>
                                    <button wire:click="presenceRecap({{$lecture->id}})" class="btn btn-sm"><i class="fas fa-user-plus"></i> <u>Recap</u></button>
                                    <button wire:click="edit({{$lecture->id}})" class="btn btn-sm"><i class="fas fa-user-plus"></i> <u>Edit</u></button>
                                    <button wire:click="delete({{$lecture->id}})" class="btn btn-sm"><i class="fas fa-user-plus"></i> <u> Delete</u></button>
                                
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                No Data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <div>
        @include('timetable::livewire.presence.modal.edit-modal')
        </div>
        @livewire('timetable::presence.add-lecture')
        @livewire('timetable::presence.add-teacher')
        @livewire('timetable::presence.import-student')
        @livewire('timetable::presence.import-presence')
       
</div>
