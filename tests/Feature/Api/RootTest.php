<?php

it("should return status code 200", function () {
    $response = $this->get(route("api.root"));
    $response->assertOk();
});
