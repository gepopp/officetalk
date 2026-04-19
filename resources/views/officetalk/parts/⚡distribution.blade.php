<?php

use Livewire\Component;

new class extends Component {
    /**
     * @var array<int, array{number:string,name:string,subname:?string,url:?string,meta:string,body:string}>
     */
    public array $channels = [
        [
            'number' => '01',
            'name' => 'LinkedIn',
            'subname' => 'Kanal Gerhard Popp',
            'url' => 'https://www.linkedin.com/in/gerhardpopp/',
            'video' => 'Gerhard-Office-Talk.webm',
            'meta' => '≈ 13.000 Fachfollower · Immobilien · Bau · Recht · PropTech',
            'body' => 'Ein gewachsenes Netzwerk von rund 13.000 Followern aus Immobilien, Bau, Recht, Architektur und PropTech. Kein gekaufter, kein breit gestreuter Account – sondern über Jahre aufgebaute fachliche Sichtbarkeit in der DACH-Entscheiderebene. OfficeTalk-Produktionen werden über diesen Kanal als Erstveröffentlichung oder als Sekundärverbreitung ausgespielt. Für Kundenprojekte heißt das: Ihr Video landet nicht in einem anonymen Feed, sondern auf dem Schreibtisch der Menschen, die Sie erreichen wollen.',
            'email' => 'gerhard@welofeinteraction.co',
            'email_label' => 'An Gerhard schreiben',
        ],
        [
            'number' => '02',
            'name' => 'immobilien-redaktion.com',
            'subname' => 'Die unabhängige Immobilien Redaktion',
            'url' => 'https://immobilien-redaktion.com',
            'video' => 'Office-Talk-Walter.webm',
            'meta' => 'Chefredaktion: Walter Senk · Seit zwei Jahrzehnten',
            'body' => 'Die unabhängige Immobilien Redaktion von Walter Senk ist seit zwei Jahrzehnten eine der meistgelesenen B2B-Quellen für den österreichischen Immobilienmarkt. OfficeTalk-Produktionen können als Videobeitrag in thematisch passende Artikel eingebettet werden – Voraussetzung ist der journalistische Kontext. Vorstandsinterviews zu Quartalsberichten, Experten-Stimmen zu Regulierungsthemen, Projektpräsentationen mit Nachrichtenwert. Die redaktionelle Entscheidung liegt bei Senk, das Format folgt journalistischen Maßstäben.',
            'email' => 'w.senk@immobilien-redaktion.at',
            'email_label' => 'An Walter schreiben',
        ],
        [
            'number' => '03',
            'name' => 'report.at',
            'subname' => 'Bau & Immobilien Report',
            'url' => 'https://report.at',
            'video' => 'Bernd-Office-Talk.webm',
            'meta' => 'Chefredaktion: Bernd Affenzeller · Report Verlag',
            'body' => 'Der Bau & Immobilien Report im Report Verlag, unter der Chefredaktion von Bernd Affenzeller, gilt als Pflichtlektüre in Bauträger-, Planungs- und Zulieferer-Ebenen. Reichweite schlägt hier keine Marketing-Plattform – hier wird entschieden, welche Projekte in der Branche wahrgenommen werden. OfficeTalk-Produktionen finden Platz in den digitalen Kanälen des Report, sofern Thema und Zuschnitt tragen. Auch hier: redaktionelle Unabhängigkeit bleibt gewahrt.',
            'email' => 'affenzeller@report.at',
            'email_label' => 'An Bernd schreiben',
        ],
    ];
};
?>

