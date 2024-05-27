<?php

use App\Models\User;

use function Pest\Laravel\postJson;

it("should auth user", function () {
    $user = User::factory()->create();

    $data = [
        "email" => $user->email,
        "password" => "password",
    ];

    $response = postJson("/api/auth/login", $data);
    $response->assertStatus(200);
});
