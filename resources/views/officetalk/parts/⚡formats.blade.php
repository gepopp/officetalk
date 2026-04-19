<?php

use Livewire\Component;

new class extends Component {
    /**
     * Drei Schwerpunktformate mit Demo-Video (Click-to-Play).
     *
     * @var array<int, array{title:string,vimeoId:string,body:string,link:?array{label:string,href:string}}>
     */
    public array $focusFormats = [
        [
            'title' => 'Fachinterviews für Immobilien, Bau und PropTech',
            'spec' => '10–25 Minuten · 16:9',
            'vimeoId' => '1168859612',
            'posterAlt' => 'Ausschnitt aus einem OfficeTalk-Fachinterview — redaktionell geführt, Senk-Duktus',
            'body' => 'Das Kernformat der OfficeTalk-Videoproduktion. Ein bis zwei Gäste, ein vorbereiteter Fragenkatalog, in der Regel ein Drehtag an einem gescouteten Ort in Wien oder im DACH-Raum. Der Zuschnitt eignet sich für die Einbettung in Fachartikel auf immobilien-redaktion.com oder report.at, für die eigene Mediathek und als Grundlage für LinkedIn-Kurzfassungen. Aus einem Langinterview entstehen erfahrungsgemäß drei bis fünf weiterverwendbare Kurz-Zuschnitte.',
            'link' => null,
        ],
        [
            'title' => 'Eventfilm und After-Movie für Messen, Awards und Tagungen',
            'spec' => '3–5 Minuten · Multi-Cam',
            'vimeoId' => '1170945550',
            'posterAlt' => 'Ausschnitt aus einem OfficeTalk-After-Movie einer Wiener Branchenveranstaltung',
            'body' => 'Für Branchenveranstaltungen, Messen, Awards, Produkt-Launches und Tagungen im Wiener Veranstaltungskalender. Die Dokumentation erfasst nicht nur die Atmosphäre, sondern auch die inhaltlichen Kernaussagen – Keynote-Ausschnitte, Gespräche auf der Fläche, O-Töne von Teilnehmenden. Die Lieferung erfolgt als drei- bis fünf-minütiger Hauptfilm plus mehrere Kurzfassungen für Social Media. Schnelle Verfügbarkeit ist Teil des Formats: Rohschnitt innerhalb von fünf Arbeitstagen.',
            'link' => ['label' => 'Zur LinkedIn-Distribution', 'href' => '#distribution'],
        ],
        [
            'title' => 'Projektvideo und Produktfilm für Bauträger und PropTech',
            'spec' => '3–8 Minuten · 16:9',
            'vimeoId' => '1034378638',
            'posterAlt' => 'Ausschnitt aus einer OfficeTalk-Projektpräsentation mit Drohne und Vor-Ort-Dreh',
            'body' => 'Für Bauträger, Projektentwickler und PropTech-Anbieter, die ein konkretes Bauvorhaben, ein digitales Produkt oder eine Dienstleistung dokumentarisch erklären wollen. Kombination aus Vor-Ort-Dreh, Sprecher-Setups und, wo sinnvoll, Planmaterial und Drohnenaufnahmen. Länge je nach Anlass zwischen 3 und 8 Minuten für die Vollversion, plus Social-Zuschnitte für LinkedIn und die eigene Website. Keine Werbesprache, sondern Einordnung.',
            'link' => ['label' => 'Preiskalkulation für Projektvideos', 'href' => '#preise'],
        ],
    ];

    /**
     * Weitere Formate auf Anfrage — nutzen-zentrierte Fließtext-Liste.
     *
     * @var array<int, array{name:string,body:string}>
     */
    public array $secondaryFormats = [
        [
            'name' => 'Teleprompter-Clips',
            'body' => 'Wenn eine gerade Botschaft Richtung Kamera gefragt ist und der Kalender der Sprecherin keinen zweiten Drehtag zulässt – ein Vormittag im Studio oder bei Ihnen im Haus reicht für drei bis sechs fertige CEO-Clips.',
        ],
        [
            'name' => 'Reels und Shorts für LinkedIn',
            'body' => 'Für LinkedIn, Instagram und TikTok optimierte Vertikalformate im 9:16-Zuschnitt. Entweder aus bestehendem Material veredelt oder eigenständig gedreht, immer mit fest einbelichteten Untertiteln.',
        ],
        [
            'name' => 'LinkedIn-Video-Kampagnen',
            'body' => 'Eine Serie abgestimmter Clips mit wiederkehrendem visuellen Code, verteilt über mehrere Wochen. Für Unternehmen, die nicht einzelne Posts, sondern eine Kommunikationslinie im LinkedIn-Algorithmus aufbauen.',
        ],
        [
            'name' => 'Livestream-Produktion',
            'body' => 'Für Pressegespräche, hybride Events und Panel-Diskussionen in Wien und umliegend. Regie, Kamera, Bildmischung und Streaming in einer Hand, inklusive Backup-Routing gegen Ausfälle.',
        ],
        [
            'name' => 'Image- und Recruiting-Filme',
            'body' => 'Klassisches Unternehmensporträt und Employer-Branding-Video für Karriere-Seiten und Messeauftritte. Der dokumentarische Zugang bleibt, die Tonalität ist auf Arbeitgeber-Zielgruppen zugeschnitten.',
        ],
        [
            'name' => 'Testimonials und Kundenstimmen',
            'body' => 'Kurze Statement-Videos mit strukturiertem Fragenkatalog. Eine halbe Drehstunde pro Sprecher, Lieferung als 60-Sekunden-Clip für Vertrieb und Website.',
        ],
        [
            'name' => 'Messevideo und Trade-Show-Content',
            'body' => 'Vor-Ort-Produktion während Messetagen mit täglicher Auslieferung für Social Media – relevant für Aussteller auf Expo Real, MIPIM, BAU München und regionalen Immobilienmessen.',
        ],
        [
            'name' => 'Roundtable- und Paneldiskussion',
            'body' => 'Mehr-Kamera-Setup für Fachgespräche mit drei bis sechs Teilnehmenden. Für Verbände, Branchenpublikationen und Konferenzveranstalter.',
        ],
    ];
};
?>

