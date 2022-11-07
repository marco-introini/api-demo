<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

it('can get all users', function () {

    $user = User::factory()->create();

    $response = $this->get('/api/users/'.$user->id);
    $response->assertStatus(200);
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});
