<?php

namespace App\Livewire\PublicWeb;

use App\Models\Meeting;
use Livewire\Component;

class MeetingAttendants extends Component
{
    public $meeting;

    public $attendants;

    public function mount(Meeting $meeting)
    {
        $this->meeting = $meeting;
        $this->attendants = $meeting->attendants;
    }

    public function render()
    {
        return view('livewire.public-web.meeting-attendants');
    }
}
