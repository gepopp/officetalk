<?php

use Livewire\Component;

new class extends Component {
    // Reine Chrome-Komponente — State läuft vollständig über Alpine.store('videoLightbox').
};
?>

<div
    data-officetalk-lightbox
    x-cloak
    x-data="officetalkVideoLightbox"
    x-show="$store.videoLightbox.isOpen"
    @keydown.escape.window="$store.videoLightbox.close()"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-ink/90 px-s3 backdrop-blur-md"
    role="dialog"
    aria-modal="true"
    aria-label="Video im Fokus-Modus"
    @click.self="$store.videoLightbox.close()"
>
    {{-- Close-Button · top-right --}}
    <button
        type="button"
        @click="$store.videoLightbox.close()"
        class="absolute right-s3 top-s3 flex h-12 w-12 items-center justify-center rounded-full bg-bg/10 text-bg transition-colors duration-200 hover:bg-accent hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent md:right-s5 md:top-s5"
        aria-label="Schließen"
    >
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
            <line x1="3" y1="3" x2="15" y2="15" />
            <line x1="15" y1="3" x2="3" y2="15" />
        </svg>
    </button>

    {{-- Player-Container · max 1280×720 (720p) · clamped per Viewport --}}
    <div
        class="relative aspect-video w-[min(100vw-48px,1280px)] max-h-[min(100vh-96px,720px)] overflow-hidden rounded-sm bg-surface-strong shadow-[0_48px_96px_-32px_rgba(0,0,0,0.6)]"
        x-transition:enter="transition ease-out duration-400 delay-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        {{-- Iframe · controls=0 → Vimeo-UI deaktiviert, unser Overlay übernimmt --}}
        <template x-if="$store.videoLightbox.isOpen && $store.videoLightbox.vimeoId">
            <iframe
                :src="`https://player.vimeo.com/video/${$store.videoLightbox.vimeoId}?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;controls=0&amp;dnt=1&amp;quality=720p`"
                :title="$store.videoLightbox.title || 'OfficeTalk Video'"
                class="absolute inset-0 h-full w-full"
                frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture"
                allowfullscreen
                @load="attachPlayer($el)"
            ></iframe>
        </template>

        {{-- Custom Controls · identisch zu Hero/Format-Player, ohne Fullscreen-Button --}}
        <div
            x-show="ready"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="pointer-events-auto absolute bottom-s3 left-s3 right-s3 flex items-center justify-between"
        >
            <div class="flex items-center gap-s1 rounded-full bg-ink/85 p-1 text-bg backdrop-blur-sm">
                <button
                    type="button"
                    @click="togglePlay()"
                    class="flex h-10 w-10 items-center justify-center rounded-full transition-colors duration-180 hover:bg-accent hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                    :aria-label="isPlaying ? 'Pause' : 'Wiedergabe'"
                >
                    <svg x-show="isPlaying" width="14" height="16" viewBox="0 0 14 16" fill="currentColor" aria-hidden="true">
                        <rect x="1" y="1" width="4" height="14" />
                        <rect x="9" y="1" width="4" height="14" />
                    </svg>
                    <svg x-show="!isPlaying" x-cloak width="14" height="16" viewBox="0 0 14 16" fill="currentColor" aria-hidden="true">
                        <path d="M 1 1 L 13 8 L 1 15 Z" />
                    </svg>
                </button>

                <button
                    type="button"
                    @click="toggleMute()"
                    class="flex h-10 w-10 items-center justify-center rounded-full transition-colors duration-180 hover:bg-accent hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                    :aria-label="isMuted ? 'Ton einschalten' : 'Stummschalten'"
                >
                    <svg x-show="!isMuted" width="18" height="16" viewBox="0 0 18 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M 1 6 L 1 10 L 4 10 L 8 13 L 8 3 L 4 6 Z" fill="currentColor" />
                        <path d="M 11 5.5 C 12.5 6.5 12.5 9.5 11 10.5" />
                        <path d="M 13.5 3.5 C 16 5 16 11 13.5 12.5" />
                    </svg>
                    <svg x-show="isMuted" x-cloak width="18" height="16" viewBox="0 0 18 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M 1 6 L 1 10 L 4 10 L 8 13 L 8 3 L 4 6 Z" fill="currentColor" />
                        <line x1="12" y1="5" x2="17" y2="11" />
                        <line x1="17" y1="5" x2="12" y2="11" />
                    </svg>
                </button>
            </div>

            {{-- Titel-Label rechts, wenn verfügbar --}}
            <span
                x-show="$store.videoLightbox.title"
                x-text="$store.videoLightbox.title"
                class="pointer-events-none max-w-[60%] truncate rounded-full bg-ink/85 px-s3 py-s1 font-sans text-meta font-medium text-bg backdrop-blur-sm"
            ></span>
        </div>
    </div>
</div>
