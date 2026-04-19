<?php

use Livewire\Component;
use Officetalk\Models\Episode;
use Officetalk\Support\VimeoClient;

new class extends Component {
    public ?Episode $featured = null;

    /**
     * @var array<int, array{id:string,title:?string,link:?string,thumbnail:?string}>
     */
    public array $videos = [];

    public ?string $activeId = null;

    public ?string $activeTitle = null;

    public bool $playback = false;

    public function loadLatestVimeos(): void
    {
        $tag = config('officetalk.video.vimeo.tag', 'officetalk');
        $this->videos = VimeoClient::latestByTag($tag, 4);

        if (! empty($this->videos)) {
            $this->activeId = $this->videos[0]['id'];
            $this->activeTitle = $this->videos[0]['title'];
        }
    }

    public function selectVideo(string $id): void
    {
        foreach ($this->videos as $video) {
            if ($video['id'] === $id) {
                $this->activeId = $id;
                $this->activeTitle = $video['title'];
                $this->playback = true;

                return;
            }
        }
    }

    /**
     * Rotiert im Hintergrund-Modus zum nächsten Video (zirkulär).
     * Wird vom Alpine-Observer auf das Vimeo-"ended"-Event ausgelöst.
     */
    public function advanceToNextVideo(): void
    {
        $count = count($this->videos);
        if ($count <= 1) {
            return;
        }

        $currentIndex = 0;
        foreach ($this->videos as $i => $video) {
            if ($video['id'] === $this->activeId) {
                $currentIndex = $i;
                break;
            }
        }

        $nextIndex = ($currentIndex + 1) % $count;
        $this->activeId = $this->videos[$nextIndex]['id'];
        $this->activeTitle = $this->videos[$nextIndex]['title'];
        // $this->playback bleibt unverändert — Hintergrund-Loop läuft nahtlos weiter
    }

    public function embedUrl(): ?string
    {
        if (! $this->activeId) {
            return null;
        }

        $base = config('officetalk.video.vimeo.player_url', 'https://player.vimeo.com/video/');
        $defaults = config('officetalk.video.vimeo.default_params', []);

        // controls=0 → keine Vimeo-UI, unser Custom-Overlay übernimmt.
        // Kein background=1 — das würde intern Looping erzwingen und das `ended`-Event unterdrücken.
        $params = $this->playback
            ? ['autoplay' => 1, 'muted' => 0, 'loop' => 0, 'controls' => 0, 'background' => 0]
            : ['autoplay' => 1, 'muted' => 1, 'loop' => 0, 'controls' => 0, 'background' => 0];

        return $base.$this->activeId.'?'.http_build_query(array_merge($defaults, $params));
    }

    /**
     * Die drei Videos unterhalb des Players — alles außer dem aktuell aktiven.
     *
     * @return array<int, array{id:string,title:?string,link:?string,thumbnail:?string}>
     */
    public function getGridVideosProperty(): array
    {
        return array_values(array_filter(
            $this->videos,
            fn ($v) => $v['id'] !== $this->activeId,
        ));
    }

    /**
     * Das nächste Video in der Rotation · wird im Countdown-Overlay angeteasert.
     *
     * @return array{id:string,title:?string,link:?string,thumbnail:?string}|null
     */
    public function getNextVideoProperty(): ?array
    {
        $count = count($this->videos);
        if ($count <= 1) {
            return null;
        }

        $currentIndex = 0;
        foreach ($this->videos as $i => $video) {
            if ($video['id'] === $this->activeId) {
                $currentIndex = $i;
                break;
            }
        }

        return $this->videos[($currentIndex + 1) % $count];
    }
};
?>