@script
<script>
    Alpine.data('officetalkDistributionParallax', () => ({
        target: 0,
        progress: 0,
        inView: false,
        rafId: null,
        observer: null,
        reduceMotion: false,

        // Liest die aktuelle Scroll-Position und berechnet den Ziel-Progress.
        // Bewusst innerhalb rAF aufgerufen — vermeidet Layout-Thrashing.
        measure() {
            const band = this.$refs.parallaxBand;
            if (! band) return;
            const rect = band.getBoundingClientRect();
            const vh = window.innerHeight;
            this.target = Math.max(0, Math.min(1, (vh - rect.top) / (vh + rect.height)));
        },

        // rAF-Schleife · dämpft progress an target an (Nachzieh-Effekt).
        // Läuft nur solange die Section im Viewport ist; stoppt automatisch.
        loop() {
            this.measure();

            if (this.reduceMotion) {
                this.progress = this.target;
            } else {
                const delta = this.target - this.progress;
                if (Math.abs(delta) < 0.0005) {
                    this.progress = this.target;
                } else {
                    // Dämpfungsfaktor 0.08
                    this.progress += delta * 0.08;
                }
            }

            // Loop nur weiterfahren, solange Section sichtbar ist.
            if (this.inView) {
                this.rafId = requestAnimationFrame(() => this.loop());
            } else {
                this.rafId = null;
            }
        },

        init() {
            this.reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            this.measure();
            this.progress = this.target;

            // IntersectionObserver aktiviert den Parallax nur, wenn die
            // Section (oder ihr näheres Umfeld via rootMargin) im Viewport ist.
            this.observer = new IntersectionObserver(
                (entries) => {
                    this.inView = entries[0].isIntersecting;
                    if (this.inView && this.rafId === null) {
                        this.rafId = requestAnimationFrame(() => this.loop());
                    }
                },
                { rootMargin: '200px 0px' },
            );
            this.observer.observe(this.$el);
        },

        destroy() {
            if (this.rafId) cancelAnimationFrame(this.rafId);
            if (this.observer) this.observer.disconnect();
        },
    }));
</script>
@endscript

<section
    id="distribution"
    class="dark bg-bg pb-s7 text-ink"
    x-data="officetalkDistributionParallax"
