<?php

use Livewire\Component;

new class extends Component {
    public int $hourlyRate = 95;

    /**
     * Die sechs Kalkulations-Datensätze · ID 1..6.
     *
     * @var array<int, array{
     *     id:int,
     *     format:string,
     *     variant:string,
     *     title:string,
     *     subtitle:string,
     *     items:array<int, array{name:string,hours:string,price:int}>,
     *     totalHours:string,
     *     totalPrice:int,
     *     equipmentNote:bool
     * }>
     */
    public array $calculations = [
        1 => [
            'id' => 1,
            'format' => 'interview',
            'variant' => 'vorgabe',
            'title' => 'Fachinterview – mit Konzept-Vorgabe',
            'subtitle' => 'Ein Sprecher, ein Drehort. Konzept, Zielgruppen-Briefing und Fragenkatalog kommen von Ihrer Marketing-Abteilung.',
            'items' => [
                ['name' => 'Location-Scouting und Abstimmung mit Drehort', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Drehvorbereitung, Equipment-Check', 'hours' => '1–2', 'price' => 143],
                ['name' => 'Drehtag vor Ort (Aufbau, Interview, Abbau)', 'hours' => '8–10', 'price' => 855],
                ['name' => 'Materialsicherung und Sichtung', 'hours' => '2', 'price' => 190],
                ['name' => 'Rohschnitt Hauptversion', 'hours' => '6–8', 'price' => 665],
                ['name' => 'Feinschnitt, Korrekturschleife', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Farbkorrektur und Tonmischung', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Untertitel-Erstellung', 'hours' => '1–2', 'price' => 143],
                ['name' => 'Drei Social-Zuschnitte (9:16 und 1:1)', 'hours' => '2–4', 'price' => 285],
            ],
            'totalHours' => '27–38',
            'totalPrice' => 3090,
            'equipmentNote' => false,
        ],
        2 => [
            'id' => 2,
            'format' => 'interview',
            'variant' => 'komplett',
            'title' => 'Fachinterview – mit Komplett-Service',
            'subtitle' => 'Ein Sprecher, ein Drehort. OfficeTalk übernimmt zusätzlich Themenschärfung, redaktionelle Recherche und Fragenkatalog.',
            'items' => [
                ['name' => 'Briefing-Gespräch und Themenschärfung', 'hours' => '1–2', 'price' => 143],
                ['name' => 'Redaktionelle Recherche zum Thema', 'hours' => '4–5', 'price' => 428],
                ['name' => 'Fragenkatalog-Entwicklung und Abstimmung', 'hours' => '3', 'price' => 285],
                ['name' => 'Location-Scouting und Abstimmung mit Drehort', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Drehvorbereitung, Equipment-Check', 'hours' => '1–2', 'price' => 143],
                ['name' => 'Drehtag vor Ort (Aufbau, Interview, Abbau)', 'hours' => '8–10', 'price' => 855],
                ['name' => 'Materialsicherung und Sichtung', 'hours' => '2', 'price' => 190],
                ['name' => 'Rohschnitt Hauptversion', 'hours' => '6–8', 'price' => 665],
                ['name' => 'Feinschnitt, Korrekturschleife', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Farbkorrektur und Tonmischung', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Untertitel-Erstellung', 'hours' => '1–2', 'price' => 143],
                ['name' => 'Drei Social-Zuschnitte (9:16 und 1:1)', 'hours' => '2–4', 'price' => 285],
            ],
            'totalHours' => '35–48',
            'totalPrice' => 3946,
            'equipmentNote' => false,
        ],
        3 => [
            'id' => 3,
            'format' => 'event',
            'variant' => 'vorgabe',
            'title' => 'Event-After-Movie – mit Konzept-Vorgabe',
            'subtitle' => 'Halbtägige Veranstaltung. Drehkonzept und Shotlist kommen von Ihrem Event-Team.',
            'items' => [
                ['name' => 'Drehbriefing mit Event-Team', 'hours' => '2', 'price' => 190],
                ['name' => 'Pre-Event-Check am Veranstaltungsort', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Drehtag vor Ort (6 Stunden Event, Auf-/Abbau)', 'hours' => '10–12', 'price' => 1045],
                ['name' => 'Materialsicherung und Sichtung', 'hours' => '3', 'price' => 285],
                ['name' => 'Rohschnitt Hauptfilm (3–5 Minuten)', 'hours' => '5–7', 'price' => 570],
                ['name' => 'Feinschnitt, Korrekturschleife', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Farbkorrektur und Tonmischung', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Untertitel und Bauchbinden', 'hours' => '1–2', 'price' => 143],
                ['name' => 'Drei Social-Zuschnitte (9:16 und 1:1)', 'hours' => '4–6', 'price' => 475],
            ],
            'totalHours' => '32–42',
            'totalPrice' => 3517,
            'equipmentNote' => false,
        ],
        4 => [
            'id' => 4,
            'format' => 'event',
            'variant' => 'komplett',
            'title' => 'Event-After-Movie – mit Komplett-Service',
            'subtitle' => 'Halbtägige Veranstaltung. OfficeTalk übernimmt Drehkonzept, Shotlist, Identifikation relevanter Gesprächspartner und Abstimmung mit der Veranstaltungsregie.',
            'items' => [
                ['name' => 'Konzeptionsgespräch und Eventbriefing', 'hours' => '2', 'price' => 190],
                ['name' => 'Drehkonzept und Shotlist', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Identifikation relevanter Gesprächspartner vor Ort', 'hours' => '1–2', 'price' => 143],
                ['name' => 'Abstimmung mit Veranstaltungsregie', 'hours' => '2', 'price' => 190],
                ['name' => 'Pre-Event-Check am Veranstaltungsort', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Drehtag vor Ort (6 Stunden Event, Auf-/Abbau)', 'hours' => '10–12', 'price' => 1045],
                ['name' => 'Materialsicherung und Sichtung', 'hours' => '3', 'price' => 285],
                ['name' => 'Rohschnitt Hauptfilm (3–5 Minuten)', 'hours' => '5–7', 'price' => 570],
                ['name' => 'Feinschnitt, Korrekturschleife', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Farbkorrektur und Tonmischung', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Untertitel und Bauchbinden', 'hours' => '1–2', 'price' => 143],
                ['name' => 'Drei Social-Zuschnitte (9:16 und 1:1)', 'hours' => '4–6', 'price' => 475],
            ],
            'totalHours' => '38–50',
            'totalPrice' => 4183,
            'equipmentNote' => false,
        ],
        5 => [
            'id' => 5,
            'format' => 'projekt',
            'variant' => 'vorgabe',
            'title' => 'Dokumentarische Projektpräsentation – mit Konzept-Vorgabe',
            'subtitle' => 'Zwei Drehtage, drei Sprecher. Drehbuch, Sprecherauswahl und Storyboard kommen von Ihrer Marketing-Abteilung.',
            'items' => [
                ['name' => 'Abstimmungsgespräch mit Marketing-Abteilung', 'hours' => '2', 'price' => 190],
                ['name' => 'Location-Scouting Baustelle', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Location-Scouting Büro', 'hours' => '2', 'price' => 190],
                ['name' => 'Drehvorbereitung, Equipment-Planung', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Drehtag 1 (Baustelle, Auf-/Abbau, drei Sprecher)', 'hours' => '9–11', 'price' => 950],
                ['name' => 'Drehtag 2 (Büro, Auf-/Abbau, B-Roll)', 'hours' => '8–10', 'price' => 855],
                ['name' => 'Materialsicherung und Sichtung', 'hours' => '4', 'price' => 380],
                ['name' => 'Rohschnitt Vollversion (7 Minuten)', 'hours' => '10–12', 'price' => 1045],
                ['name' => 'Feinschnitt, zwei Korrekturschleifen', 'hours' => '6–8', 'price' => 665],
                ['name' => 'Farbkorrektur und Tonmischung', 'hours' => '4–5', 'price' => 428],
                ['name' => 'Grafik-Inserts und Bauchbinden', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Untertitel-Erstellung', 'hours' => '2', 'price' => 190],
                ['name' => 'Vier Social-Zuschnitte (9:16 und 1:1)', 'hours' => '3–4', 'price' => 333],
            ],
            'totalHours' => '58–73',
            'totalPrice' => 6130,
            'equipmentNote' => true,
        ],
        6 => [
            'id' => 6,
            'format' => 'projekt',
            'variant' => 'komplett',
            'title' => 'Dokumentarische Projektpräsentation – mit Komplett-Service',
            'subtitle' => 'Zwei Drehtage, drei Sprecher. OfficeTalk übernimmt Projektrecherche, Story-Linie, Sprecherauswahl, Vorbereitungsgespräche und detailliertes Storyboard.',
            'items' => [
                ['name' => 'Projektrecherche und Konzeptionsgespräch', 'hours' => '4', 'price' => 380],
                ['name' => 'Entwicklung der Story-Linie', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Sprecherauswahl und Vorbereitungsgespräche', 'hours' => '3', 'price' => 285],
                ['name' => 'Detailliertes Storyboard und Shotlist', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Location-Scouting Baustelle', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Location-Scouting Büro', 'hours' => '2', 'price' => 190],
                ['name' => 'Drehvorbereitung, Equipment-Planung', 'hours' => '2–3', 'price' => 238],
                ['name' => 'Drehtag 1 (Baustelle, Auf-/Abbau, drei Sprecher)', 'hours' => '9–11', 'price' => 950],
                ['name' => 'Drehtag 2 (Büro, Auf-/Abbau, B-Roll)', 'hours' => '8–10', 'price' => 855],
                ['name' => 'Materialsicherung und Sichtung', 'hours' => '4', 'price' => 380],
                ['name' => 'Rohschnitt Vollversion (7 Minuten)', 'hours' => '10–12', 'price' => 1045],
                ['name' => 'Feinschnitt, zwei Korrekturschleifen', 'hours' => '6–8', 'price' => 665],
                ['name' => 'Farbkorrektur und Tonmischung', 'hours' => '4–5', 'price' => 428],
                ['name' => 'Grafik-Inserts und Bauchbinden', 'hours' => '3–4', 'price' => 333],
                ['name' => 'Untertitel-Erstellung', 'hours' => '2', 'price' => 190],
                ['name' => 'Vier Social-Zuschnitte (9:16 und 1:1)', 'hours' => '3–4', 'price' => 333],
            ],
            'totalHours' => '70–85',
            'totalPrice' => 7176,
            'equipmentNote' => true,
        ],
    ];

    /**
     * Die drei Format-Teaser mit ihren zwei Modal-Trigger-IDs.
     *
     * @var array<int, array{number:string,title:string,body:string,modals:array{vorgabe:int,komplett:int}}>
     */
    public array $formats = [
        [
            'number' => '01',
            'title' => 'Fachinterview',
            'body' => 'Ein Sprecher, ein Drehort, eine Vollversion plus drei Social-Zuschnitte.',
            'modals' => ['vorgabe' => 1, 'komplett' => 2],
        ],
        [
            'number' => '02',
            'title' => 'Event-After-Movie',
            'body' => 'Halbtägige Veranstaltung, Hauptfilm drei bis fünf Minuten plus Social-Zuschnitte.',
            'modals' => ['vorgabe' => 3, 'komplett' => 4],
        ],
        [
            'number' => '03',
            'title' => 'Projektpräsentation',
            'body' => 'Zwei Drehtage, drei Sprecher, sieben Minuten Vollversion plus Social-Zuschnitte.',
            'modals' => ['vorgabe' => 5, 'komplett' => 6],
        ],
    ];
};
?>

@script
<script>
    // Parallax-Controller identisch zur Distribution-Sektion:
    // Image-Layer bewegt sich langsam, Content-Layer darüber schneller.
    Alpine.data('officetalkPricingParallax', () => ({
        target: 0,
        progress: 0,
        inView: false,
        rafId: null,
        observer: null,
        reduceMotion: false,

        measure() {
            const band = this.$refs.parallaxBand;
            if (! band) return;
            const rect = band.getBoundingClientRect();
            const vh = window.innerHeight;
            this.target = Math.max(0, Math.min(1, (vh - rect.top) / (vh + rect.height)));
        },

        loop() {
            this.measure();
            if (this.reduceMotion) {
                this.progress = this.target;
            } else {
                const delta = this.target - this.progress;
                if (Math.abs(delta) < 0.0005) {
                    this.progress = this.target;
                } else {
                    this.progress += delta * 0.08;
                }
            }
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
    id="preise"
    class="officetalk-pricing dark relative overflow-hidden bg-bg pb-s7 text-ink"
    x-data="officetalkPricingParallax"
>

    {{-- Parallax-Band · Hintergrund-Bild, bewegt sich langsam beim Scrollen --}}
    <div
        x-ref="parallaxBand"
        class="relative -mb-1 aspect-square w-full overflow-hidden sm:aspect-video md:aspect-[2/1]"
    >
        <img
            src="{{ asset('parallax-image-2.jpg') }}"
            alt="OfficeTalk-Preismodell · transparent kalkuliert"
            class="absolute inset-0 h-[180%] w-full object-cover object-left motion-safe:will-change-transform lg:h-[130%] lg:object-[25%_center]"
            :style="`transform: translate3d(0, ${-progress * 170}px, 0)`"
            loading="lazy"
        />

        {{-- Verdunkelungs-Gradient über dem Bild, Kontrast zum Dark-Bg --}}
        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-bg/10 via-bg/50 to-bg -mb-1"></div>
        {{-- Solid-Bg am Band-Ende · Kante deterministisch überdecken --}}
        <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-24 bg-bg -mb-1"></div>
    </div>

    {{-- Dezentes Zahlen-Motiv im Hintergrund · ultra-large "95" als Ghost-Numeral, fest verankert --}}
    <span
        aria-hidden="true"
        class="pointer-events-none absolute -right-s5 top-s5 z-0 hidden select-none font-display text-[320px] font-medium italic leading-none text-ink/[0.06] md:block lg:text-[480px] lg:-right-s6"
    >
        95
    </span>

    <div
        class="relative container pt-s5 md:pt-s6 motion-safe:will-change-transform"
        :style="`transform: translate3d(0, ${-progress * 290}px, 0); margin-bottom: ${-progress * 290}px;`"
    >

        {{-- Masthead · Eyebrow + H2 links, Intro rechts · asymmetrisch --}}
        <header class="grid gap-s5 md:grid-cols-12 md:gap-s6">
            <div class="md:col-span-7">
                <p class="font-sans text-eyebrow uppercase text-muted">
                    Preise — ein Stundensatz, transparent abgerechnet
                </p>
                <h2 class="mt-s3 font-display text-h3 font-medium leading-tight text-balance text-ink hyphens-auto md:text-[40px] lg:text-h2" lang="de">
                    Ein Stundensatz. Keine Pakete.
                </h2>
            </div>
            <div class="md:col-span-5 md:pt-s5">
                <p class="font-sans text-lead text-ink">
                    OfficeTalk rechnet nach Stundensatz ab – ohne Staffelung nach Tätigkeit, ohne Paketpreise, ohne versteckte Posten. Konzeption, Dreh, Schnitt, Postproduktion: alles zum gleichen Satz. Abgerechnet wird minutengenau, nicht in angefangenen Halbstunden. Was vereinbart ist, gilt – Handschlagqualität zählt, auch wenn das Angebot schriftlich fixiert wird.
                </p>
            </div>
        </header>

        {{-- Hero-Preisblock · große italic "95 €" + micro-typo "PRO STUNDE · NETTO" --}}
        <div class="mt-s7 md:mt-[96px]">
            <div class="grid items-end gap-s5 md:grid-cols-12 md:gap-s6">
                <div class="md:col-span-7">
                    <div class="flex items-start gap-s3">
                        <span class="font-display text-[140px] font-medium italic leading-[0.82] text-ink md:text-[200px] lg:text-[260px]">
                            95
                        </span>
                        <div class="flex flex-col justify-end self-stretch pb-s2 md:pb-s4">
                            <span class="font-display text-[48px] font-medium italic leading-none text-accent md:text-[72px] lg:text-[88px]">€</span>
                            <span class="mt-s3 block font-sans text-meta font-semibold uppercase tracking-[0.14em] text-muted">
                                pro Stunde<br>Netto
                            </span>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-5 md:pb-s2">
                    <p class="font-sans text-body text-ink">
                        Plus 20 Prozent Umsatzsteuer. Drehs in Wien ohne Anfahrtspauschale. Außerhalb Wiens wird die An- und Abreise zum gleichen Stundensatz verrechnet, Kilometergeld nach amtlichem Satz.
                    </p>
                    <p class="mt-s3 font-sans text-meta text-muted">
                        Sonderequipment – Dolly, Kran, Drohne, Lichtanlage für große Flächen – ist im Stundensatz nicht enthalten und wird als Equipmentpauschale gesondert ausgewiesen. Die Pauschale steht transparent im Angebot, bevor Sie zusagen.
                    </p>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <hr class="mt-s7 border-line md:mt-[96px]" />

        {{-- H3 + Intro zur Kalkulation --}}
        <div class="mt-s6 grid gap-s5 md:grid-cols-12 md:gap-s6">
            <div class="md:col-span-5">
                <h3 class="font-display text-h3 font-medium leading-tight text-balance text-ink">
                    Beispielkalkulationen für die drei Hauptformate
                </h3>
            </div>
            <div class="md:col-span-7 md:pt-s2">
                <p class="font-sans text-lead text-ink">
                    Jedes der drei Schwerpunktformate kalkuliert sich in zwei Varianten, je nachdem, wer die redaktionelle Vorarbeit übernimmt. Wenn Ihre Marketing-Abteilung Konzept, Zielgruppen-Briefing und Fragenkatalog mitbringt, entfällt die Konzeptionsphase bei OfficeTalk – der Aufwand reduziert sich entsprechend. Beim Komplett-Service übernimmt OfficeTalk auch Themenschärfung und Redaktion.
                </p>
            </div>
        </div>

        {{-- 3 Format-Teaser-Cards mit je zwei Modal-Triggern --}}
        <div class="mt-s6 grid grid-cols-1 gap-s4 md:mt-s7 md:grid-cols-3 md:gap-s5">
            @foreach ($formats as $format)
                <article class="group relative flex flex-col border-t border-line pt-s5 transition-colors duration-500 ease-editorial hover:border-accent">
                    <span aria-hidden="true" class="absolute -top-[2px] left-0 h-[3px] w-16 bg-accent transition-all duration-500 ease-editorial group-hover:w-28"></span>

                    <p class="font-display text-[48px] font-medium italic leading-none text-ink/25 md:text-[64px]">
                        {{ $format['number'] }}
                    </p>

                    <h4 class="mt-s3 font-display text-h3 font-medium leading-tight text-ink">
                        {{ $format['title'] }}
                    </h4>

                    <p class="mt-s2 font-sans text-body text-muted">
                        {{ $format['body'] }}
                    </p>

                    <div class="mt-s4 flex flex-col gap-s2 border-t border-line pt-s3">
                        <button
                            type="button"
                            @click="$store.priceCalculation.open({{ $format['modals']['vorgabe'] }})"
                            class="group/btn inline-flex items-baseline justify-between gap-s2 text-left font-sans text-meta font-medium text-ink transition-colors duration-300 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                        >
                            <span class="flex items-baseline gap-s2">
                                <span class="font-display italic text-muted">→</span>
                                Kalkulation mit <strong class="font-semibold">Konzept-Vorgabe</strong>
                            </span>
                            <span aria-hidden="true" class="font-display text-meta italic text-muted opacity-0 transition-opacity duration-300 group-hover/btn:opacity-100">ansehen</span>
                        </button>
                        <button
                            type="button"
                            @click="$store.priceCalculation.open({{ $format['modals']['komplett'] }})"
                            class="group/btn inline-flex items-baseline justify-between gap-s2 text-left font-sans text-meta font-medium text-ink transition-colors duration-300 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                        >
                            <span class="flex items-baseline gap-s2">
                                <span class="font-display italic text-muted">→</span>
                                Kalkulation mit <strong class="font-semibold">Komplett-Service</strong>
                            </span>
                            <span aria-hidden="true" class="font-display text-meta italic text-muted opacity-0 transition-opacity duration-300 group-hover/btn:opacity-100">ansehen</span>
                        </button>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Abschluss-Paragraph --}}
        <p class="mt-s6 max-w-measure font-sans text-body text-muted md:mt-s7">
            Jedes Angebot enthält eine schriftliche Stundenschätzung pro Produktionsphase. Mehraufwand wird nur nach Absprache berechnet, die Abrechnung erfolgt minutengenau nach tatsächlichem Einsatz. Equipmentpauschalen, sofern nötig, stehen im selben Angebot separat ausgewiesen.
        </p>
    </div>

    {{-- ══════════════════════════════════════════════════════
         Kalkulations-Modal · ein Template rendert alle sechs Varianten
         dynamisch aus dem data-Array, gesteuert über Alpine-Store priceCalculation
         ══════════════════════════════════════════════════════ --}}
    <div
        x-cloak
        x-data="{ calcs: @js($calculations) }"
        x-show="$store.priceCalculation.openId"
        @keydown.escape.window="$store.priceCalculation.close()"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-start justify-center overflow-y-auto bg-ink/85 px-s3 py-s5 backdrop-blur-md md:items-center md:px-s5"
        role="dialog"
        aria-modal="true"
        aria-labelledby="calc-modal-title"
        aria-describedby="calc-modal-subtitle"
        @click.self="$store.priceCalculation.close()"
    >
        <template x-if="$store.priceCalculation.openId">
            <article
                x-transition:enter="transition ease-out duration-400 delay-100"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="relative my-auto w-full max-w-3xl bg-bg p-s4 shadow-[0_48px_96px_-32px_rgba(0,0,0,0.5)] md:p-s6"
            >
                {{-- Close-Button · top-right --}}
                <button
                    type="button"
                    @click="$store.priceCalculation.close()"
                    class="absolute right-s3 top-s3 flex h-10 w-10 items-center justify-center rounded-full bg-surface text-ink transition-colors duration-200 hover:bg-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                    aria-label="Modal schließen"
                >
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <line x1="2" y1="2" x2="12" y2="12" />
                        <line x1="12" y1="2" x2="2" y2="12" />
                    </svg>
                </button>

                {{-- Titel + Subtitel --}}
                <p class="font-sans text-eyebrow uppercase tracking-[0.12em] text-accent">
                    Kalkulation · <span x-text="calcs[$store.priceCalculation.openId].id">0</span> / 06
                </p>
                <h3
                    id="calc-modal-title"
                    class="mt-s2 pr-s5 font-display text-h3 font-medium leading-tight text-ink md:text-[32px]"
                    x-text="calcs[$store.priceCalculation.openId].title"
                ></h3>
                <p
                    id="calc-modal-subtitle"
                    class="mt-s3 font-display text-h4 italic text-muted"
                    x-text="calcs[$store.priceCalculation.openId].subtitle"
                ></p>

                {{-- Tabelle · Leistung · Aufwand · Kosten netto --}}
                <div class="mt-s5 overflow-x-auto">
                    <table class="w-full font-sans text-meta">
                        <thead>
                            <tr class="border-b-2 border-ink text-left">
                                <th scope="col" class="py-s2 pr-s3 font-sans text-eyebrow font-semibold uppercase tracking-[0.08em] text-muted">Leistung</th>
                                <th scope="col" class="hidden py-s2 pr-s3 font-sans text-eyebrow font-semibold uppercase tracking-[0.08em] text-muted sm:table-cell">Aufwand</th>
                                <th scope="col" class="py-s2 text-right font-sans text-eyebrow font-semibold uppercase tracking-[0.08em] text-muted">Kosten netto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="item in calcs[$store.priceCalculation.openId].items" :key="item.name">
                                <tr class="border-b border-line">
                                    <td class="py-s2 pr-s3 text-body text-ink" x-text="item.name"></td>
                                    <td class="hidden py-s2 pr-s3 text-muted tabular-nums sm:table-cell" x-text="item.hours + ' Std'"></td>
                                    <td class="py-s2 text-right font-medium tabular-nums text-ink" x-text="item.price.toLocaleString('de-DE') + ' €'"></td>
                                </tr>
                            </template>
                            <tr class="border-t-2 border-ink">
                                <td class="py-s3 pr-s3 font-display text-h4 font-medium not-italic text-ink">Gesamt</td>
                                <td class="hidden py-s3 pr-s3 font-sans text-meta font-semibold tabular-nums text-ink sm:table-cell" x-text="calcs[$store.priceCalculation.openId].totalHours + ' Std'"></td>
                                <td class="py-s3 text-right font-display text-h4 font-medium tabular-nums text-ink" x-text="calcs[$store.priceCalculation.openId].totalPrice.toLocaleString('de-DE') + ' €'"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Hinweis unter Tabelle --}}
                <p class="mt-s4 font-sans text-meta text-muted">
                    Zuzüglich 20 Prozent Umsatzsteuer. Equipmentpauschalen für Sonderausrüstung<template x-if="calcs[$store.priceCalculation.openId].equipmentNote"><span> (Drohne, Dolly, großflächiges Licht)</span></template>, sofern nötig, werden im Angebot separat ausgewiesen. Alle Zeitangaben sind Schätzkorridor – abgerechnet wird nach tatsächlichem Aufwand, minutengenau.
                </p>

                {{-- CTA --}}
                <div class="mt-s5 flex flex-col-reverse gap-s3 border-t border-line pt-s4 md:flex-row md:items-center md:justify-between">
                    <button
                        type="button"
                        @click="$store.priceCalculation.close()"
                        class="font-sans text-meta font-medium text-muted transition-colors duration-200 hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                    >
                        Zurück zur Übersicht
                    </button>
                    <a
                        href="#kontakt"
                        @click="$store.priceCalculation.close()"
                        class="group/cta inline-flex items-center justify-center gap-s2 bg-accent px-s4 py-s3 font-sans text-body font-semibold text-[#111] transition-colors duration-200 hover:bg-[#111] hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                    >
                        Unverbindliches Angebot anfordern
                        <svg width="18" height="12" viewBox="0 0 18 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="transition-transform duration-300 ease-editorial group-hover/cta:translate-x-1">
                            <path d="M 1 6 L 16 6" />
                            <path d="M 11 1 L 16 6 L 11 11" />
                        </svg>
                    </a>
                </div>
            </article>
        </template>
    </div>
</section>
