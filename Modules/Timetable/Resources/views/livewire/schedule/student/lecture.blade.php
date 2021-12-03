<div>
    @if($schedule != null)

        <div class="row">
            <div class="col-md-2 offset-md-0">
                <b>Academic year</b>
            </div>
            <div class="col-md-4 offset-md-0">
                : {{$schedule->desc->year}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 offset-md-0">
                <b>Last update:</b>
            </div>
            <div class="text-left col-md-4 offset-md-0">
                :
                <i>{{ \Carbon\Carbon::parse($schedule->updated_at)->translatedformat('l, d-m-Y') }} -
                    {{ \Carbon\Carbon::parse($schedule->updated_at)->format('H:i') }}
                </i>
            </div>
        </div>
    @endif
    <br>
    <div>
        @if($schedules != null)
            <div class="table-responsive users-table">
                <table class="table table-striped table-sm data-table">
                    <thead class="thead">
                    <tr>
                        <th width="2%">
                            No
                        </th>
                        <th class="text-center" width="10%">
                            Code
                        </th>
                        <th width="30%">

                            Subject
                        </th>
                        <th class="text-center" width="5%">
                            Credit
                        </th>
                        <th class="text-center" width="10%">
                            <button type="button" wire:click.prevent="sort('student_id')" class="btn btn-xs" >
                                <i class="fa fa-sort"></i>
                            </button>
                            Student
                        </th>
                        <th class="text-left" width="10%">
                            Room
                        </th>
                        <th class="text-left" width="15%">
                            Day-Time
                        </th>

                        <th class="text-center" width="10%">
                            Teacher
                        </th>
                    </tr>
                    </thead>
                    <tbody id="users-table">
                        @php($number = null)
                        @foreach($schedules as $schedule)
                            <tr>
                                <td>
                                    {{++$number}}
                                </td>
                                <td class="text-center">
                                    @if($schedule->subject != null)
                                        {{$schedule->subject->code}}
                                    @endif
                                    </button>
                                </td>
                                <td class="text-left">
                                    @if($schedule->subject != null)
                                        {{$schedule->subject->name}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($schedule->subject != null)
                                        {{$schedule->subject->credit}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($schedule->student != null)
                                        {{$schedule->student->code}}
                                    @endif
                                </td>
                                <td class="text-left">
                                    @if($schedule->room != null)
                                        {{$schedule->room->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($schedule->daytime != null)
                                        {{ \Carbon\Carbon::parse($schedule->daytime)->translatedformat('l') }}<br>
                                        {{ \Carbon\Carbon::parse($schedule->daytime)->format('H:i') }} -
                                        @if($schedule->subject != null)
                                            {{ \Carbon\Carbon::parse($schedule->daytime)->addMinute($schedule->subject->credit*50)->format('H:i') }}
                                        @endif
                                    @endif
                                </td>

                                <td class="text-center">
                                    @foreach($schedule->team as $team)
                                        {{$team->faculty->code}}<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    {{$schedules->render()}}
</div>
