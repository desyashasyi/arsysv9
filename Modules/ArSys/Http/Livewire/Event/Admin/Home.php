<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin;

use Livewire\Component;

use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventType;

use Livewire\WithPagination;
use Carbon\Carbon;
class Home extends Component
{


    public $showAllEvent;
    public $eventId, $eventType;
    public $updateMode = false, $search, $event_type, $event_name, $event_date, $application_deadline, $draft_deadline, $event_date_dummy, $application_deadline_dummy, $draft_deadline_dummy, $quota, $current, $event_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['selectEventTypeSetting' => 'eventTypeSetting',
                            'refreshEventAdminHome' => '$refresh',
                            ];

    public function eventTypeSetting($eventId)
    {
        if($this->updateMode){
            $this->event_type = $eventId['eventId'];
        }
    }

    public function mount(){
        $this->event_type = null;
        $this->eventId = null;
        $this->showAllEvent = false;
    }


    protected $rules = [
        'event_type' => 'required',
        'event_date' => 'required',
        'application_deadline' => 'required',
        'draft_deadline' => 'required',
        'quota' => 'required',
    ];


    public function render()
    {

        /*$events = Event::where('event_date', '>=', Carbon::today())
                        ->orderBy('event_date', 'ASC')
                        ->paginate(10);
        */
        $events = Event::orderBy('event_date', 'DESC')
                        ->paginate(10);

        if ($this->search !== null) {
            $events = Event::where('event_id', 'like', '%' . $this->search . '%')
                ->where('event_date', '>=', Carbon::today())
                ->orderBy('event_date', 'ASC')
                ->paginate(10);
        }

        if($this->updateMode){
            $event_type = EventType::where('id', $this->event_type)->first();
            if($event_type != null)
                $this->eventType = $event_type->abbrev.'-'.$event_type->description;
            else
                $this->eventType = 'Please select the event type';
        }

        if($this->showAllEvent){
            $events = Event::orderBy('event_date', 'DESC')
                ->paginate(50);
        }

        return view('arsys::livewire.event.admin.home', compact('events'));
    }


    public function delete($id)
    {
        if($id){
            Event::where('id',$id)->delete();
        }
    }

    public function edit($id)
    {
        $this->dispatchBrowserEvent('resetEventTypeEdit',[]);
        $this->reset( 'event_type', 'event_date', 'application_deadline', 'draft_deadline', 'quota');
        $this->resetValidation();
        $this->updateMode = true;
        $event = Event::where('id',$id)->first();
        $this->event_id = $id;
        $this->eventId = $event->event_id;
        $this->event_date = $event->event_date;
        $this->event_type = $event->event_type;
        $this->application_deadline = $event->application_deadline;
        $this->draft_deadline = $event->draft_deadline;
        $this->quota = $event->quota;


    }

    public function store()
    {
        $this->validate();

        $event_type = EventType::where('id', $this->event_type)->first();
        $eventId = $event_type->abbrev.'-'.(Carbon::parse($this->event_date)->format('dmY'));
        Event::create([
            'event_id' => $eventId,
            'event_type' => $this->event_type,
            'event_date' => $this->event_date,
            'application_deadline' => $this->application_deadline,
            'draft_deadline' => $this->draft_deadline,
            'quota' => $this->quota,

        ]);

        $this->updateMode = false;

    }


    public function update($id){
        $event = Event::where('id', $id);

        $event_type = EventType::where('id', $this->event_type)->first();
        $eventId = $event_type->abbrev.'-'.(Carbon::parse($this->event_date)->format('dmY'));

        $event->update([
            'event_id' => $eventId,
            'event_date' => $this->event_date,
            'event_type' => $this->event_type,
            'application_deadline' => $this->application_deadline,
            'draft_deadline' => $this->draft_deadline,
            'quota' => $this->quota,
        ]);
    }

    function cancel(){
        $this->updateMode = false;
    }

    public function create(){
        $this->dispatchBrowserEvent('resetEventType',[]);
        $this->emit('loadCard');
        $this->reset('event_type', 'event_date', 'application_deadline', 'draft_deadline', 'quota');
        $this->resetValidation();
        $this->updateMode = true;
    }

    public function applicant($id){
        $this->updateMode = false;
        return redirect()->route('arsys.event.admin.applicant', ['id' => $id]);
    }

    public function showAll(){
        $this->showAllEvent = true;
    }

    public function eventPresence($event_id){
        return redirect()->route('arsys.event.admin.presence',['id' => $event_id]);
    }

}

