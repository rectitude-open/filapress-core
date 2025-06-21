<?php

declare(strict_types=1);

use RectitudeOpen\FilaPressCore\Models\Admin;
use Spatie\Permission\Models\Role;

it('can see navigations in the admin panel if the user is a super admin', function (string $nav) {
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

    $response = $this->actingAs($superAdmin, 'admin')->get('/admin-admin');

    $response->assertStatus(200);

    $response->assertSee($nav);
})->with(['Content', 'Dashboard', 'News', 'Site Navigation', 'Media', 'Pages', 'Contact Logs', 'Site Snippets', 'Security', 'Roles', 'Bans', 'Admins', 'Mail Log', 'Activity Log', 'Settings', 'System']);

it('cannot see navigations in the admin panel if the user is not a super admin', function (string $nav) {
    Role::create([
        'name' => 'webmaster',
        'guard_name' => 'admin',
    ]);
    $webmaster = Admin::create([
        'name' => 'User',
        'email' => 'webmaster@test.com',
        'password' => bcrypt('webmaster'),
    ]);

    $webmaster->assignRole('webmaster');
    $response = $this->actingAs($webmaster, 'admin')->get('/admin-admin');

    $response->assertStatus(200);

    $response->assertDontSee($nav);

})->with(['News', 'Site Navigation', 'Pages', 'Contact Logs', 'Site Snippets', 'Security', 'Roles', 'Bans', 'Admins', 'Mail Log', 'Activity Log', 'Settings', 'System']);
