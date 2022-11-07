<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('can get my user via sanctum', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->get(route('sanctum-user'));
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'id' => $user->id,
        'name' => $user->name,
    ]);
});

test('sanctum blocks not logged user', function () {
    $user = User::factory()->create();

    $response = $this->get(route('sanctum-user'));
    $response->assertUnauthorized();
});