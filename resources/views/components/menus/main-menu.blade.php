@props(['title', 'icon' => 'ki-duotone ki-element-plus fs-2'])

<div x-data="{ open: false }" class="menu-item menu-accordion special rounded w-100">
    <div @click="open = !open" class="menu-link d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <span class="menu-icon me-2">
                <i class="{{ $icon }}">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
            </span>
            <span class="menu-title">{{ $title }}</span>
        </div>
        <span class="menu-arrow-mn" x-show="!open">
            <i class="bi bi-caret-down-fill"></i>
        </span>
        <span class="menu-arrow-mn" x-show="open">
            <i class="bi bi-caret-up-fill"></i>
        </span>
    </div>
    <div class="menu-sub mt-2" :class="{ 'show': open }">
        {{ $slot }}
    </div>
</div>
