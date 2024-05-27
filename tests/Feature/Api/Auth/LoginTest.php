<?php

use App\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\postJson;

it("should auth user", function () {
    $user = User::factory()->create();

    $data = [
        "email" => $user->email,
        "password" => "password",
    ];

    $response = postJson(route("auth.login"), $data);
    $response->assertOk()->assertJsonStructure(["data" => ["token"]]);
});

it("should fail user's auth", function () {
    $user = User::factory()->create();

    $data = [
        "email" => "user@no-email.com",
        "password" => "password",
    ];

    $response = postJson(route("auth.login"), $data);
    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});
