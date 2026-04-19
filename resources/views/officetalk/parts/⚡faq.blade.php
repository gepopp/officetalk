<?php

use Livewire\Component;

new class extends Component {
    /**
     * Die zehn FAQ-Einträge nach Spec. Antworten enthalten ggf. Inline-HTML für interne Links.
     *
     * @var array<int, array{id:string,question:string,answer:string,answerPlain:string,defaultOpen:bool}>
     */
    public array $questions = [
        [
            'id' => 'faq-positionierung',
            'question' => 'Ist OfficeTalk ein Format der Immobilien Redaktion?',
            'answer' => 'Nein. OfficeTalk ist eine eigenständige Videoproduktion von Gerhard Popp. Die unabhängige Immobilien Redaktion (Walter Senk) und der Bau &amp; Immobilien Report (Bernd Affenzeller) sind journalistische Kooperationspartner für redaktionelle Einordnung und Distribution. Die Produktionsverantwortung, das Angebot und die Rechnung liegen bei OfficeTalk.',
            'answerPlain' => 'Nein. OfficeTalk ist eine eigenständige Videoproduktion von Gerhard Popp. Die unabhängige Immobilien Redaktion (Walter Senk) und der Bau & Immobilien Report (Bernd Affenzeller) sind journalistische Kooperationspartner für redaktionelle Einordnung und Distribution. Die Produktionsverantwortung, das Angebot und die Rechnung liegen bei OfficeTalk.',
            'defaultOpen' => true,
        ],
        [
            'id' => 'faq-branchen',
            'question' => 'Für welche Branchen arbeitet OfficeTalk?',
            'answer' => 'Schwerpunkt sind Immobilien und Bau, also Projektentwicklung, Bauträger, Makler, Hausverwaltungen, Baustofffirmen, Bauunternehmen und PropTech-Anbieter. Darüber hinaus arbeitet OfficeTalk für angrenzende B2B-Branchen mit ähnlichem Fachpublikum: Wirtschaftskanzleien, Steuerberatungen, Architekturbüros und Planungsgesellschaften.',
            'answerPlain' => 'Schwerpunkt sind Immobilien und Bau, also Projektentwicklung, Bauträger, Makler, Hausverwaltungen, Baustofffirmen, Bauunternehmen und PropTech-Anbieter. Darüber hinaus arbeitet OfficeTalk für angrenzende B2B-Branchen mit ähnlichem Fachpublikum: Wirtschaftskanzleien, Steuerberatungen, Architekturbüros und Planungsgesellschaften.',
            'defaultOpen' => false,
        ],
        [
            'id' => 'faq-kosten',
            'question' => 'Was kostet eine Videoproduktion?',
            'answer' => 'OfficeTalk rechnet nach Stundensatz ab, nicht nach Paketpreis. Der Satz liegt bei 95 Euro netto pro Stunde, abgerechnet wird minutengenau. Für die drei Hauptformate – Fachinterview, Event-After-Movie, Projektpräsentation – stehen <a href="#preise" class="text-accent underline underline-offset-2 hover:no-underline">oben in der Preis-Sektion</a> detaillierte Beispielkalkulationen bereit. Jede Kalkulation gibt es in zwei Varianten: mit Konzept-Vorgabe durch Ihre Marketing-Abteilung und mit Komplett-Service durch OfficeTalk.',
            'answerPlain' => 'OfficeTalk rechnet nach Stundensatz ab, nicht nach Paketpreis. Der Satz liegt bei 95 Euro netto pro Stunde, abgerechnet wird minutengenau. Für die drei Hauptformate – Fachinterview, Event-After-Movie, Projektpräsentation – stehen oben in der Preis-Sektion detaillierte Beispielkalkulationen bereit. Jede Kalkulation gibt es in zwei Varianten: mit Konzept-Vorgabe durch Ihre Marketing-Abteilung und mit Komplett-Service durch OfficeTalk.',
            'defaultOpen' => false,
        ],
        [
            'id' => 'faq-preismodell',
            'question' => 'Warum Stundensatz statt Tagespauschale?',
            'answer' => 'Weil Tagespauschalen die Realität verzerren. Ein Dreh, der nach zwei Stunden beendet ist, kostet bei den meisten Mitbewerbern trotzdem einen halben Drehtag. Ein Schnittprojekt, das fünfzehn Stunden braucht, wird pauschal mit zwei Tagen abgerechnet. Der Stundensatz kehrt das Prinzip um: Sie zahlen für den tatsächlichen Aufwand, nicht für die Abrechnungseinheit. Jedes Angebot enthält eine schriftliche Stundenschätzung pro Produktionsphase. Mehraufwand wird nur nach vorheriger Absprache berechnet.',
            'answerPlain' => 'Weil Tagespauschalen die Realität verzerren. Ein Dreh, der nach zwei Stunden beendet ist, kostet bei den meisten Mitbewerbern trotzdem einen halben Drehtag. Ein Schnittprojekt, das fünfzehn Stunden braucht, wird pauschal mit zwei Tagen abgerechnet. Der Stundensatz kehrt das Prinzip um: Sie zahlen für den tatsächlichen Aufwand, nicht für die Abrechnungseinheit. Jedes Angebot enthält eine schriftliche Stundenschätzung pro Produktionsphase. Mehraufwand wird nur nach vorheriger Absprache berechnet.',
            'defaultOpen' => false,
        ],
        [
            'id' => 'faq-redaktion',
            'question' => 'Was bedeutet "redaktionelle Vorarbeit" konkret?',
            'answer' => 'Konzeption und Redaktion sind die Leistungen vor dem Drehtag: Themenschärfung, Zielgruppen-Briefing, Fragenkatalog-Entwicklung, Drehbuch bei Projektpräsentationen, Shotlist bei Eventfilmen. OfficeTalk kann diese Arbeit übernehmen – oder Ihre Marketing-Abteilung bringt sie mit. Beide Modi sind gleichwertig und <a href="#preise" class="text-accent underline underline-offset-2 hover:no-underline">in der Preis-Sektion</a> als zwei getrennte Kalkulationen ausgewiesen. Die Differenz liegt zwischen 670 und 1.050 Euro netto pro Projekt, abhängig vom Format.',
            'answerPlain' => 'Konzeption und Redaktion sind die Leistungen vor dem Drehtag: Themenschärfung, Zielgruppen-Briefing, Fragenkatalog-Entwicklung, Drehbuch bei Projektpräsentationen, Shotlist bei Eventfilmen. OfficeTalk kann diese Arbeit übernehmen – oder Ihre Marketing-Abteilung bringt sie mit. Beide Modi sind gleichwertig und in der Preis-Sektion als zwei getrennte Kalkulationen ausgewiesen. Die Differenz liegt zwischen 670 und 1.050 Euro netto pro Projekt, abhängig vom Format.',
            'defaultOpen' => false,
        ],
        [
            'id' => 'faq-dauer',
            'question' => 'Wie lange dauert die Produktion?',
            'answer' => 'Von der Angebotsfreigabe bis zur Lieferung rechnen Sie mit drei bis fünf Wochen. Entscheidend ist die Terminverfügbarkeit der Sprecherinnen und Sprecher und der Abstimmungsbedarf der Korrekturschleife. Den vollständigen Ablauf am Beispiel einer abgeschlossenen Produktion zeigt die Unterseite <a href="/officetalk/ablauf-interview" class="text-accent underline underline-offset-2 hover:no-underline">So entsteht ein OfficeTalk-Interview →</a>. Eilproduktionen sind möglich, werden transparent ausgewiesen.',
            'answerPlain' => 'Von der Angebotsfreigabe bis zur Lieferung rechnen Sie mit drei bis fünf Wochen. Entscheidend ist die Terminverfügbarkeit der Sprecherinnen und Sprecher und der Abstimmungsbedarf der Korrekturschleife. Den vollständigen Ablauf am Beispiel einer abgeschlossenen Produktion zeigt die Unterseite So entsteht ein OfficeTalk-Interview. Eilproduktionen sind möglich, werden transparent ausgewiesen.',
            'defaultOpen' => false,
        ],
        [
            'id' => 'faq-linkedin',
            'question' => 'Welches Format funktioniert auf LinkedIn?',
            'answer' => 'Vertikal 9:16, Länge zwischen 30 und 90 Sekunden, Untertitel fest einbelichtet, Einstieg in der ersten Sekunde ohne Logo-Vorlauf. Horizontalfassungen landen auf YouTube, Website und in Präsentationen. OfficeTalk liefert standardmäßig beide Zuschnitte aus demselben Dreh.',
            'answerPlain' => 'Vertikal 9:16, Länge zwischen 30 und 90 Sekunden, Untertitel fest einbelichtet, Einstieg in der ersten Sekunde ohne Logo-Vorlauf. Horizontalfassungen landen auf YouTube, Website und in Präsentationen. OfficeTalk liefert standardmäßig beide Zuschnitte aus demselben Dreh.',
            'defaultOpen' => false,
        ],
        [
            'id' => 'faq-teleprompter',
            'question' => 'Gibt es Teleprompter-Drehs?',
            'answer' => 'Ja. Für Geschäftsführerinnen, Partner in Kanzleien und Fachexpertinnen, die einen straffen Terminkalender haben. Ein Vormittag bei Ihnen im Haus oder an einem gescouteten Drehort reicht in der Regel für drei bis sechs fertige Clips à 60 bis 90 Sekunden. Das Skript entsteht entweder intern oder gemeinsam mit OfficeTalk.',
            'answerPlain' => 'Ja. Für Geschäftsführerinnen, Partner in Kanzleien und Fachexpertinnen, die einen straffen Terminkalender haben. Ein Vormittag bei Ihnen im Haus oder an einem gescouteten Drehort reicht in der Regel für drei bis sechs fertige Clips à 60 bis 90 Sekunden. Das Skript entsteht entweder intern oder gemeinsam mit OfficeTalk.',
            'defaultOpen' => false,
        ],
        [
            'id' => 'faq-rechte',
            'question' => 'Welche Rechte liegen beim Auftraggeber?',
            'answer' => 'Nach Zahlung der Schlussrechnung erhält der Auftraggeber ein unbefristetes, übertragbares Nutzungsrecht am fertigen Film und an den freigegebenen Schnittversionen. Rohmaterial bleibt bei OfficeTalk archiviert und kann gegen Aufwand für spätere Zweitverwertungen genutzt werden.',
            'answerPlain' => 'Nach Zahlung der Schlussrechnung erhält der Auftraggeber ein unbefristetes, übertragbares Nutzungsrecht am fertigen Film und an den freigegebenen Schnittversionen. Rohmaterial bleibt bei OfficeTalk archiviert und kann gegen Aufwand für spätere Zweitverwertungen genutzt werden.',
            'defaultOpen' => false,
        ],
        [
            'id' => 'faq-drehorte',
            'question' => 'Wird außerhalb Wiens gedreht?',
            'answer' => 'Ja. Drehs in Graz, Linz, Salzburg, München, Zürich, Berlin und im weiteren DACH-Raum sind Teil des regelmäßigen Geschäfts. Reisekosten werden gesondert ausgewiesen: An- und Abreise zum gleichen Stundensatz, Kilometergeld nach amtlichem Satz. Drehs in Wien selbst sind ohne Anfahrtspauschale.',
            'answerPlain' => 'Ja. Drehs in Graz, Linz, Salzburg, München, Zürich, Berlin und im weiteren DACH-Raum sind Teil des regelmäßigen Geschäfts. Reisekosten werden gesondert ausgewiesen: An- und Abreise zum gleichen Stundensatz, Kilometergeld nach amtlichem Satz. Drehs in Wien selbst sind ohne Anfahrtspauschale.',
            'defaultOpen' => false,
        ],
    ];

    /**
     * Liefert die IDs, die beim Seitenaufruf automatisch aufgeklappt sein sollen.
     *
     * @return array<int, string>
     */
    public function getDefaultOpenIdsProperty(): array
    {
        return array_values(array_map(
            fn ($q) => $q['id'],
            array_filter($this->questions, fn ($q) => $q['defaultOpen']),
        ));
    }

    /**
     * Baut das Schema.org-FAQPage-JSON-LD aus den Fragen.
     */
    public function getFaqSchemaProperty(): string
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_values(array_map(fn ($q) => [
                '@type' => 'Question',
                'name' => $q['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $q['answerPlain'],
                ],
            ], $this->questions)),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
};
?>

