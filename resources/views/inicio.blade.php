<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl text-red-600 dark:text-red-400">Servicios Especializados para tu Calzado</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Cada uno de nuestros servicios está diseñado para ofrecerte la máxima precisión, calidad e innovación, asegurando que tu calzado sea único y de alto rendimiento.</p>
            <div class="grid gap-8 mt-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
                @foreach ($categories as $category)
                    <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <h3 class="text-2xl font-bold text-blue-900 dark:text-red-400 mb-4">{{ $category->title }}</h3>
                        <div class="category-description">{!! $category->description !!}</div>
                        <a class="inline-flex items-center mt-4 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-500">
                            Aprende más
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l7-7-7-7"></path></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Estilos específicos para este archivo -->
    <style>
        .category-description p {
            margin-top: 0.5rem; /* mt-2 */
            color: #1f2937; /* text-gray-900 */
        }

        .dark .category-description p {
            color: #e5e7eb; /* dark:text-gray-200 */
        }
    </style>
</x-guest-layout>