@once('officetalk-reveal')
<style>
    [data-officetalk-reveal] {
        opacity: 0;
        transform: translateY(32px);
        transition:
            opacity 900ms cubic-bezier(0.22, 1, 0.36, 1),
            transform 900ms cubic-bezier(0.22, 1, 0.36, 1);
    }
    [data-officetalk-reveal].is-revealed {
        opacity: 1;
        transform: translateY(0);
    }
    @media (prefers-reduced-motion: reduce) {
        [data-officetalk-reveal] {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }
</style>
@endonce

@once('officetalk-formats-layout')
<style>
    /* Große Fraunces-Italic-Ziffern in Ink · solid schwarzes Plakatelement, liegt hinter dem Content. */
    .officetalk-formate [data-officetalk-numeral] {
        font-family: 'Fraunces Variable', 'Fraunces', ui-serif, Georgia, serif;
        font-style: italic;
        font-weight: 500;
        line-height: 0.82;
        letter-spacing: -0.04em;
        color: var(--color-ink);
        user-select: none;
    }

    /* Headline "klippt" die Ziffer · dicker Stroke in Surface-Farbe außerhalb jeder Glyphe
       stanzt die Ziffer dahinter weg. paint-order zeichnet Stroke zuerst, dann Fill —
       Letter-Fill bleibt sauber in Ink, Ring in Surface wirkt als Cut-Out-Maske.
       Browser-Support: Chrome/Safari/Firefox alle aktuellen Versionen. */
    .officetalk-formate [data-format-heading] {
        paint-order: stroke fill;
        -webkit-text-stroke: 10px var(--color-surface);
        text-stroke: 10px var(--color-surface);
    }

    /* Eyebrow und Body bekommen dünneren Stroke, damit feine Schrift ebenfalls sauber aus der Ziffer ausgespart bleibt. */
    .officetalk-formate [data-format-halo] {
        paint-order: stroke fill;
        -webkit-text-stroke: 4px var(--color-surface);
        text-stroke: 4px var(--color-surface);
    }

    /* Video-Card · editorial shadow + ring + controlled hover-lift */
    .officetalk-formate [data-officetalk-clip] {
        box-shadow:
            0 1px 0 0 rgba(17, 17, 17, 0.06),
            0 32px 64px -32px rgba(17, 17, 17, 0.35);
        transition: transform 600ms cubic-bezier(0.22, 1, 0.36, 1),
            box-shadow 600ms cubic-bezier(0.22, 1, 0.36, 1);
    }
    .officetalk-formate article.group:hover [data-officetalk-clip] {
        transform: translateY(-4px);
        box-shadow:
            0 1px 0 0 rgba(17, 17, 17, 0.08),
            0 48px 80px -28px rgba(17, 17, 17, 0.5);
    }

    /* Filmstreifen-Perforation rechts/links an der Video-Karte, sub-subtil */
    .officetalk-formate [data-officetalk-clip]::before,
    .officetalk-formate [data-officetalk-clip]::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 6px;
        background-image: radial-gradient(circle, rgba(17, 17, 17, 0.35) 1.5px, transparent 2px);
        background-size: 6px 12px;
        background-repeat: repeat-y;
        opacity: 0.35;
        pointer-events: none;
    }
    .officetalk-formate [data-officetalk-clip]::before { left: 2px; }
    .officetalk-formate [data-officetalk-clip]::after { right: 2px; }

    /* Chequered brick-pattern — gerade Spalten-Items sinken ab, erzeugt Mauerwerk-Rhythmus.
       Margin statt Transform, damit die Reveal-Animation ungestört durchläuft. */
    @media (min-width: 768px) {
        .officetalk-formate [data-officetalk-brick]:nth-child(even) {
            margin-top: 56px;
        }
    }
    @media (prefers-reduced-motion: reduce) {
        .officetalk-formate [data-officetalk-clip] {
            transition: none !important;
        }
    }
