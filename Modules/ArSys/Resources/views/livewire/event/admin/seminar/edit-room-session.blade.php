<div>
   
    <style>
        #editSession {

            width:40%;
            position:absolute;
            bottom:20%;
            right:10px;
            margin:0;
        }
    </style>
    @include('arsys::livewire.event.admin.seminar.modal.edit-room-session-modal')

    <script>
        window.livewire.on('eventAdminSeminarEditRoomSessionModal', () => {
            $('#eventAdminSeminarEditRoomSessionModal').modal('show');
        });

    </script>
</div>
