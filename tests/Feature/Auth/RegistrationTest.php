<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Livewire\Volt\Volt;

test('la pantalla de registro puede renderizarse', function () {
    $response = $this->get('/register');

    $response
        ->assertSeeVolt('pages.auth.register')
        ->assertOk();
});

test('nuevos usuarios pueden registrarse', function () {
    $component = Volt::test('pages.auth.register')
        ->set('name', 'Usuario de Prueba')
        ->set('email', 'prueba@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password');

    $component->call('register');

    $component->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});