@script
<script>
    Alpine.data('officetalkHeroVideo', () => ({
        // — Alpine-reactive UI-State —
        ready: false,
        isVisible: true,
        isPlaying: true,
        isMuted: true,
        countdown: null,

        // — Player + Observer als Alpine-Properties, über rawPlayer() entwrappt zum SDK-Call —
        player: null,
        visibilityObserver: null,

        // Liefert die nicht-reaktive Player-Instanz.
        // Alpine wrappt Properties in einen Proxy — bei den Vimeo-SDK-Interna
        // führt das zu "Unknown player unloaded". Alpine.raw() gibt den Urwert zurück.
        rawPlayer() {
            return this.player ? Alpine.raw(this.player) : null;
        },

        // ————— Lifecycle —————

        init() {
            this.startVisibilityTracking();
        },

        destroy() {
            this.visibilityObserver?.disconnect();
            this.destroyPlayer();
        },

        // ————— Player-Attach/Detach —————

        async attachPlayer(iframe) {
            await this.destroyPlayer();

            if (! window.VimeoPlayer || ! iframe) return;

            this.player = new window.VimeoPlayer(iframe);
            this.bindPlayerEvents();
            await this.syncInitialState();

            setTimeout(() => { this.ready = true; }, 300);
        },

        async destroyPlayer() {
            const p = this.rawPlayer();
            if (! p) return;
            try { await p.destroy(); } catch (e) { /* ignorieren */ }
            this.player = null;
        },

        bindPlayerEvents() {
            const p = this.rawPlayer();
            if (! p) return;

            p.on('play', () => { this.isPlaying = true; });
            p.on('pause', () => { this.isPlaying = false; });
            p.on('volumechange', () => this.refreshMuteState());
            p.on('timeupdate', ({ seconds, duration }) => this.updateCountdown(seconds, duration));
            p.on('ended', () => this.handleVideoEnded());
        },

        async syncInitialState() {
            const p = this.rawPlayer();
            if (! p) return;
            try {
                await p.ready();
                // Unseren gemerkten Mute-State auf den neuen Player übertragen,
                // statt ihn vom Player zu übernehmen (= neue Videos erben die User-Präferenz).
                await p.setMuted(this.isMuted);
                this.isPlaying = ! (await p.getPaused());
            } catch (e) { /* ignorieren */ }
        },

        // ————— Play/Pause-Controls —————

        async play() {
            try { await this.rawPlayer()?.play(); } catch (e) { /* ignorieren */ }
        },

        async pause() {
            try { await this.rawPlayer()?.pause(); } catch (e) { /* ignorieren */ }
        },

        togglePlay() {
            return this.isPlaying ? this.pause() : this.play();
        },

        // ————— Mute/Unmute-Controls —————

        async mute() {
            try {
                await this.rawPlayer()?.setMuted(true);
                this.isMuted = true;
            } catch (e) { /* ignorieren */ }
        },

        async unmute() {
            try {
                await this.rawPlayer()?.setMuted(false);
                this.isMuted = false;
            } catch (e) { /* ignorieren */ }
        },

        toggleMute() {
            return this.isMuted ? this.unmute() : this.mute();
        },

        async refreshMuteState() {
            try { this.isMuted = await this.rawPlayer()?.getMuted(); } catch (e) { /* ignorieren */ }
        },

        // ————— Countdown · letzte 5 Sekunden —————

        updateCountdown(seconds, duration) {
            const remaining = duration - seconds;
            if (remaining > 0 && remaining <= 5) {
                this.countdown = Math.ceil(remaining);
            } else if (this.countdown !== null) {
                this.countdown = null;
            }
        },

        handleVideoEnded() {
            this.nextVideo();
        },

        // ————— Fullscreen → globale Lightbox —————

        async openFullscreen() {
            try { await this.rawPlayer()?.pause(); } catch (e) { /* ignorieren */ }
            Alpine.store('videoLightbox').open(this.$wire.activeId, this.$wire.activeTitle);
        },

        // ————— Video-Wechsel —————

        // Wechselt zum nächsten Video in der Rotation — entweder explizit per ID
        // (aus den Thumbnail-Clicks) oder automatisch bei Video-Ende.
        async nextVideo(id = null) {
            this.countdown = null;
            if (id) {
                await this.$wire.selectVideo(id);
            } else {
                await this.$wire.advanceToNextVideo();
            }
        },

        // ————— Viewport-Visibility —————

        startVisibilityTracking() {
            this.visibilityObserver = new IntersectionObserver(
                (entries) => this.handleVisibilityChange(entries[0].isIntersecting),
                { threshold: 0.15 },
            );
            this.$nextTick(() => {
                if (this.$refs.player) this.visibilityObserver.observe(this.$refs.player);
            });
        },

        handleVisibilityChange(visible) {
            this.isVisible = visible;
            visible ? this.play() : this.pause();
        },
    }));
