<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('can get my user via Sanctum', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user,['*']);

    $response = $this->get(route('sanctum.user'));

    $response->assertStatus(200);
    $response->assertJsonFragment([
        'id' => $user->id,
        'name' => $user->name,
    ]);
});

test('Sanctum blocks not logged user', function () {
    User::factory()->create(); // random user exists

    $response = $this->get(route('sanctum.user'));

    $response->assertUnauthorized();
});

test('get all users visa Sanctum', function () {
    $myUser = User::factory()->create();
    $anotherUser = User::factory()->create();
    Sanctum::actingAs($myUser,['*']);

    $response = $this->get(route('sanctum.users'));

    $response->assertOk();
    expect($response->content())
        ->toBeJson()
        ->toContain($myUser->name)
        ->toContain($anotherUser->name);
});
