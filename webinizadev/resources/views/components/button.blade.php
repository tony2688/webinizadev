@props(['variant' => 'primary', 'href' => '#', 'class' => ''])

<a href="{{ $href }}" 
   class="btn btn--{{ $variant }} {{ $class }}"
   {{ $attributes }}>
   {{ $slot }}
</a>