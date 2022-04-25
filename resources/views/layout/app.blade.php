<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
          darkMode: localStorage.darkMode || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
          toggleTheme: function () {
              this.darkMode ? localStorage.removeItem('darkMode') : localStorage.darkMode = true;
              this.darkMode = !this.darkMode
          }
      }"
      x-bind:class="darkMode ? 'dark' : ''">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layout._seo')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 text-gray-900 transition dark:bg-neutral-900 dark:text-neutral-200">
    <div class="max-w-3xl mx-auto p-6 md:p-4">
        @include('layout._navigation')

        @if (flash()->message)
            <x-alert :type="flash()->level">{{ flash()->message }}</x-alert>
        @endif

        <main>
            {{ $slot }}
        </main>

        @include('layout._footer')
    </div>
</body>
</html>
