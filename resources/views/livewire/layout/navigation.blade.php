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
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Barra Lateral</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
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