</script>
@endscript

<div
    class="flex flex-col gap-s2 md:col-span-4 lg:col-span-6"
    wire:init="loadLatestVimeos"
    x-data="officetalkHeroVideo"
>
    {{-- Hauptplayer 16:9 --}}
    <div x-ref="player" class="relative aspect-video overflow-hidden rounded bg-surface-strong">
        @if ($this->embedUrl())
            <iframe
                wire:key="hero-video-{{ $activeId }}-{{ $playback ? 'fg' : 'bg' }}"
                src="{{ $this->embedUrl() }}"
                title="{{ $activeTitle ?? 'OfficeTalk Video' }}"
                class="absolute inset-0 h-full w-full transition-opacity duration-500 ease-editorial"
                x-bind:class="ready ? 'opacity-100' : 'opacity-0'"
                x-bind:style="playback ? '' : 'pointer-events: none;'"
                frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture"
                @load="attachPlayer($el)"
            ></iframe>
        @endif

        {{-- Custom Controls · immer sichtbar, sobald Vimeo-iframe bereit ist --}}
        @if ($this->embedUrl())
            <div
                class="pointer-events-auto absolute bottom-s3 left-s3 right-s3 flex items-center justify-between transition-opacity duration-300 ease-editorial"
                x-bind:class="ready ? 'opacity-100' : 'opacity-0'"
            >
                <div class="flex items-center gap-s1 rounded-full bg-ink/85 p-1 text-bg backdrop-blur-sm">
                    <button
                        type="button"
                        @click="togglePlay()"
                        class="flex h-10 w-10 items-center justify-center rounded-full transition-colors duration-180 hover:bg-accent hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                        :aria-label="isPlaying ? 'Pause' : 'Wiedergabe'"
                    >
                        {{-- Pause-Icon wenn gerade spielt --}}
                        <svg x-show="isPlaying" width="14" height="16" viewBox="0 0 14 16" fill="currentColor" aria-hidden="true">
                            <rect x="1" y="1" width="4" height="14" />
                            <rect x="9" y="1" width="4" height="14" />
                        </svg>
                        {{-- Play-Icon wenn pausiert --}}
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
                        {{-- Volume-Icon mit Schallwellen, wenn Ton an --}}
                        <svg x-show="!isMuted" width="18" height="16" viewBox="0 0 18 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M 1 6 L 1 10 L 4 10 L 8 13 L 8 3 L 4 6 Z" fill="currentColor" />
                            <path d="M 11 5.5 C 12.5 6.5 12.5 9.5 11 10.5" />
                            <path d="M 13.5 3.5 C 16 5 16 11 13.5 12.5" />
                        </svg>
                        {{-- Muted-Icon --}}
                        <svg x-show="isMuted" x-cloak width="18" height="16" viewBox="0 0 18 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M 1 6 L 1 10 L 4 10 L 8 13 L 8 3 L 4 6 Z" fill="currentColor" />
                            <line x1="12" y1="5" x2="17" y2="11" />
                            <line x1="17" y1="5" x2="12" y2="11" />
                        </svg>
                    </button>
                </div>

                {{-- Fullscreen → öffnet globalen Lightbox im 720p-Player-Modus --}}
                <button
                    type="button"
                    @click="openFullscreen()"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-ink/85 text-bg backdrop-blur-sm transition-colors duration-180 hover:bg-accent hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                    aria-label="Im Fokus-Modus ansehen"
                >
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M 2 6 L 2 2 L 6 2" />
                        <path d="M 14 6 L 14 2 L 10 2" />
                        <path d="M 2 10 L 2 14 L 6 14" />
                        <path d="M 14 10 L 14 14 L 10 14" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Countdown-Overlay · nur die Zahl, visuelles Gegengewicht zu den Controls links --}}
        @if ($this->nextVideo)
            <div
                x-show="countdown"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="pointer-events-none absolute top-s3 right-s3 flex items-center gap-s1 rounded-full bg-ink/85 p-1 text-bg backdrop-blur-sm"
                aria-label="Nächste Folge in"
            >
                <span
                    class="flex h-10 w-10 items-center justify-center rounded-full font-display text-h4 font-medium tabular-nums text-accent"
                    x-text="countdown"
                ></span>
            </div>
        @endif

        <div
            class="absolute inset-0 transition-opacity duration-500 ease-editorial"
            x-bind:class="ready ? 'opacity-0 pointer-events-none' : 'opacity-100'"
        >
            @if ($featured)
                <a
                    href="{{ route('officetalk.episodes.show', $featured) }}"
                    class="group relative block h-full w-full"
                    aria-label="Aktuelle Folge ansehen: {{ $featured->title }}"
                >
                    <img
                        src="{{ $featured->still_landscape_url }}"
                        alt="Walter Senk im Gespräch mit {{ $featured->guest->full_name }}, {{ $featured->guest->company }}"
                        fetchpriority="high"
                        class="h-full w-full object-cover transition-transform duration-220 ease-editorial group-hover:scale-[1.02]"
                    />
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full border border-white/80 bg-ink/30 backdrop-blur-sm transition-transform duration-220 group-hover:scale-110">
                            <svg width="22" height="26" viewBox="0 0 18 22" fill="white" aria-hidden="true">
                                <path d="M 0 0 L 18 11 L 0 22 Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-s3 right-s3 text-accent">
                        <x-officetalk::logo-mark :size="48" color="currentColor" />
                    </div>
                </a>
            @else
                <div class="flex h-full w-full items-center justify-center text-bg">
                    <div class="text-accent">
                        <x-officetalk::logo-mark :size="96" color="currentColor" />
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- 3er-Grid mit Thumbnails — ein Klick swapped das Video in den Player oben --}}
    @if (count($this->gridVideos) > 0)
        <div class="grid grid-cols-3 gap-s2 md:grid-cols-1 lg:grid-cols-3" aria-label="Weitere Folgen">
            @foreach (array_slice($this->gridVideos, 0, 3) as $index => $video)
                <button
                    type="button"
                    @click="nextVideo('{{ $video['id'] }}')"
                    wire:key="thumb-{{ $video['id'] }}"
                    @class([
                        'group relative aspect-video overflow-hidden rounded bg-surface-strong text-left focus-visible:outline focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-ink',
                        'md:hidden lg:block' => $index === 2,
                    ])
                    aria-label="Folge abspielen: {{ $video['title'] ?? 'OfficeTalk' }}"
                >
                    @if ($video['thumbnail'])
                        <img
                            src="{{ $video['thumbnail'] }}"
                            alt="{{ $video['title'] ?? '' }}"
                            loading="lazy"
                            class="absolute inset-0 h-full w-full object-cover transition-transform duration-220 ease-editorial group-hover:scale-[1.03]"
                        />
                    @endif

                    <div class="absolute inset-0 flex items-center justify-center bg-ink/0 transition-colors duration-220 group-hover:bg-ink/40">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full border border-white/80 bg-ink/30 opacity-0 backdrop-blur-sm transition-opacity duration-220 group-hover:opacity-100">
                            <svg width="12" height="14" viewBox="0 0 18 22" fill="white" aria-hidden="true">
                                <path d="M 0 0 L 18 11 L 0 22 Z" />
                            </svg>
                        </div>
                    </div>
                </button>
            @endforeach
        </div>
    @endif
</div>
