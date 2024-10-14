<?php

use App\Livewire\Dashboard\ManageAttendants;
use App\Models\Attendant;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ManageAttendants::class)
        ->assertStatus(200);
});

it('exists on the page', function () {
    $user = User::factory()->has(Meeting::factory())->create();

    $this->actingAs($user)
        ->get(route('meetings.edit', $user->meetings->first()))
        ->assertSeeLivewire(ManageAttendants::class);
});

it('shows all the attendants of the meeting', function () {
    $user = User::factory()->has(
        Meeting::factory()->has(
            Attendant::factory()->count(11)
        )->count(2)
    )->create();
    $stranger = User::factory()->has(
        Meeting::factory()->has(
            Attendant::factory()->count(3)
        )
    )->create();
    $meeting = $user->meetings->first();

    Livewire::actingAs($user)
        ->test(ManageAttendants::class, compact('meeting'))
        ->assertViewHas('meeting', function ($meeting) {
            return count($meeting->attendants) === 11;
        });
});

it('can change the name of an attendant', function () {
    $user = User::factory()->has(
        Meeting::factory()->has(
            Attendant::factory()->count(11)
        )
    )->create();
    $meeting = $user->meetings->first();
    $attendant = $meeting->attendants->first();

    Livewire::actingAs($user)
        ->test(ManageAttendants::class, compact('meeting'))
        ->set('attendantNames.0', 'New name')
        ->call('updateAttendant', $attendant, 0);

    $attendant->refresh();
    $this->assertEquals($attendant->name, 'New name');
});

it('can delete an attendant', function () {
    $user = User::factory()->has(
        Meeting::factory()->has(
            Attendant::factory()->count(11)
        )
    )->create();
    $meeting = $user->meetings->first();
    $attendant = $meeting->attendants->first();

    Livewire::actingAs($user)
        ->test(ManageAttendants::class, compact('meeting'))
        ->call('deleteAttendant', $attendant);

    $meeting->refresh();
    $this->assertEquals($meeting->attendants->count(), 10);
});

it('can add an attendant', function () {
    $user = User::factory()->has(
        Meeting::factory()->has(
            Attendant::factory()->count(11)
        )
    )->create();
    $meeting = $user->meetings->first();

    Livewire::actingAs($user)
        ->test(ManageAttendants::class, compact('meeting'))
        ->set('newAttendant', 'New attendant')
        ->call('storeAttendant');

    $meeting->refresh();
    $this->assertEquals($meeting->attendants->count(), 12);
});
