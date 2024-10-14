<?php

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('is not visible (create) for unauthorized users', function () {
    $response = $this->get(route('meetings.create'));

    $response->assertRedirect();
});

it('shows the create page to any user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('meetings.create'));

    $response->assertStatus(200);
});

it('can create a new meeting', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('meetings.store'), [
        'name' => 'A cool name',
    ]);

    $this->assertEquals(1, Meeting::count());
});

it('cannot create a meeting without a name', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('meetings.store'), [
        'name' => '',
    ]);

    $this->assertEquals(0, Meeting::count());
});

it('cannot reuse the name of the meeting', function () {
    $user = User::factory()->create();

    $this->assertEquals(0, Meeting::count());

    $this->actingAs($user)->post(route('meetings.store'), [
        'name' => 'Super cool name',
    ]);

    $this->actingAs($user)->post(route('meetings.store'), [
        'name' => 'Super cool name',
    ]);

    $this->assertEquals(1, Meeting::count());
});

it('is not visible (edit) for unauthorized users', function () {
    $meeting = Meeting::factory()->create();

    $response = $this->get(route('meetings.edit', $meeting));

    $response->assertRedirect();
});

it('shows the edit page only if you are the owner of the meeting', function () {
    $user = User::factory()->has(Meeting::factory())->create();
    $stranger = User::factory()->create();

    $response = $this->actingAs($user)->get(route('meetings.edit', $user->meetings->first()));
    $response->assertStatus(200);

    $response = $this->actingAs($stranger)->get(route('meetings.edit', $user->meetings->first()));
    $response->assertForbidden();
});

it('doesn\'t allow to empty the meeting name', function () {
    $user = User::factory()->has(Meeting::factory())->create();
    $meeting = $user->meetings->first();

    $this->actingAs($user)->post(route('meetings.update', $meeting), [
        'name' => '',
    ]);

    $this->assertNotEquals('', $meeting->name);
});

it('only allows the owner of the meeting to update it', function () {
    $user = User::factory()->has(Meeting::factory())->create();
    $meeting = $user->meetings->first();
    $stranger = User::factory()->create();

    $this->actingAs($user)->put(route('meetings.update', $meeting), [
        'name' => 'New name',
    ]);
    $meeting->refresh();
    $this->assertEquals('New name', $meeting->name);

    $this->actingAs($stranger)->put(route('meetings.update', $meeting), [
        'name' => 'Another name',
    ]);
    $meeting->refresh();
    $this->assertNotEquals('Another name', $meeting->name);
});

it('only allows the owner of the meeting to delete it', function () {
    $user = User::factory()->has(Meeting::factory())->create();
    $meeting = $user->meetings->first();
    $stranger = User::factory()->create();

    $this->actingAs($stranger)->delete(route('meetings.destroy', $meeting));
    $this->assertEquals(1, Meeting::count());

    $this->actingAs($user)->delete(route('meetings.destroy', $meeting));
    $this->assertEquals(0, Meeting::count());
});
