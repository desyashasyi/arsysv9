<div>
   @include('timetable::livewire.fet.admin.modal.teacher-modal')
   <script>
       window.livewire.on('fetTeachersDataModal', () => {
           $('#fetTeachersDataModal').modal('show');
       });
    </script>
</div>
