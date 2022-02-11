<div>
    <div wire:ignore class="row">
        <div class="col-md-4 offset-md-0">
            <div class="form-group">
                <select class="event_type" id='eventType' style='width: 360px;' name="event_type">
                </select>
            </div>
        </div>
    </div>
    @if($eventTypeId != null)
    <div wire:ignore class="row">
        <!--
        <div class="row">
            <div class="col-sm-3 offset-sm-0">
                <input wire:model="search" type="text" class="my-2 form-control" placeholder="Search event name">
            </div>
        </div>
        -->

        <div class="table-responsive users-table">
            <table class="table table-striped table-sm data-table">
                <thead class="thead">
                <tr>
                    <th width="45%">Event Name</th>
                    <th width="15%">Event Date</th>
                    <th width="15%">Application Deadline</th>
                    <th width="15%">Draft Deadline</th>
                    <th class="text-center" width="10%">Seats left</th>

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
                                {{ ($event->quota) - ($event->current) }}
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
    @else
        <i class="text-danger">Please event type to show the event schedule</i>
    @endif
    <div>
        <script>
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function(){
                $( "#eventType" ).select2({
                    placeholder: "Select event type",
                    allowClear: true,
                    ajax: {
                        url: "{{route('arsys.data.event-type')}}",
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                            };
                        },
                        processResults: function (response) {
                            return {
                            results: response
                            };
                        },
                        cache: true
                    }
                });

                $( "#eventType" ).on('change', function(e) {
                // Access to full data
                    console.log($(this).select2('data'));
                    var data = $('#eventType').select2("val");
                    window.livewire.emit('selectEventType', { eventTypeId : data });
                });
            });
        </script>
    </div>
</div>
