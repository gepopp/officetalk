<?php

use Livewire\Component;

new class extends Component {
    /**
     * @var array<int, array{number:string,title:string,body:string}>
     */
    public array $stages = [
        [
            'number' => '01',
            'title' => 'Konzeption und Redaktion',
            'body' => 'Der erste Schritt im Produktionsweg entscheidet über den letzten. Briefing-Workshop, Themenschärfung, Zielgruppen-Abgleich, Fragenkatalog und Drehbuch – die redaktionelle Vorarbeit macht den Unterschied zwischen einem Video, das sieben Tage läuft, und einem, das drei Jahre als Referenz dient. Abgestimmt mit Ihrem Haus, bevor die Kamera eingeschaltet wird.',
        ],
        [
            'number' => '02',
            'title' => 'Location-Scouting',
            'body' => 'Ob eigenes Büro, Baustelle, Zinshaus-Innenhof oder angemietetes Studio – der richtige Ort trägt die Aussage des Videos. Als Ihr Ansprechpartner scoute ich die Location, verhandle Nutzungsrechte und koordiniere die Logistik vor Ort. Alternativ wird am gewünschten Drehort eine kompakte, kamera-taugliche Umgebung eingerichtet.',
        ],
        [
            'number' => '03',
            'title' => 'Dreh',
            'body' => 'Zwei-Kamera-Setup als Standard, Funkstrecken und Kunstlicht im Basispaket, Teleprompter auf Wunsch. Drehtage beginnen planbar, enden pünktlich, das Material wird noch am selben Tag gesichert. Kamera, Ton, Licht und Regie bleiben in einer Hand – das reduziert Reibung am Set und hält die Kostenstruktur nachvollziehbar.',
        ],
        [
            'number' => '04',
            'title' => 'Postproduktion',
            'body' => 'Rohschnitt innerhalb von zehn Arbeitstagen, Farbkorrektur, Tonmischung, Untertitel, Grafik-Inserts, Kapitelmarken. Eine Korrekturschleife ist im Preis enthalten, jede weitere wird transparent nach Stunden abgerechnet. Export in 16:9 für Website und YouTube, 9:16 für LinkedIn und Instagram, 1:1 für Feed-Platzierung.',
        ],
        [
            'number' => '05',
            'title' => 'Distribution',
            'body' => 'Am Ende des Produktionswegs steht die Veröffentlichung. Auf Wunsch übernehme ich den Erst-Upload über meinen LinkedIn-Account oder koordiniere die Einbindung mit den redaktionellen Kooperationspartnern. Details zur Reichweite: siehe Sektion Distribution weiter oben.',
        ],
    ];
};
?>

@once
<style>
    /* Paper-Grain · warmer Rauschen-Layer auf der Service-Section */
    #service::before {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: 0.5;
        mix-blend-mode: multiply;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='160' height='160'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 0.06 0 0 0 0 0.06 0 0 0 0 0.06 0 0 0 0.05 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
    }

    /* Fade-Up · via Alpine x-intersect ausgelöst, hier der Styling-Kontrakt.
       Ease-Out mit leichtem "paper settling"-Schwung, bewusst langsame 900ms. */
    [data-officetalk-stage] {
        opacity: 0;
        transform: translateY(32px);
        transition:
            opacity 900ms cubic-bezier(0.22, 1, 0.36, 1),
            transform 900ms cubic-bezier(0.22, 1, 0.36, 1);
    }
    [data-officetalk-stage].is-revealed {
        opacity: 1;
        transform: translateY(0);
    }

    /* Reduced Motion: sofort sichtbar, keine Animation */
    @media (prefers-reduced-motion: reduce) {
        [data-officetalk-stage] {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }
</style>
@endonce

<section class="relative overflow-hidden bg-bg py-s7">
    <div class="relative container">

        {{-- Masthead · Eyebrow + H2 links, Intro rechts.
             Scroll-Anker liegt hier, damit beim Klick auf Menü "Prozess"
             direkt die Headline sichtbar ist (statt des py-s7-Paddings). --}}
        <header id="service" class="grid gap-s5 scroll-mt-[120px] md:grid-cols-12 md:gap-s6">
            <div class="md:col-span-5">
                <p class="font-sans text-eyebrow uppercase text-muted">
                    Service — ein Ansprechpartner, ein Angebot
                </p>
                <h2 class="mt-s3 font-display text-h3 font-medium leading-tight text-balance text-ink hyphens-auto md:text-[32px] lg:text-h2" lang="de">
                    Der gesamte Produktionsweg bei einem Ansprechpartner.
                </h2>
            </div>

            <div class="md:col-span-7 md:pt-s4">
                <p class="font-sans text-lead text-ink">
                    Von der ersten Idee bis zum fertigen Clip auf Ihrer Website, Ihrem LinkedIn-Profil oder im Fachmedium – bei OfficeTalk liegt der gesamte Produktionsweg in einer Hand. Eine Abstimmung, eine Lieferung, ohne zwischengeschaltete Agentur, ohne Gewerke-Koordination, ohne unterschiedliche Rechnungen.
                </p>
                <p class="mt-s3 font-display text-h4 italic text-muted">
                    Ein Projekt, ein Ansprechpartner, ein Angebot.
                </p>
            </div>
        </header>

        {{-- Timeline · magazin-feature-style mit scroll-driven reveal + sticky number + italic nummerierung --}}
        <ol class="mt-s7 space-y-s6 md:space-y-s7">
            @foreach ($stages as $index => $stage)
                <li
                    data-officetalk-stage
                    wire:key="stage-{{ $stage['number'] }}"
                    x-data
                    x-intersect.once.margin.-15%="$el.classList.add('is-revealed')"
                    style="transition-delay: {{ $index * 120 }}ms"
                    class="group grid gap-s3 border-t border-line pt-s5 transition-colors duration-500 ease-editorial hover:border-accent md:grid-cols-12 md:gap-s5"
                >
                    {{-- Nummer-Column · sticky auf Desktop, Italic Fraunces für editorial Eleganz --}}
                    <div class="md:col-span-3">
                        <div class="md:sticky md:top-s5">
                            <p class="flex items-baseline gap-s2 font-display leading-none text-accent">
                                <span class="text-[64px] italic transition-transform duration-500 ease-editorial group-hover:translate-x-1 md:text-[80px]">
                                    {{ $stage['number'] }}
                                </span>
                                <span class="font-sans text-meta font-medium not-italic tracking-wider text-muted">
                                    / {{ str_pad((string) count($stages), 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="md:col-span-9">
                        {{-- H3 mit Underline-Reveal im Hover · editorial Kicker-Effekt --}}
                        <h3 class="relative inline-block font-display text-h3 font-medium leading-tight text-ink">
                            <span class="relative z-10">{{ $stage['title'] }}</span>
                            <span
                                aria-hidden="true"
                                class="absolute left-0 bottom-[-4px] h-[2px] w-12 bg-accent transition-all duration-500 ease-editorial group-hover:w-full"
                            ></span>
                        </h3>
                        <p class="mt-s4 font-sans text-body text-ink max-w-measure">
                            {{ $stage['body'] }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ol>

    </div>
</section>
