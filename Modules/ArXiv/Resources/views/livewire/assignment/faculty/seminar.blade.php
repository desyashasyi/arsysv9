<div>
    @if($events->isNotEmpty())
        <div class="row">
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th width="2%">No</th>
                            <th width="20%">Event</th>
                            <th width="30%">Student</th>
                            <th width="40%">Research</th>
                            <th class="text-right" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="users-table">
                        @php($number = 0)
                        @foreach($events as $event)
                            @foreach($event->room as $room)
                                @if($room->examiner->contains('examiner_id', Auth::user()->faculty->id)
                                )
                                    <tr>
                                        <td>
                                            {{++$number}}
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($event->event_date)->format('d F Y')}}
                                        </td>
                                        <td>
                                            <b>Moderator</b>
                                            <br>

                                            @foreach($room->moderator as $moderator)
                                                {{$moderator->faculty->front_title}}
                                                {{$moderator->faculty->first_name}}
                                                {{$moderator->faculty->last_name}},
                                                {{$moderator->faculty->rear_title}}
                                                <br>
                                            @endforeach
                                        </td>
                                        <td text-align="right">
                                        </td>
                                        <td text-align="left">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        No data
    @endif
</div>
