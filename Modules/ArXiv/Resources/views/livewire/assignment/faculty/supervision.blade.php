<div>
    @if($supervises->isNotEmpty())
        <div class="row">
            <div class="col-md-12 offset-md-0">
                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead">
                            <tr>
                                <th width="2%">No</th>
                                <th width="30%">Student</th>
                                <th width="40%">Research</th>
                                <th width="20%">Supervisor</th>
                                <th class="text-right" width="7%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="users-table">
                            @foreach ($supervises as $number => $supervise)
                                @if($supervise->research != null)
                                    <tr>
                                        <td>
                                            {{++$number}}
                                        </td>
                                        <td>
                                            {{$supervise->research->student->program->code}}.
                                            {{$supervise->research->student->student_number}}
                                            <br>
                                            {{$supervise->research->student->first_name}}
                                            {{$supervise->research->student->last_name}}
                                        </td>
                                        <td>
                                            {{$supervise->research->title}}
                                        </td>
                                        <td>
                                        @foreach($supervise->research->supervisor as $supervisor)
                                            {{$supervisor->faculty->code}}
                                            <br>
                                        @endforeach
                                        </td>
                                        <td>
                                            @foreach($supervise->research->spvfile as $spvfile)

                                                @if($spvfile->supervisor_id == Auth::user()->faculty->id)
                                                    <a class="btn btn-sm" href="{{url('/')}}{{ Storage::disk('local')->url($spvfile->docfile->filename)}}" target="blank"><i class="fa fa-print" aria-hidden="true"></i>
                                                        Print
                                                    </a>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                        
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        No Data
    @endif
</div>
