<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Models\Meeting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class MeetingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeetingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if ($validated['date'] ?? false) {
            $validated['when'] = $validated['date'].' '.$validated['time'] ?? '00:00';
        }

        $meeting = Meeting::create($validated);

        return Redirect::route('meetings.edit', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        Gate::authorize('update', $meeting);

        return view('meetings.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        Gate::authorize('update', $meeting);

        $validated = $request->validated();
        if ($validated['date'] ?? false) {
            $validated['when'] = $validated['date'].' '.$validated['time'] ?? '00:00';
        }

        $meeting->update($validated);

        return Redirect::route('meetings.edit', compact('meeting'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        Gate::authorize('delete', $meeting);

        $meeting->delete();

        return Redirect::route('dashboard');
    }
}
