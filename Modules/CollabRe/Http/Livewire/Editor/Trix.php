<?php

namespace Modules\CollabRe\Http\Livewire\Editor;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Trix extends Component
{
    use WithFileUploads;
    public $value;
    public $trixId;
    public $photos = [];
    const EVENT_VALUE_UPDATED = 'trix_value_updated';
    

    public function mount($value = ''){
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }
    public function render()
    {
        return view('collabre::livewire.editor.trix');
    }

    public function updatedValue($value){
        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
    }

    public function completeUpload(string $uploadedUrl, string $trixUploadCompletedEvent){

        foreach($this->photos as $photo){
            if($photo->getFilename() == $uploadedUrl) {
                // store in the public/photos location
                $newFilename = $photo->store('public/photos');

                // get the public URL of the newly uploaded file
                $url = Storage::url($newFilename);

                $this->dispatchBrowserEvent($trixUploadCompletedEvent, [
                    'url' => $url,
                    'href' => $url,
                ]);
            }
        }
    }
}
