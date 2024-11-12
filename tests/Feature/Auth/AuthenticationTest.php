<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Livewire\Volt\Volt;

test('se puede renderizar la pantalla de inicio de sesión', function () {
    // Envía una solicitud GET a la URL de inicio de sesión y verifica que la pantalla se renderiza correctamente.
    $response = $this->get('/login');

    // Asegura que la vista 'pages.auth.login' se esté mostrando y que la respuesta sea exitosa (200 OK).
    $response
        ->assertSeeVolt('pages.auth.login')
        ->assertOk();
});

test('los usuarios pueden autenticarse usando la pantalla de inicio de sesión', function () {
    // Crea un usuario de prueba.
    $user = User::factory()->create();

    // Simula el componente de inicio de sesión con los datos de usuario.
    $component = Volt::test('pages.auth.login')
        ->set('form.email', $user->email)
        ->set('form.password', 'password');

    // Llama al método de inicio de sesión en el componente.
    $component->call('login');

    // Verifica que no haya errores, redirecciona a la ruta de 'mantenimiento' y que el usuario esté autenticado.
    $component
        ->assertHasNoErrors()
        ->assertRedirect('mantenimiento');

    $this->assertAuthenticated();
});

test('los usuarios no pueden autenticarse con una contraseña inválida', function () {
    // Crea un usuario de prueba.
    $user = User::factory()->create();

    // Simula el componente de inicio de sesión con el correo correcto pero una contraseña incorrecta.
    $component = Volt::test('pages.auth.login')
        ->set('form.email', $user->email)
        ->set('form.password', 'contraseña-incorrecta');

    // Llama al método de inicio de sesión en el componente.
    $component->call('login');

    // Verifica que aparezcan errores, que no haya redireccionamiento, y que el usuario siga sin autenticarse.
    $component
        ->assertHasErrors()
        ->assertNoRedirect();

    $this->assertGuest();
});

test('se puede renderizar el menú de navegación', function () {
    // Crea un usuario de prueba y lo autentica.
    $user = User::factory()->create();
    $this->actingAs($user);

    // Envía una solicitud GET a la página principal y verifica que el menú de navegación se renderiza correctamente.
    $response = $this->get('/');

    // Asegura que la vista 'layout.navigation' se esté mostrando y que la respuesta sea exitosa (200 OK).
    $response
        ->assertSeeVolt('layout.navigation')
        ->assertOk();
});

test('los usuarios pueden cerrar sesión', function () {
    // Crea un usuario de prueba y lo autentica.
    $user = User::factory()->create();
    $this->actingAs($user);

    // Simula el componente de navegación y llama al método de cierre de sesión.
    $component = Volt::test('layout.navigation');
    $component->call('logout');

    // Verifica que no haya errores, que redireccione a la ruta de agradecimiento y que el usuario quede sin autenticarse.
    $component
        ->assertHasNoErrors()
        ->assertRedirect('/gracias');

    $this->assertGuest();
});
