<?php

use App\Models\User;
use Firebase\JWT\JWT;
use function Pest\Laravel\getJson;
use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

test('can login and obtain JWT token', function () {
    $user = User::factory()->create([
        'email' => 'test@mint.dev',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ]);

    $response = postJson(route('jwt.login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk();
    expect($response->content())
        ->toBeJson()
        ->json()
        ->status->toBe('success')
        ->token->toBeString();
});

test('cannot login and obtain JWT token without correct credentials', function () {
    User::factory()->create();

    $response = post(route('jwt.login'));

    $response->assertUnauthorized();
});

test('payload JWT test', function () {
    $issuedAt = time();
    $payloadJWT = [
        'iss' => 'https://api.mintdev.me',
        'aud' => 'https://api.mintdev.me',
        'iat' => $issuedAt,
        'bf' => $issuedAt,
        'data' => [
            'email' => "testemail@mintdev.me",
            'name' => "MyName",
        ]
    ];

    $jwt = JWT::encode($payloadJWT, config('jwt.JWT_SECRET'), 'HS256');

    $response = getJson(route('jwt.check'),[
        'Authorization'=>'Bearer '.$jwt
    ]);

    expect($response->content())
        ->toBeJson()
        ->json()
        ->status->toBe('success')
        ->decoded_payload->data->email->toBe("testemail@mintdev.me")
        ->decoded_payload->data->name->toBe("MyName");
});
