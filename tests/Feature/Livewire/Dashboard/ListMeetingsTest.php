<?php

use App\Livewire\Dashboard\ListMeetings;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ListMeetings::class)
        ->assertStatus(200);
});

it('exists on the page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertSeeLivewire(ListMeetings::class);
});

it('shows all the meetings of the user, and none from others', function () {
    $user = User::factory()->has(Meeting::factory()->count(5))->create();
    $stranger = User::factory()->has(Meeting::factory()->count(3))->create();

    Livewire::actingAs($user)
        ->test(ListMeetings::class)
        ->assertViewHas('meetings', function ($meetings) {
            return count($meetings) === 5;
        });
});
