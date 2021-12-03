<div class="table-responsive users-table">
    <table class="table table-striped table-sm data-table">
        <thead class="thead">
        <tr>
            <th width="25%">Event Name</th>
            <th width="15%">Event Date</th>
            <th width="15%">Application Deadline</th>
            <th width="15%">Draft Deadline</th>
            <th class="text-center" width="15%">Applicant</th>
            <th class="text-right" width="15%">Action</th>

        </tr>
        </thead>
        <tbody id="users-table">
            @forelse ($events as $event)
                <tr>
                    <td>
                        {{$event->event_id}}
                        <br>
                        @if($event->type != null)
                            {{$event->type->description}} {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}
                        @endif
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($event->event_date)->format('l,') }} <br />
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }} <br />
                        {{ \Carbon\Carbon::parse($event->event_date)->format('H:i') }} <br />
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($event->application_deadline)->format('l,') }} <br />
                        {{ \Carbon\Carbon::parse($event->application_deadline)->format('d F Y') }} <br />
                        {{ \Carbon\Carbon::parse($event->application_deadline)->format('H:i') }} <br />
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($event->draft_deadline)->format('l,') }} <br />
                        {{ \Carbon\Carbon::parse($event->draft_deadline)->format('d F Y') }} <br />
                        {{ \Carbon\Carbon::parse($event->draft_deadline)->format('H:i') }} <br />
                    </td>

                    <td class="text-center">
                        {{$event->applicant->count()}}
                    </td>
                    <td class="text-right">
                        <button wire:click="delete({{ $event->id }})" class="btn btn-sm">Delete <i class="fa fa-trash" style="color:red"></i></button> <br>
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
