<div>

    <style>
        #editSpace {

            width:40%;
            position:absolute;
            bottom:20%;
            right:10px;
            margin:0;
        }
    </style>
    @include('arsys::livewire.event.admin.seminar.modal.edit-room-space-modal')

    <script>
        window.livewire.on('eventAdminSeminarEditRoomSpaceModal', () => {
            $('#eventAdminSeminarEditRoomSpaceModal').modal('show');
        });

    </script>
</div>
