<!-- Modal -->
<div class="modal fade" id="createTodoModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create TodoS</h5>
                <button wire:click='"closeModal' type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        <label for="todoTitle">Title</label>
                        <input type="text" class="form-control" wire:model="todoTitle" placeholder="Enter title">
                        @error('todoTitle') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
            </div>
       </div>
    </div>
</div>
