<?php

namespace App\Livewire\Dashboard;

use App\Models\Meeting;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewMeetingForm extends Component
{
    #[Validate('required|string|unique:App\Models\Meeting|max:255')]
    public $name;

    #[Validate('required_with:time|nullable|date_format:Y-m-d')]
    public $date;

    #[Validate('nullable|date_format:H:i')]
    public $time;

    #[Validate('nullable|string|max:255')]
    public $where;

    public function render()
    {
        return view('livewire.dashboard.new-meeting-form');
    }

    public function storeNewMeeting(): void
    {
        $validated = $this->validate();
        if ($validated['date']) {
            $validated['when'] = $validated['date'].' '.$validated['time'] ?? '00:00';
        }

        $meeting = Meeting::create($validated);

        $this->dispatch('meeting-created', id: $meeting->id);

        $this->reset(['name', 'date', 'time', 'where']);
    }
}
