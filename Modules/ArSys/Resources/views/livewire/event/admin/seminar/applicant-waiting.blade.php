<div>

    <div class="row">
        <div class="col-md-5 offset-md-0">
            <input wire:model="searchStudent" type="text" class="my-1 form-control" placeholder="Search first name of student">
        </div>
    </div>
    @if($researchs)
        <div class="row bg-info">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th width="25%">Student</th>
                            <th width="60%">Research</th>
                            <th width="5%">SPV</th>
                            <th class="text-right" width="10%">Action</th>

                        </tr>
                    <tbody id="users-table">
                        @foreach($researchs as $research)
                            <tr>
                                <td>
                                    {{$research->student->program->code}} -
                                    {{$research->student->student_number}}
                                    <br>
                                    {{$research->student->first_name}}
                                    {{$research->student->last_name}}
                                </td>
                                <td>
                                    {{$research->research_code}}
                                    <br>
                                    {{$research->title}}
                                </td>
                                <td>
                                    @foreach($research->supervisor as $supervisor)
                                        {{$supervisor->faculty->code}}
                                        <br>
                                    @endforeach
                                </td>

                                <td class="text-right">
                                    @foreach($research->applicant as $applicant)
                                        @if($applicant->event_id != $eventId)
                                            <button wire:click="addResearch({{$research->id}})" class="text-white btn btn-sm"><i class="fa fa-sm fa-plus-circle" aria-hidden="true" style ="color:white"></i> Add</button>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
