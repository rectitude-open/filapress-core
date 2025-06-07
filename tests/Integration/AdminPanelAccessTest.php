<?php

declare(strict_types=1);

test('admin panel is accessible', function () {
    $response = $this->get('/admin-admin/login');

    $response->assertStatus(200);
});
