<div>
    <div class="row">
        <div class="col-sm-3 offset-sm-0">
            <input wire:model="search" type="text" class="my-2 form-control" placeholder="Search event name">
        </div>
    </div>

    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th width="5%">Number</th>
                <th width="35%">Event Name</th>
                <th width="40%">Event Date</th>
                <th width="20%">Document</th>
            </tr>
            </thead>
            <tbody id="users-table">
                @php($number = null)
                @forelse ($events as $event)
                    <tr>
                        <td>
                            {{++$number}}
                        </td>
                        <td>
                            {{$event->event_id}}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($event->event_date)->format('l,') }}
                            {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}
                        </td>
                        <td>
                            @foreach($event->finaldefenseassignmentletter as $assignment)
                                <a class="btn btn-sm" href="{{url('/')}}{{ Storage::disk('local')->url($assignment->filename)}}" target="blank"><i class="fa fa-print" aria-hidden="true"></i>
                                    {{$assignment->program->code}}
                                </a>
                                <br>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan = "6">
                            No data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{$events->links()}}
</div>
