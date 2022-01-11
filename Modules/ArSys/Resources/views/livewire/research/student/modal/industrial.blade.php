<div>
    <form>
    <div class="form-group">
        <label for="researchFile">Title</label>
        <br>
        <textarea rows="2" wire:model = "researchTitle" class="form-control">fafsafasfa</textarea>
        @error('researchTitle') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="researchFile">Abstract</label>
        <br>
        <textarea rows="3" wire:model = "researchAbstract" class="form-control"></textarea>
        @error('researchAbstract') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="researchFile">File</label>
        <br>
        <input type="file" wire:model="researchFile">
        <br>
        @error('researchFile') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

</form>
<button type="button" wire:click.prevent="industrialStore" class="btn btn-success btn-sm" ><i class="fa fa-paper-plane"></i> Submit</button>

</div>