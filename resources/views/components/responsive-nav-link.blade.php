@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-green-400 text-start text-base font-medium text-white bg-[#232E47] focus:outline-none focus:text-white focus:bg-[#2A3548] focus:border-green-500 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-300 hover:text-white hover:bg-[#232E47] hover:border-gray-500 focus:outline-none focus:text-white focus:bg-[#232E47] focus:border-gray-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