</style>
@endonce

<section id="formats" class="officetalk-formate relative overflow-hidden bg-surface py-s7">

    {{-- Dezenter Grid-Raster im Hintergrund für die Magazin-Atmosphäre --}}
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 opacity-[0.04]"
        style="background-image: linear-gradient(to right, #111 1px, transparent 1px), linear-gradient(to bottom, #111 1px, transparent 1px); background-size: 96px 96px;"
    ></div>

    <div class="relative container">

        {{-- Masthead · asymmetrisch-editorial: Eyebrow + H2 links breit, Intro rechts oben --}}
        <header class="grid gap-s5 md:grid-cols-12 md:gap-s6">
            <div class="md:col-span-8">
                <p class="font-sans text-eyebrow uppercase text-muted">
                    Formate — drei Schwerpunkte, ergänzende Zuschnitte auf Anfrage
                </p>
                <h2 class="mt-s3 font-display text-h3 font-medium leading-tight text-balance text-ink hyphens-auto md:text-h2" lang="de">
                    B2B-Videoformate für Immobilien, Bau und PropTech.
                </h2>
            </div>

            <div class="md:col-span-4 md:pt-s5">
                <p class="font-sans text-lead text-ink">
                    Nicht jedes Video funktioniert an jedem Ort. Ein Fachinterview ist anders gebaut als ein Eventfilm, eine Projektpräsentation folgt anderen Regeln als ein LinkedIn-Clip.
                </p>
            </div>
        </header>

        <p class="mt-s5 max-w-measure font-display text-h4 italic text-muted">
            OfficeTalk produziert in Wien drei Videoformate als Schwerpunkt – dort liegt die größte Routine und die schärfste redaktionelle Vorarbeit. Ergänzende Formate werden projektbezogen produziert und unterliegen demselben handwerklichen Standard.
        </p>

        {{-- Schwerpunktformate · Zigzag-Spread 7/5 abwechselnd, dominante Clips ab md --}}
        <div class="mt-s7 space-y-s7 md:mt-[128px] md:space-y-[128px]">
            @foreach ($focusFormats as $index => $format)
                @php
                    $isOdd = $index % 2 === 1;
                    $number = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
                @endphp
                <article
                    data-officetalk-reveal
                    wire:key="focus-{{ $index }}"
                    x-intersect.once.margin.-15%="$el.classList.add('is-revealed')"
                    style="transition-delay: {{ $index * 80 }}ms"
                    class="group relative grid items-center gap-s5 md:grid-cols-12 md:gap-s6"
                >
                    {{-- Video-Plate · 7/12 Spalten, dominant --}}
                    <div class="relative md:col-span-7 {{ $isOdd ? 'md:order-2' : '' }}">
                        {{-- Eyebrow-Ribbon über der Video-Plate, versetzt zur Kante --}}
                        <span
                            aria-hidden="true"
                            class="absolute z-20 inline-flex items-center gap-s1 bg-accent px-s2 py-s1 font-sans text-meta font-semibold tracking-[0.12em] text-ink {{ $isOdd ? 'right-s3' : 'left-s3' }} -top-s2"
                            style="transform: rotate({{ $isOdd ? '1.5' : '-1.5' }}deg);"
                        >
                            <span class="font-display italic">{{ $number }}</span>
                            <span class="h-[10px] w-px bg-ink/40"></span>
                            <span class="uppercase">{{ $format['spec'] }}</span>
                        </span>

                        {{-- Video-Player · wiederverwendbare Komponente mit Custom-Controls + Fullscreen-Lightbox --}}
                        <x-officetalk::video-player
                            data-officetalk-clip
                            :vimeo-id="$format['vimeoId']"
                            :title="$format['title']"
                            :poster-alt="$format['posterAlt']"
                            :eager="$index === 0"
                        />
                    </div>

                    {{-- Content-Column · 5/12 · Nummer als eigenständiger Marker über dem Eyebrow,
                         statt als Hintergrund-Dekor das in den Headline-Text einbricht. --}}
                    <div class="relative md:col-span-5 {{ $isOdd ? 'md:order-1' : '' }}">
                        <div class="max-w-measure">
                            {{-- Marker · Giant italic Fraunces-Ziffer als Chapter-Kopf, keine Überlappung mit Text --}}
                            <div class="flex items-baseline gap-s3">
                                <span
                                    aria-hidden="true"
                                    class="font-display text-[72px] italic font-medium leading-none text-ink md:text-[88px] lg:text-[104px]"
                                >
                                    {{ $number }}
                                </span>
                                <span class="h-px flex-1 bg-ink/20"></span>
                                <span class="font-sans text-meta font-semibold uppercase tracking-[0.12em] text-muted">
                                    / {{ str_pad((string) count($focusFormats), 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                            <p class="mt-s4 font-sans text-eyebrow uppercase tracking-[0.08em] text-accent">
                                {{ $format['spec'] }}
                            </p>

                            <h3 class="mt-s2 font-display text-h3 font-medium leading-[1.1] text-balance text-ink md:text-[32px] lg:text-h2">
                                {{ $format['title'] }}
                            </h3>

                            <p class="mt-s4 font-sans text-body text-ink">
                                {{ $format['body'] }}
                            </p>

                            @if ($format['link'])
                                <p class="mt-s4 font-sans text-meta">
                                    <a href="{{ $format['link']['href'] }}" class="officetalk-link font-medium text-ink">
                                        {{ $format['link']['label'] }} →
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Divider · Akzent-Streifen mit Label-Ecke für Magazin-Look --}}
        <div class="relative mt-s7 md:mt-[128px]">
            <hr class="border-line" />
            <span aria-hidden="true" class="absolute -top-s2 left-1/2 -translate-x-1/2 bg-surface px-s3 font-display text-meta italic text-muted">
                ·
            </span>
        </div>

        {{-- Weitere Formate auf Anfrage · H3-Header + Intro + chequered Brick-Layout --}}
        <div class="mt-s7">
            <div class="grid gap-s5 md:grid-cols-12 md:gap-s6">
                <div class="md:col-span-5">
                    <h3 class="font-display text-h3 font-medium leading-tight text-balance text-ink">
                        Weitere Videoformate auf Anfrage
                    </h3>
                </div>
                <div class="md:col-span-7 md:pt-s2">
                    <p class="font-sans text-lead text-ink">
                        Neben den drei Schwerpunktformaten produziert OfficeTalk projektbezogen auch Kurzformate und erweiterte Produktionen im gesamten DACH-Raum. Die technische Ausstattung und die redaktionelle Arbeitsweise sind identisch – der Unterschied liegt im Zuschnitt auf den jeweiligen Anlass.
                    </p>
                </div>
            </div>

            {{-- Chequered 2-col Brick-Grid · gerade Items sind versetzt, jedes Item hat eine Ziffer + Akzent-Tick-Line --}}
            <div class="mt-s6 grid grid-cols-1 gap-s5 md:mt-s7 md:grid-cols-2 md:gap-x-s6 md:gap-y-s5">
                @foreach ($secondaryFormats as $index => $format)
                    @php($secNumber = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT))
                    <article
                        data-officetalk-reveal
                        data-officetalk-brick
                        wire:key="secondary-{{ $index }}"
                        x-data
                        x-intersect.once.margin.-10%="$el.classList.add('is-revealed')"
                        style="transition-delay: {{ ($index % 4) * 80 }}ms"
                        class="group relative border-t border-line pt-s4 transition-colors duration-500 ease-editorial hover:border-accent"
                    >
                        <span
                            aria-hidden="true"
                            class="absolute -top-[9px] left-0 h-[2px] w-12 bg-accent transition-all duration-500 ease-editorial group-hover:w-24"
                        ></span>
                        <span
                            aria-hidden="true"
                            class="pointer-events-none absolute -top-s2 right-0 font-display text-[56px] italic font-medium leading-none text-accent/30"
                        >
                            {{ $secNumber }}
                        </span>

                        <h4 class="font-display text-h4 font-medium not-italic text-ink">
                            {{ $format['name'] }}.
                        </h4>
                        <p class="mt-s2 font-sans text-body text-muted">
                            {{ $format['body'] }}
                        </p>
                    </article>
                @endforeach
            </div>

            {{-- Abschluss-Satz --}}
            <p class="mt-s6 max-w-[780px] font-display text-h4 italic text-muted md:mt-[128px]">
                Welches Videoformat zu Ihrem Anlass passt, klärt sich im Erstgespräch – oft ergibt die Kombination aus einem Schwerpunktformat und zwei bis drei Kurz-Zuschnitten die wirtschaftlich sinnvollste Nutzung des Drehtags.
            </p>
        </div>

    </div>
</section>
