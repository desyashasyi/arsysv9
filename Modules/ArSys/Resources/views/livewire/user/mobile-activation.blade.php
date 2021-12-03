<div>

    @if($mobileActivation)

        Please provide email and password for mobile login!
        <br>
        <div class="row">
            <div class="col-md-6">
                <label for="">Password</label>
                <input type="email" class="form-control"  wire:model="user.email" placeholder="your.email@example.com">
                @error('user.email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="">Password</label>
                <input type="password" class="form-control"  wire:model="user.password" placeholder="***********">
                @error('user.password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" wire:model="user.confirm_password" placeholder="***********">
                @error('user.confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-primary" wire:click="saveLoginCredential">
                    Submit
                </a>
            </div>
        </div>


    @else
        To use ArSys mobile (iOS and Android) you should activate the credential login.
        <a class="btn btn-sm btn-info" wire:click="activate">
            <u>
                activate
            </u>
        </a>
    @endif
</div>
