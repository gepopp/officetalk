<?php

use Livewire\Component;

new class extends Component {};
?>

<nav
    data-officetalk-nav
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
    @click.outside="open = false"
    class="sticky top-0 z-50 border-b border-line bg-bg/95 backdrop-blur-md transition-all duration-220 ease-editorial data-[compact=true]:py-s2"
    aria-label="OfficeTalk Navigation"
>
    <div class="container flex items-center justify-between py-s3">
        <a
            href="{{ route('officetalk.landing') }}"
            class="flex items-center gap-s1 font-display text-2xl font-medium leading-none tracking-tight text-ink"
            aria-label="OfficeTalk Startseite"
        >
            <span class="text-accent">
                <x-officetalk::logo-mark :size="72" color="currentColor" />
            </span>
            <span>OfficeTalk</span>
        </a>

        <div class="hidden items-center gap-s3 font-sans text-body text-ink lg:flex">
            <a href="{{ route('officetalk.landing') }}#distribution" wire:navigate class="officetalk-link">Distribution</a>
            <a href="{{ route('officetalk.landing') }}#service" wire:navigate class="officetalk-link">Prozess</a>
            <a href="{{ route('officetalk.landing') }}#formats" wire:navigate class="officetalk-link">Formate</a>
            <a href="{{ route('officetalk.landing') }}#preise" wire:navigate class="officetalk-link">Preise</a>
            <a href="{{ route('officetalk.landing') }}#faq" wire:navigate class="officetalk-link">FAQ</a>
        </div>

        <div class="flex items-center gap-s3">
            <span class="hidden md:block">
                <x-officetalk::button
                    variant="secondary"
                    href="{{ route('officetalk.landing') }}#kontakt"
                    class="px-4 py-2.5 text-sm tracking-wide"
                >
                    Termin vereinbaren
                </x-officetalk::button>
            </span>

            <button
                type="button"
                @click.stop="open = !open"
                :aria-expanded="open.toString()"
                aria-controls="officetalk-mobile-menu"
                class="flex h-11 w-11 items-center justify-center rounded text-ink transition-colors duration-180 hover:bg-surface focus-visible:outline focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-ink lg:hidden"
            >
            <span class="sr-only">Menü öffnen</span>
            <svg x-show="!open" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" aria-hidden="true">
                <line x1="4" y1="7" x2="20" y2="7" />
                <line x1="4" y1="12" x2="20" y2="12" />
                <line x1="4" y1="17" x2="20" y2="17" />
            </svg>
            <svg x-show="open" x-cloak width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" aria-hidden="true">
                <line x1="6" y1="6" x2="18" y2="18" />
                <line x1="18" y1="6" x2="6" y2="18" />
            </svg>
            </button>
        </div>
    </div>

    <div
        id="officetalk-mobile-menu"
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-220"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="border-t border-line bg-bg lg:hidden"
    >
        <ul class="container divide-y divide-line font-display text-h3 font-medium text-ink">
            <li>
                <a href="{{ route('officetalk.landing') }}#distribution" @click="open = false" class="block py-s3">Distribution</a>
            </li>
            <li>
                <a href="{{ route('officetalk.landing') }}#service" @click="open = false" class="block py-s3">Prozess</a>
            </li>
            <li>
                <a href="{{ route('officetalk.landing') }}#formats" @click="open = false" class="block py-s3">Formate</a>
            </li>
            <li>
                <a href="{{ route('officetalk.landing') }}#preise" @click="open = false" class="block py-s3">Preise</a>
            </li>
            <li>
                <a href="{{ route('officetalk.landing') }}#faq" @click="open = false" class="block py-s3">FAQ</a>
            </li>
        </ul>
        <div class="container border-t border-line py-s4">
            <x-officetalk::button
                variant="primary"
                icon="koffer"
                href="{{ route('officetalk.landing') }}#kontakt"
                class="w-full justify-center"
                x-on:click="open = false"
            >
                Termin vereinbaren
            </x-officetalk::button>
        </div>
    </div>

    <div data-officetalk-progress class="officetalk-progress" aria-hidden="true"></div>
</nav>
