<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('officetalk::components.layouts.app')]
#[Title('Impressum · OfficeTalk')]
class extends Component {
    public function with(): array
    {
        return [
            'contact' => config('officetalk.contact'),
        ];
    }
};
?>

<x-slot:metaDescription>
    Impressum und Offenlegung gemäß § 5 ECG, § 14 UGB und § 25 Mediengesetz — OfficeTalk, B2B-Videoproduktion, Gerhard Popp in Wien.
</x-slot>

<x-slot:canonical>{{ route('officetalk.legal.impressum') }}</x-slot>

<div>
    <section class="relative bg-bg py-s7">
        <div class="container">

            <p class="font-sans text-eyebrow uppercase tracking-[0.12em] text-muted">
                Rechtliches — Offenlegung
            </p>
            <h1 class="mt-s3 font-display text-h2 font-medium leading-tight text-balance text-ink">
                Impressum.
            </h1>
            <p class="officetalk-legal-prose legal-stand mt-s4">
                Stand: 19.04.2026
            </p>

            <div class="officetalk-legal-prose mt-s6">

                <h2>Unternehmen</h2>
                <p>
                    <strong>{{ $contact['legal_name'] }}</strong><br>
                    handelnd unter der Geschäftsbezeichnung „{{ $contact['brand_name'] }}"<br>
                    {{ $contact['tagline'] }}
                </p>
                <p>
                    {{ $contact['address']['street'] }}<br>
                    {{ $contact['address']['postal_code'] }} {{ $contact['address']['city'] }}, {{ $contact['address']['country'] }}
                </p>
                <p>
                    @if ($contact['phone'] && $contact['phone'] !== '[Telefonnummer]')
                        Telefon: <a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}">{{ $contact['phone'] }}</a><br>
                    @endif
                    E-Mail: <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                </p>

                <h2>Unternehmensgegenstand</h2>
                <p>
                    B2B-Videoproduktion, insbesondere Produktion von Fachinterviews, Projektpräsentationen, Teleprompter-Clips, LinkedIn-Reels, Event-After-Movies und Livestreams für Unternehmen der Immobilien-, Bau-, PropTech-, Kanzlei-, Architektur- und Steuerberatungsbranche im DACH-Raum.
                </p>

                <h2>Gewerberechtliche Angaben</h2>
                <p>
                    UID-Nummer: <em>[ATU-Nummer – vor Go-Live einfügen]</em><br>
                    Gewerbeberechtigung: Werbeagentur (freies Gewerbe)<br>
                    Gewerbebehörde: Magistrat der Stadt Wien, Magistratisches Bezirksamt für den <em>[Bezirk]</em>. Bezirk<br>
                    Mitglied der Wirtschaftskammer Wien, Fachgruppe Werbung und Marktkommunikation
                </p>
                <p>
                    Anwendbare Gewerbevorschriften: Gewerbeordnung 1994, abrufbar unter <a href="https://www.ris.bka.gv.at" target="_blank" rel="noopener noreferrer">www.ris.bka.gv.at</a>.
                </p>

                <h2>Verantwortlich für den Inhalt (§ 25 Mediengesetz)</h2>
                <p>
                    Medieninhaber, Herausgeber und für den Inhalt verantwortlich:<br>
                    <strong>Gerhard Popp</strong>, {{ $contact['address']['street'] }}, {{ $contact['address']['postal_code'] }} {{ $contact['address']['city'] }}.
                </p>
                <p>
                    Grundlegende Richtung (Blattlinie): Präsentation der B2B-Videoproduktion von OfficeTalk sowie redaktionelle Information zu Format, Prozess, Preismodell und Referenzen.
                </p>

                <h2>Online-Streitbeilegung</h2>
                <p>
                    Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer">ec.europa.eu/consumers/odr</a>. Die Leistungen von OfficeTalk richten sich ausschließlich an Unternehmer im Sinne des § 1 Abs. 1 Z 1 UGB; an einem Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle nehmen wir nicht teil.
                </p>

                <h2>Urheberrecht</h2>
                <p>
                    Sämtliche auf dieser Website veröffentlichten Inhalte (Texte, Bilder, Videos, Grafiken, Layout, Quellcode) sind urheberrechtlich geschützt. Jede Verwertung außerhalb der durch das Urheberrecht gesetzten engen Grenzen ist ohne Zustimmung des Medieninhabers unzulässig.
                </p>

                <h2>Haftung für Inhalte und Links</h2>
                <p>
                    Die Inhalte dieser Website werden mit größter Sorgfalt erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte wird jedoch keine Gewähr übernommen. Für verlinkte externe Inhalte ist stets der jeweilige Anbieter oder Betreiber der verlinkten Seiten verantwortlich.
                </p>
            </div>

            {{-- Rücksprung --}}
            <div class="mt-s7">
                <a
                    href="{{ route('officetalk.landing') }}"
                    class="inline-flex items-center gap-s2 bg-accent px-s4 py-s3 font-sans text-body font-semibold text-[#111] transition-colors duration-200 hover:bg-[#111] hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                >
                    Zurück zur Startseite
                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M 1 6 L 16 6" />
                        <path d="M 11 1 L 16 6 L 11 11" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>
