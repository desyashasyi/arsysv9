<!-- Modal -->
<div class="modal fade" id="createTodoModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Todo</h5>
                <button wire:click='"closeModal' type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('arsys::livewire.message.message')
                <div class="row">
                </div>

                <form>
                    <div class="form-group">
                        <label for="todoTitle">Title</label>
                        <input type="text" class="form-control" wire:model="todoTitle" id="todoTitle" placeholder="Enter title">
                        @error('todoTitle') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="todoNotes">Notes</label>
                        <textarea type="text" rows="3" class="form-control" wire:model="todoNotes" id="todoNotes" placeholder="Enter notes"></textarea>
                        @error('todoNotes') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="todoNotes">Due date</label>
                        <x-inputs.date id="todoDuedate" wire:model="todoDuedate" />
                        @error('todoDuedate') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="todoUrl">Document URL</label>
                        <input type="text" class="form-control" wire:model="todoUrl" id="todoUrl" placeholder="Enter document url">
                        @error('todoUrl') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="todoFile">Document file</label>
                        <br>
                        <input type="file" wire:model="todoFile" placeholder="Please enclose file">
                        @error('todoFile') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>



                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="todoStore" class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i> Submit</button>
            </div>
       </div>
    </div>
</div>
