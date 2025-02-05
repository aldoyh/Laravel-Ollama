<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Ollama</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen min-w-min bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <!-- Toast Container -->
        <div x-data="{ show: @json(isset($errorMessage)), message: @json($errorMessage ?? '') }"
             x-show="show"
             x-init="setTimeout(() => show = false, 3000)"
             class="fixed top-4 right-4 z-50">
            <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-full"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform translate-x-full">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span x-text="message"></span>
                </div>
            </div>
        </div>

        <div class="w-full sm:4/6 lg:3/6 sm:w-5/6 lg:w-4/6 xl:w-3/6 mx-auto p-12 min-h-screen">

            @include('prompt.top')

            <div class="mt-16">

                @include('prompt.form')
                @include('prompt.spinner')

                @if (isset($response))
                    @include('prompt.response')
                @endif

            </div>

            {{-- @if (isset($errorMessage))
                @include('prompt.error')
            @endif --}}

            @include('prompt.footer')
        </div>
    </div>
</body>

</html>
