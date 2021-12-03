<div>
    @include('arsys::livewire.event.admin.modal.event-create-modal')
    @include('arsys::livewire.event.admin.modal.event-edit-modal')

    <div class="row">
        <div class="col-sm-3 offset-sm-0">
            <input wire:model="search" type="text" class="my-2 form-control" placeholder="Search event name">
        </div>
        <div class="text-right col-sm-7 offset-sm-0">
            <button data-toggle="modal" data-target="#createModal" style="width: 100; height: 30px;" type="button" wire:click.prevent="create()" class="my-3 btn btn-sm btn-primary">Add event</button>
        </div>
        <!--<div class="text-right col-sm-2 offset-sm-0">
            <button style="width: 100%; height: 30px;" type="button" wire:click.prevent="showAll" class="my-3 btn btn-sm btn-primary"><i class="fa fa-eye"></i> All</button>
        </div>
        -->
    </div>

    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th width="25%">Event Name</th>
                <th width="15%">Event Date</th>
                <th width="15%">Application Deadline</th>
                <th width="15%">Draft Deadline</th>
                <th class="text-center" width="5%">Seats</th>
                <th width="10%" class="text-center">ArXiv</th>
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
                            {{ ($event->quota) - ($event->current) }}
                        </td>
                        <td class="text-center">
                            @if($event->type->abbrev == 'PUB'  && $event->status == 1)
                                <button wire:click="$emit('addFinalAssignmentLetterEmiter',{{$event->id}})" class="btn btn-xs"> Add<i class="fa fa-plus-circle" style="color:green"></i></button>
                            @endif
                        </td>
                        <td class="text-right">
                            <button wire:click="applicant({{ $event->id }})" class="btn btn-sm">Applicant <i class="fa fa-eye" style="color:green"></i></button> <br>
                            <button data-toggle="modal" data-target="#editModal" wire:click="edit({{ $event->id }})" class="btn btn-sm">Edit <i class="fa fa-edit" style="color:blue"></i></button> <br>
                            <button wire:click="delete({{ $event->id }})" class="btn btn-sm">Delete <i class="fa fa-trash" style="color:red"></i></button> <br>
                            <button wire:click = "eventPresence({{$event->id}})" class="btn btn-sm">Presence <i class="fa fa-trash" style="color:magenta"></i></button> <br>
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

    <script type="text/javascript">

        // CSRF Token
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
                window.livewire.emit('selectEventTypeSetting', { eventId : data });

            });

            $( "#eventTypeEdit" ).select2({
                placeholder: "Select event type",
                allowClear: true,
                ajax: {
                url: "{{route('arsys.data.event-type-edit')}}",
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
            $( "#eventTypeEdit" ).on('change', function(e) {
            // Access to full data
                console.log($(this).select2('data'));
                var data = $('#eventTypeEdit').select2("val");
                window.livewire.emit('selectEventTypeSetting', { eventId : data });

            });



        });

        window.addEventListener('resetEventTypeEdit', event => {
            $("#eventTypeEdit").empty().trigger('opening')
        });

        window.addEventListener('resetEventType', event => {
            $("#eventType").empty().trigger('opening')
        });

        </script>
        @include('arsys::livewire.sweetalert.error-alert')
        @livewire('arsys::event.admin.seminar.final-assignment-letter')
</div>
