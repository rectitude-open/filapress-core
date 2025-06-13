<?php

declare(strict_types=1);

use Livewire\Livewire;
use RectitudeOpen\FilaPressCore\Filament\Pages\Auth\Login;
use RectitudeOpen\FilaPressCore\Models\Admin;
use Spatie\Permission\Models\Role;

test('admin panel is accessible', function () {
    $response = $this->get('/admin-admin');
    $response->assertRedirect('/admin-admin/login');

    $response = $this->get('/admin-admin/login');
    $response->assertStatus(200);
});

test('it can show default user login page', function () {
    Livewire::test(Login::class)
        ->assertSee('Email')
        ->assertSee('Password')
        ->assertSee('Remember me');
});

it('can validate the login form', function () {
    Livewire::test(Login::class)
        ->set('data.email', 'invaliduser@test.com')
        ->set('data.password', 'invalidpassword')
        ->call('authenticate')
        ->assertHasErrors(['data.email']);
});

it('can login with valid credentials', function () {
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

    Livewire::test(Login::class)
        ->set('data.email', 'superadmin@test.com')
        ->set('data.password', 'superadmin')
        ->call('authenticate')
        ->assertRedirect('/admin-admin');

    $this->assertAuthenticatedAs($superAdmin, 'admin');

    $response = $this->actingAs($superAdmin, 'admin')->get('/admin-admin');

    $response->assertStatus(200);
    $response->assertSee('Dashboard');
});
