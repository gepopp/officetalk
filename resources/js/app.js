import Player from '@vimeo/player';

// Expose globally so Alpine-Components in Blade-Templates den Player-Konstruktor erreichen.
window.VimeoPlayer = Player;

// Shared Vimeo-Control-Logik als Mixin · wird von beiden Alpine-Komponenten (Clip + Lightbox) geteilt.
// Vermeidet Duplikat-Code für attach/toggle/mute/raw.
const vimeoControlMixin = () => ({
    ready: false,
    isPlaying: false,
    isMuted: true,
    player: null,

    // Alpine wrappt Properties in Reactive-Proxies — Vimeo-SDK bricht darauf. Alpine.raw() unwraps.
    rawPlayer() {
        return this.player ? window.Alpine.raw(this.player) : null;
    },

    async attachPlayer(iframe) {
        if (! window.VimeoPlayer || ! iframe) return;
        this.player = new window.VimeoPlayer(iframe);
        const p = this.rawPlayer();
        p.on('play', () => { this.isPlaying = true; });
        p.on('pause', () => { this.isPlaying = false; });
        p.on('volumechange', () => this.refreshMute());
        try {
            await p.ready();
            this.isPlaying = ! (await p.getPaused());
            this.isMuted = await p.getMuted();
        } catch (e) { /* ignorieren */ }
        setTimeout(() => { this.ready = true; }, 250);
    },

    async destroyPlayer() {
        const p = this.rawPlayer();
        if (! p) return;
        try { await p.destroy(); } catch (e) { /* ignorieren */ }
        this.player = null;
        this.ready = false;
    },

    async togglePlay() {
        const p = this.rawPlayer();
        if (! p) return;
        try {
            if (this.isPlaying) { await p.pause(); } else { await p.play(); }
        } catch (e) { /* ignorieren */ }
    },

    async toggleMute() {
        const p = this.rawPlayer();
        if (! p) return;
        try {
            const next = ! this.isMuted;
            await p.setMuted(next);
            this.isMuted = next;
        } catch (e) { /* ignorieren */ }
    },

    async refreshMute() {
        try { this.isMuted = await this.rawPlayer()?.getMuted(); } catch (e) { /* ignorieren */ }
    },
});

// Alpine-Store · Preis-Kalkulations-Modal.
// Öffnet eines von sechs Kalkulations-Modals per ID (1-6).
document.addEventListener('alpine:init', () => {
    window.Alpine.store('priceCalculation', {
        openId: null,

        open(id) {
            this.openId = Number(id);
            document.documentElement.style.overflow = 'hidden';
        },

        close() {
            this.openId = null;
            document.documentElement.style.overflow = '';
        },
    });
});

// Alpine-Store · globaler Video-Lightbox-Controller.
// Jede Video-Karte kann den Lightbox über Alpine.store('videoLightbox').open(vimeoId) öffnen.
document.addEventListener('alpine:init', () => {
    window.Alpine.store('videoLightbox', {
        vimeoId: null,
        title: null,
        isOpen: false,

        open(vimeoId, title = null) {
            this.vimeoId = String(vimeoId);
            this.title = title;
            this.isOpen = true;
            document.documentElement.style.overflow = 'hidden';
        },

        close() {
            this.isOpen = false;
            this.vimeoId = null;
            this.title = null;
            document.documentElement.style.overflow = '';
        },
    });

    // Alpine-Component · Click-to-Play Video-Clip mit Custom-Controls + Fullscreen → Lightbox.
    // Kommt von <x-officetalk::video-player> zum Einsatz.
    window.Alpine.data('officetalkVideoClip', (opts = {}) => ({
        ...vimeoControlMixin(),
        vimeoId: opts.vimeoId,
        title: opts.title || null,
        playing: false,

        start() {
            this.playing = true;
        },

        async openFullscreen() {
            // Inline-Player pausieren, damit kein Doppel-Audio beim Fade-In der Lightbox entsteht.
            try { await this.rawPlayer()?.pause(); } catch (e) { /* ignorieren */ }
            window.Alpine.store('videoLightbox').open(this.vimeoId, this.title);
        },
    }));

    // Alpine-Component · Lightbox-interner Player. Reagiert auf Store-Wechsel, hängt Vimeo-SDK neu an
    // wenn die Lightbox geöffnet wird, zerstört den Player beim Schließen.
    window.Alpine.data('officetalkVideoLightbox', () => ({
        ...vimeoControlMixin(),

        init() {
            // Beim Schließen: Player zerstören, Mute-State zurücksetzen.
            this.$watch('$store.videoLightbox.isOpen', (open) => {
                if (! open) {
                    this.destroyPlayer();
                    this.isMuted = true;
                }
            });
        },
    }));
});
