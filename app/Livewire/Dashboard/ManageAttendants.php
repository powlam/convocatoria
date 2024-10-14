<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendant;
use App\Models\Group;
use App\Models\Meeting;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageAttendants extends Component
{
    public $meeting;

    public $attendantNames = [];

    public $newAttendant;

    public $groupName;

    public $existingGroups = [];

    public $selectedGroup;

    public function mount(Meeting $meeting)
    {
        $this->meeting = $meeting;
        $this->refreshValues(attendants: true, groups: true);
    }

    protected function refreshValues(bool $attendants = false, bool $groups = false)
    {
        if ($attendants) {
            $this->meeting->refresh();
            $this->attendantNames = $this->meeting->attendants()->pluck('name')->toArray();
        }
        if ($groups) {
            $this->groupName = null;
            $this->existingGroups = Auth::user()->groups;
            $this->selectedGroup = '';
        }
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.dashboard.manage-attendants');
    }

    public function updateAttendant(Attendant $attendant, $nameIndex)
    {
        $attendant->name = $this->attendantNames[$nameIndex];
        $attendant->save();
        $this->refreshValues(attendants: true);
    }

    public function deleteAttendant(Attendant $attendant)
    {
        $attendant->delete();
        $this->refreshValues(attendants: true);
    }

    public function storeAttendant()
    {
        $this->meeting->attendants()->save(new Attendant(['name' => $this->newAttendant]));
        $this->newAttendant = '';
        $this->refreshValues(attendants: true);
    }

    public function loadGroup()
    {
        if (empty($this->selectedGroup)) {
            return;
        }
        if (! empty($this->attendantNames)) {
            abort(500);
        }
        $group = Group::findOrFail($this->selectedGroup);
        foreach ($group->members as $member) {
            $this->meeting->attendants()->save(new Attendant(['name' => $member->name]));
        }

        $this->refreshValues(attendants: true, groups: true);
    }

    public function storeGroup()
    {
        if (Auth::user()->groups()->where('name', $this->groupName)->exists()) {
            $this->addError('groupName', 'You have another group with this name');

            return;
        }
        if (empty($this->attendantNames)) {
            abort(500);
        }

        $group = Group::create([
            'user_id' => Auth::id(),
            'name' => $this->groupName,
        ]);

        foreach ($this->attendantNames as $attendantName) {
            $group->members()->save(new Member(['name' => $attendantName]));
        }

        $this->refreshValues(groups: true);
    }

    public function replaceGroup()
    {
        $group = Auth::user()->groups()->where('name', $this->groupName)->first();

        foreach ($group->members as $member) {
            $member->delete();
        }
        $group->refresh();

        foreach ($this->attendantNames as $attendantName) {
            $group->members()->save(new Member(['name' => $attendantName]));
        }

        $this->refreshValues(groups: true);
    }
}
