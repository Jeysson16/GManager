<x-app-layout>

    <section class="bg-red-200 dark:bg-red-800">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-red-600 dark:text-red-500">Sesión Cerrada</h1>
                <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">¡Gracias por utilizar nuestro servicio!</p>
                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Esperamos verte de nuevo pronto.</p>
                
                <!-- Botón para redirigir al usuario al inicio de sesión -->
                <a href="{{ route('login') }}" class="inline-block px-6 py-3 mt-8 text-base font-medium leading-6 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-800">
                    Iniciar Sesión
                </a>
            </div>   
        </div>
    </section>
</x-app-layout>