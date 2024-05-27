<?php

it("should return status code 200", function () {
    $response = $this->get("/api");
    $response->assertStatus(200);
});
