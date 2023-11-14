<?php

use App\Models\User;

it('can get all users', function () {

    $user = User::factory()->create();

    $response = $this->get('/api/users/'.$user->id);
    $response->assertStatus(200);
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});
