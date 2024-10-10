<?php

use App\Livewire\Dashboard\NewMeetingForm;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    Livewire::test(NewMeetingForm::class)
        ->assertStatus(200);
});

it('exists on the page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertSeeLivewire(NewMeetingForm::class);
});

it('can create a new meeting', function () {
    $user = User::factory()->create();

    $this->assertEquals(0, Meeting::count());

    Livewire::actingAs($user)
        ->test(NewMeetingForm::class)
        ->set('name', 'A cool name')
        ->call('storeNewMeeting');

    $this->assertEquals(1, Meeting::count());
});

it('cannot create a meeting without a name', function () {
    $user = User::factory()->create();

    $this->assertEquals(0, Meeting::count());

    Livewire::actingAs($user)
        ->test(NewMeetingForm::class)
        ->set('name', '')
        ->call('storeNewMeeting');

    $this->assertEquals(0, Meeting::count());
});

it('cannot reuse the name of the meeting', function () {
    $user = User::factory()->create();

    $this->assertEquals(0, Meeting::count());

    Livewire::actingAs($user)
        ->test(NewMeetingForm::class)
        ->set('name', 'Super cool name')
        ->call('storeNewMeeting');

    Livewire::actingAs($user)
        ->test(NewMeetingForm::class)
        ->set('name', 'Super cool name')
        ->call('storeNewMeeting');

    $this->assertEquals(1, Meeting::count());
});
