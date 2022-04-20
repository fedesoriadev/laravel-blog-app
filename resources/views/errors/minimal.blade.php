<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | {{ config('app.name') }}</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="antialiased">
        <main class="grid place-content-center place-items-center min-h-screen">
            <x-logo :href="route('home')" class="my-6"/>

            <div class="flex flex-auto items-center justify-center text-center px-4 flex-col sm:flex-row">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight sm:pr-6 sm:mr-6 sm:border-r sm:border-slate-900/10 sm:dark:border-slate-300/10 dark:text-slate-200">
                    @yield('code')
                </h1>
                <h2 class="mt-2 text-lg text-slate-700 font-semibold dark:text-slate-400 sm:mt-0">
                    @yield('message')
                </h2>
            </div>
        </main>
    </body>
</html>
