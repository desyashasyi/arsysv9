<div>
    <div class="row">
        <div class="col-sm-12">
            @if($lecture != null)
                <h4><b>{{$lecture->subject_code}} | {{$lecture->subject_name}}</b></h4>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="10%">Student Number</th>
                        <th width="20%">Student Name</th>
                        @foreach($lecture->meeting as $meeting)
                            <th>
                                {{\Carbon\Carbon::parse($meeting->meeting_date)->format('d/m')}}
                            </th>
                        @endforeach
                       
                    </tr>
                    </thead>
                    <tbody id="users-table">

                        @if($lecture->student != null)
                            @foreach($lecture->student as $student)
                                <tr>
                                    <td>
                                        {{$student->student_number}}
                                    </td>
                                    <td>
                                        {{$student->student_name}}
                                    </td>
                                    @if($lecture->meeting != null)
                                        @foreach($lecture->meeting as $meeting)
                                            <td>
                                                @if($meeting->presence != null)
                                                
                                                        @if($meeting->presence->contains('student_id', $student->id))
                                                            <i class="fa fa-user fa-user" style ="color:green" aria-hidden="true"></i>
                                                        @else
                                                            <i class="fa fa-user fa-user" style ="color:red" aria-hidden="true"></i>
                                                        @endif
                                                    
                                                @endif
                                            </td>
                                        @endforeach
                                    @endif
                                <tr>
                            @endforeach
                        @endif
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

