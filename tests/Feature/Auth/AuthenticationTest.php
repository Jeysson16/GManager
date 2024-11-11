<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Livewire\Volt\Volt;

test('se puede renderizar la pantalla de inicio de sesión', function () {
    $response = $this->get('/login');

    $response
        ->assertSeeVolt('pages.auth.login')
        ->assertOk();
});

test('los usuarios pueden autenticarse usando la pantalla de inicio de sesión', function () {
    $user = User::factory()->create();

    $component = Volt::test('pages.auth.login')
        ->set('form.email', $user->email)
        ->set('form.password', 'password');

    $component->call('login');

    $component
        ->assertHasNoErrors()
        ->assertRedirect('mantenimiento');

    $this->assertAuthenticated();
});

test('los usuarios no pueden autenticarse con una contraseña inválida', function () {
    $user = User::factory()->create();

    $component = Volt::test('pages.auth.login')
        ->set('form.email', $user->email)
        ->set('form.password', 'contraseña-incorrecta');

    $component->call('login');

    $component
        ->assertHasErrors()
        ->assertNoRedirect();

    $this->assertGuest();
});

test('se puede renderizar el menú de navegación', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/');

    $response
        ->assertSeeVolt('layout.navigation')
        ->assertOk();
});

test('los usuarios pueden cerrar sesión', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('layout.navigation');

    $component->call('logout');

    $component
        ->assertHasNoErrors()
        ->assertRedirect('/gracias');

    $this->assertGuest();
});