<section id="faq" class="relative bg-bg py-s7">
    <div class="container">

        {{-- Masthead · Eyebrow + H2 links, Intro rechts --}}
        <header class="grid gap-s5 md:grid-cols-12 md:gap-s6">
            <div class="md:col-span-5">
                <p class="font-sans text-eyebrow uppercase text-muted">
                    FAQ — zehn Fragen aus Erstgesprächen
                </p>
                <h2 class="mt-s3 font-display text-h3 font-medium leading-tight text-balance text-ink md:text-[40px] lg:text-h2" lang="de">
                    Häufige Fragen.
                </h2>
            </div>
            <div class="md:col-span-7 md:pt-s5">
                <p class="font-sans text-lead text-ink">
                    Antworten auf die Fragen, die in Erstgesprächen am häufigsten kommen. Was hier fehlt, klärt sich am schnellsten per Mail oder Telefonat.
                </p>
            </div>
        </header>

        {{-- Accordion · ARIA-konformes Disclosure-Pattern mit Alpine-State + Deep-Link-Handling --}}
        <div
            class="mt-s7 divide-y divide-line border-y border-line md:mx-auto md:max-w-[880px]"
            x-data="{
                open: @js($this->defaultOpenIds),
                toggle(id) {
                    if (this.open.includes(id)) {
                        this.open = this.open.filter(x => x !== id);
                    } else {
                        this.open = [...this.open, id];
                    }
                },
                isOpen(id) { return this.open.includes(id); },
                init() {
                    // Deep-Link · öffnet die Frage zum URL-Fragment und scrollt sanft.
                    const applyHash = () => {
                        const hash = window.location.hash.replace('#', '');
                        if (! hash) return;
                        const el = this.$el.querySelector(`[data-faq-item='${hash}']`);
                        if (! el) return;
                        if (! this.isOpen(hash)) this.open = [...this.open, hash];
                        setTimeout(() => el.scrollIntoView({ behavior: 'smooth', block: 'start' }), 200);
                    };
                    applyHash();
                    window.addEventListener('hashchange', applyHash);
                }
            }"
        >
            @foreach ($questions as $q)
                <div
                    wire:key="{{ $q['id'] }}"
                    id="{{ $q['id'] }}"
                    data-faq-item="{{ $q['id'] }}"
                    class="group py-s4"
                >
                    <h3>
                        <button
                            type="button"
                            @click="toggle('{{ $q['id'] }}')"
                            :aria-expanded="isOpen('{{ $q['id'] }}').toString()"
                            aria-controls="{{ $q['id'] }}-panel"
                            class="flex w-full cursor-pointer items-start justify-between gap-s4 py-s2 text-left font-display text-h4 font-medium text-ink transition-colors duration-220 ease-editorial hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-accent md:text-[26px]"
                        >
                            <span>{{ $q['question'] }}</span>
                            <svg
                                aria-hidden="true"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="mt-s1 h-6 w-6 shrink-0 transition-transform duration-300 ease-editorial"
                                :class="{ 'rotate-180': isOpen('{{ $q['id'] }}') }"
                            >
                                <path d="M 4 9 L 12 17 L 20 9" />
                            </svg>
                        </button>
                    </h3>

                    {{-- Panel · x-show + x-collapse für sanftes Height-Easing.
                         aria-expanded am Trigger-Button informiert Screenreader über Zustand. --}}
                    <div
                        id="{{ $q['id'] }}-panel"
                        role="region"
                        aria-labelledby="{{ $q['id'] }}"
                        x-show="isOpen('{{ $q['id'] }}')"
                        x-collapse
                    >
                        <p class="max-w-measure pt-s3 font-sans text-body leading-relaxed text-ink">
                            {!! $q['answer'] !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Schema.org FAQPage · JSON-LD für Rich Snippets --}}
    <script type="application/ld+json">
        {!! $this->faqSchema !!}
    </script>
</section>
