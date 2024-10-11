<?php

namespace App\Livewire\Dashboard;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ListMeetings extends Component
{
    public $meetings;

    public function mount()
    {
        $this->retrieveMeetings(Auth::user());
    }

    public function render()
    {
        return view('livewire.dashboard.list-meetings');
    }

    #[On('meeting-created')]
    public function meetingChanged($id): void
    {
        $this->retrieveMeetings(Meeting::findOrFail($id)->user);
    }

    protected function retrieveMeetings(User $user): void
    {
        $this->meetings = $user->meetings->sortBy([
            ['when', 'asc'],
            ['name', 'asc'],
        ]);
    }
}
