@props(['route', 'title' => '', 'activeRoutes' => []])

@php
$currentRouteName = Route::currentRouteName();
$isActive = in_array($currentRouteName, $activeRoutes);
$classes = $isActive ? 'menu-link active' : 'menu-link';
@endphp

<div class="menu-item">
    <a wire:navigate class="{{ $classes }}" href="{{ route($route) }}">
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        <span class="menu-title">{{ $title }}</span>
    </a>
</div>