<?php

namespace App\Livewire\PublicWeb;

use App\Models\Attendant;
use App\Models\Meeting;
use Livewire\Component;

class MeetingAttendants extends Component
{
    public $meeting;

    public function mount(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function render()
    {
        return view('livewire.public-web.meeting-attendants');
    }

    public function storeAttendantAnswer($attendant_id, $answer)
    {
        $attendant = Attendant::findOrFail($attendant_id);
        $attendant->willBeAttending = $answer;
        $attendant->save();

        $this->meeting->refresh();
    }
}
