<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendant;
use App\Models\Meeting;
use Livewire\Component;

class ManageAttendants extends Component
{
    public $meeting;

    public $attendantNames = [];

    public $newAttendant;

    public function mount(Meeting $meeting)
    {
        $this->meeting = $meeting;
        $this->refreshValues();
    }

    protected function refreshValues()
    {
        $this->meeting->refresh();
        $this->attendantNames = $this->meeting->attendants()->pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.manage-attendants');
    }

    public function updateAttendant(Attendant $attendant, $nameIndex)
    {
        $attendant->name = $this->attendantNames[$nameIndex];
        $attendant->save();
        $this->refreshValues();
    }

    public function deleteAttendant(Attendant $attendant)
    {
        $attendant->delete();
        $this->refreshValues();
    }

    public function storeAttendant()
    {
        $this->meeting->attendants()->save(new Attendant(['name' => $this->newAttendant]));
        $this->newAttendant = '';
        $this->refreshValues();
    }
}
