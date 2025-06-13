<?php

declare(strict_types=1);
use RectitudeOpen\FilaPressCore\Models\Admin;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    Role::create([
        'name' => 'super-admin',
        'guard_name' => 'admin',
    ]);
    $superAdmin = Admin::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@test.com',
        'password' => bcrypt('superadmin'),
    ]);
    $superAdmin->assignRole('super-admin');

    $this->response = $this->actingAs($superAdmin, 'admin')->get('/admin-admin');
});

it('can see core navigations in the admin panel', function () {

    $this->response->assertStatus(200);

    $this->response->assertSee('Content');
    $this->response->assertSee('Dashboard');
    $this->response->assertSee('News');
    $this->response->assertSee('Site Navigation');
    $this->response->assertSee('Media Manager');
    $this->response->assertSee('Pages');
    $this->response->assertSee('Contact Logs');
    $this->response->assertSee('Site Snippets');

    $this->response->assertSee('Security');
    $this->response->assertSee('Roles');
    $this->response->assertSee('Bans');
    $this->response->assertSee('Admins');
    $this->response->assertSee('Mail Log');
    $this->response->assertSee('Activity Log');

    $this->response->assertSee('Settings');
    $this->response->assertSee('System');
});