>
    {{-- Parallax-Band · Hintergrund-Bild + Text-Overlay, zwei unabhängige Layer --}}
    <div
        x-ref="parallaxBand"
        class="relative -mb-1 aspect-square w-full overflow-hidden sm:aspect-video md:aspect-[2/1]"
    >
        {{-- Layer 1 · Hintergrund-Bild, bewegt sich langsam (0.3x Scroll-Speed) --}}
        <img
            src="{{ asset('distribution-parallax-image.jpg') }}"
            alt="OfficeTalk-Distribution in der Wiener Fachmedien-Landschaft"
            class="absolute inset-0 h-[180%] w-full object-cover object-right motion-safe:will-change-transform lg:h-[130%] lg:object-center"
            :style="`transform: translate3d(0, ${-progress * 170}px, 0)`"
            loading="lazy"
        />

        {{-- Lesbarkeits-Overlay · dunkler Gradient für Kontrast zum Text --}}
        {{-- Verdunkelungs-Gradient über dem Bild --}}
        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-bg/10 via-bg/50 to-bg -mb-1"></div>
        {{-- Solid-Bg am Band-Ende · überdeckt jede Gradient-Render-Kante deterministisch --}}
        <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-24 bg-bg -mb-1"></div>

    </div>

    {{-- Content-Block · Translation wird durch negatives margin-bottom layout-technisch ausgeglichen --}}
    <div
        class="container pt-s5 md:pt-s6 motion-safe:will-change-transform"
        :style="`transform: translate3d(0, ${-progress * 290}px, 0); margin-bottom: ${-progress * 290}px;`"
    >
        {{-- Masthead · Eyebrow + H2 links, Intro rechts, beide auf gleicher Grid-Höhe --}}
        <header class="grid gap-s5 md:grid-cols-12 md:gap-s6">
            <div class="md:col-span-5">
                <p class="font-sans text-eyebrow uppercase text-accent">
                    Distribution — was nach der Produktion folgt
                </p>
                <h2 class="mt-s3 font-display text-h2 font-medium leading-tight text-balance text-ink">
                    Reichweite, die zur Zielgruppe passt.
                </h2>
            </div>

            <div class="md:col-span-7 md:pt-s4">
                <p class="font-sans text-lead text-ink">
                    Reichweite in der Zielgruppe, die kein anderer Wiener Videoproduzent in dieser Kombination anbietet: Vlogs auf der unabhängigen Immobilien Redaktion, Beiträge im Bau &amp; Immobilien Report und ein LinkedIn-Account mit rund 13.000 Fachfollowern aus Immobilien, Bau, Recht und PropTech. Über diese drei Kanäle erreiche ich die DACH-Entscheiderebene, die für Ihr Projekt relevant ist – ohne Umweg über Werbenetzwerke, ohne Streuverlust.
                </p>
                <p class="mt-s3 font-display text-h4 italic text-muted">
                    Ein struktureller Reichweiten-Vorteil, der sich in keiner Medialeistung nachbauen lässt.
                </p>
            </div>
        </header>

        {{-- 3-Spalten-Kolumnen · Subgrid erzwingt zeilenweise Alignment zwischen den Kolumnen --}}
        <div class="mt-s6 grid gap-s5 md:mt-s7 md:grid-cols-3 md:grid-rows-[auto_auto_auto_auto_1fr_auto] md:gap-s4 lg:gap-s5">
            @foreach ($channels as $channel)
                <article
                    wire:key="channel-{{ $channel['number'] }}"
                    class="group md:grid md:grid-rows-subgrid md:row-span-6 md:gap-y-0"
                >
                    {{-- Ambient-Loop · Portrait des Channel-Kurators --}}
                    @if (! empty($channel['video']))
                        <div class="mb-s3 overflow-hidden rounded bg-surface-strong">
                            <video
                                src="{{ asset($channel['video']) }}"
                                class="aspect-square w-full object-cover"
                                autoplay
                                muted
                                loop
                                playsinline
                                preload="metadata"
                                aria-hidden="true"
                            ></video>
                        </div>
                    @endif

                    {{-- Accent-Rule links + Nummer rechts daneben, auf einer Linie --}}
                    <div class="flex items-center gap-s3">
                        <span
                            aria-hidden="true"
                            class="h-[2px] w-12 bg-accent transition-all duration-300 ease-editorial group-hover:w-24"
                        ></span>
                        <p class="font-display text-[28px] font-medium leading-none text-muted">
                            {{ $channel['number'] }}
                        </p>
                    </div>

                    {{-- Title-Block · H3 + Subname bleiben zusammen, nehmen eine Subgrid-Zeile ein --}}
                    <div class="mt-s3">
                        <h3 class="font-display text-h3 font-medium leading-tight text-ink">
                            @if (! empty($channel['url']))
                                <a
                                    href="{{ $channel['url'] }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="officetalk-link"
                                >
                                    {{ $channel['name'] }}
                                </a>
                            @else
                                {{ $channel['name'] }}
                            @endif
                        </h3>

                        @if (! empty($channel['subname']))
                            <p class="mt-s1 font-display text-h4 italic text-muted line-clamp-3">
                                {{ $channel['subname'] }}
                            </p>
                        @endif
                    </div>

                    <p class="mt-s3 mb-3 font-sans text-eyebrow uppercase tracking-[0.08em] text-accent">
                        {{ $channel['meta'] }}
                    </p>

                    <p class="font-sans text-body text-ink">
                        {{ $channel['body'] }}
                    </p>

                    @if (! empty($channel['email']))
                        <div class="mt-s4">
                            <x-officetalk::button
                                variant="secondary"
                                icon="arrow"
                                iconPosition="right"
                                :href="'mailto:'.$channel['email']"
                                class="w-full justify-center !text-sm"
                            >
                                {{ $channel['email_label'] ?? $channel['email'] }}
                            </x-officetalk::button>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>

        {{-- Closing · zentriert, schmaler Lesefluss --}}
        <div class="mx-auto mt-s6 max-w-[720px] md:mt-s7">
            <p class="font-sans text-lead text-ink">
                Die drei Kanäle ersetzen keine eigene Kommunikationsarbeit – sie ergänzen sie. Ein Teil der OfficeTalk-Kundschaft nutzt die Distribution vollständig und verzichtet auf eigene Paid-Kampagnen. Ein anderer Teil kombiniert die fachmedialen Veröffentlichungen mit der eigenen Unternehmensseite und bezahlter LinkedIn-Promotion. Welcher Weg der richtige ist, klärt sich im Konzeptgespräch – abhängig von Ziel, Zielgruppe und Budget.
            </p>
        </div>

    </div>
</section>
