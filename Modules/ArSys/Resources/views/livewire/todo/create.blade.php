<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @include('arsys::livewire.todo.modal.create-modal')
    <script>
         window.livewire.on('createTodoModal', () => {
            $('#createTodoModal').modal('show');
        });

    </script>
</div>
