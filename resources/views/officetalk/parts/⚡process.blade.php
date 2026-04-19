<?php

use Livewire\Component;

new class extends Component {};
?>

<section class="bg-bg py-s6" id="prozess">
    <div class="container">
        <div class="mb-s5 max-w-measure">
            <x-officetalk::eyebrow>Ablauf</x-officetalk::eyebrow>
            <h2 class="mt-s2 font-display text-h2 font-medium text-ink">
                Von der Themenabstimmung bis zur Publikation.
            </h2>
        </div>

        <ol class="grid gap-s5 md:grid-cols-5">
            <li>
                <p class="font-display text-5xl font-medium text-accent">01</p>
                <h3 class="mt-s2 font-display text-h4 font-medium text-ink">Themen-Briefing</h3>
                <p class="mt-s1 font-sans text-meta text-muted">60 Minuten, Videocall</p>
                <p class="mt-s2 font-sans text-body text-muted">
                    Wir klären gemeinsam, welches Thema für Ihr Unternehmen und den Zeitpunkt relevant ist.
                </p>
            </li>
            <li>
                <p class="font-display text-5xl font-medium text-accent">02</p>
                <h3 class="mt-s2 font-display text-h4 font-medium text-ink">Redaktionelle Fragen</h3>
                <p class="mt-s1 font-sans text-meta text-muted">1 Woche</p>
                <p class="mt-s2 font-sans text-body text-muted">
                    Walter Senk erstellt sechs bis acht Kernfragen auf Basis des Briefings. Sie sehen sie vor dem Dreh.
                </p>
            </li>
            <li>
                <p class="font-display text-5xl font-medium text-accent">03</p>
                <h3 class="mt-s2 font-display text-h4 font-medium text-ink">Drehtag im Büro</h3>
                <p class="mt-s1 font-sans text-meta text-muted">2–3 Stunden</p>
                <p class="mt-s2 font-sans text-body text-muted">
                    Zwei-Kamera-Setup, Lavalier-Ton, natürliches Licht. Wir drehen in Ihrem Büro, nicht im Studio.
                </p>
            </li>
            <li>
                <p class="font-display text-5xl font-medium text-accent">04</p>
                <h3 class="mt-s2 font-display text-h4 font-medium text-ink">Journalistischer Schnitt</h3>
                <p class="mt-s1 font-sans text-meta text-muted">1 Woche</p>
                <p class="mt-s2 font-sans text-body text-muted">
                    Keine Abnahmeschleifen durch die Marketing-Abteilung. Untertitel und Farbkorrektur inklusive.
                </p>
            </li>
            <li>
                <p class="font-display text-5xl font-medium text-accent">05</p>
                <h3 class="mt-s2 font-display text-h4 font-medium text-ink">Publikation</h3>
                <p class="mt-s1 font-sans text-meta text-muted">Tag X</p>
                <p class="mt-s2 font-sans text-body text-muted">
                    immobilien-redaktion.com, LinkedIn (Senk und Redaktion), Spotify-Podcast. Sie erhalten die Dateien zur eigenen Nutzung.
                </p>
            </li>
        </ol>
    </div>
</section>
