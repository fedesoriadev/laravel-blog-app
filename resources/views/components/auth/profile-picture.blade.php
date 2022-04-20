@if ($user->profile_picture)
    <img src="{{ $user->profile_picture }}"
         alt="{{ $user->name }}"
         {{ $attributes->merge(['class' => 'rounded-full object-contain ' . $size()]) }}>
@else
    <svg xmlns="http://www.w3.org/2000/svg"
         {{ $attributes->merge(['class' => 'text-indigo-600 ' . $size()]) }}
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24"
         stroke-width="2">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
@endif
