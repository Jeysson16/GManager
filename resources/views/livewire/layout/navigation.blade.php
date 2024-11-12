<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Forms\LogoutForm;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/gracias', navigate: true);
    }
}; ?>
<nav x-data="{ open: false }" class="fixed top-0 z-50 w-full bg-white dark:bg-gray-800 dark:border-gray-700">
   <div class="px-3 py-3 lg:px-5 lg:pl-3 relative">
       <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <a href="/" class="absolute left-0 flex ms-2">
                  <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-red-600 dark:text-red-400">GM</span>
                  <span class="ml-1 self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-blue-900 dark:text-white">Estilos</span>
                </a>
                
            </div>
            <div class="flex items-center justify-center w-full">
                <!-- New Navigation Links -->
                <ul class="flex space-x-4 mx-auto">
                    <li>
                        <a href="/" class="text-gray-900 dark:text-white hover:bg-red-100 dark:hover:bg-red-500 rounded-lg px-4 py-2">Inicio</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-900 dark:text-white hover:bg-red-100 dark:hover:bg-red-500 rounded-lg px-4 py-2">Servicios</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-900 dark:text-white hover:bg-red-100 dark:hover:bg-red-500 rounded-lg px-4 py-2">Pedidos</a>
                    </li>
                    @guest
                    @else
                    <li>
                        <a href="/mantenimiento" class="text-gray-900 dark:text-white hover:bg-red-100 dark:hover:bg-red-500 rounded-lg px-4 py-2">Mantenimiento</a>
                    </li>
                    @endguest
                </ul>
            </div>
            <button id="theme-toggle">
                <span id="theme-toggle-dark-icon" class="hidden">🌙</span>
                <span id="theme-toggle-light-icon" class="hidden">☀️</span>
            </button>
            <!-- User Menu -->
            <div class="flex items-center ms-3">
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Menú de usuario</span>
                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                    <div class="px-4 py-3">
                        <p class="text-sm text-gray-900 dark:text-white">
                            @guest
                            Regístrese
                            @else
                            {{ auth()->user()->name }}
                            @endguest
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300">
                            @guest
                            @else
                            {{ auth()->user()->email }}
                            @endguest
                        </p>
                    </div>
                    <ul class="py-1">
                        <li><a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Perfil</a></li>
                        <li>
                            @guest
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Login</a>
                            @else
                            <button wire:click="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Log Out</button>
                            @endguest
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Accede al botón y a los iconos
        const themeToggleButton = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Comprobar el tema actual y establecer el estado inicial de los íconos
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        }

        // Alternar entre tema claro y oscuro cuando se haga clic en el botón
        themeToggleButton.addEventListener('click', () => {
            if (document.documentElement.classList.contains('dark')) {
                // Cambiar a tema claro
                document.documentElement.classList.remove('dark');
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
                localStorage.setItem('theme', 'light');
            } else {
                // Cambiar a tema oscuro
                document.documentElement.classList.add('dark');
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
                localStorage.setItem('theme', 'dark');
            }
        });
    });
</script>
