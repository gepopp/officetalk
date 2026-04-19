<?php

use Livewire\Component;

new class extends Component {};
?>

<section class="bg-bg py-s6" id="redaktion">
    <div class="container">
        <div class="mb-s5 max-w-measure">
            <x-officetalk::eyebrow>Redaktion</x-officetalk::eyebrow>
            <h2 class="mt-s2 font-display text-h2 font-medium text-ink">
                Walter Senk und Gerhard Popp.
            </h2>
        </div>

        <div class="grid gap-s5 md:grid-cols-2">
            <article class="rounded border border-line bg-surface p-s5">
                <h3 class="font-display text-h3 font-medium text-ink">Walter Senk</h3>
                <p class="mt-s1 font-sans text-meta text-muted">Interview · Redaktion</p>
                <p class="mt-s3 font-sans text-body text-ink">
                    Fachjournalist für die österreichische Immobilienbranche seit 2010. Betreiber der Plattform
                    <a href="{{ config('officetalk.redaktion.publisher_url') }}" class="officetalk-link">immobilien-redaktion.com</a>.
                    Regelmäßiger Autor für Immobilien Magazin, Der Standard und Die Presse. Stimme im FSM Immo-Podcast.
                </p>
            </article>

            <article class="rounded border border-line bg-surface p-s5">
                <h3 class="font-display text-h3 font-medium text-ink">Gerhard Popp</h3>
                <p class="mt-s1 font-sans text-meta text-muted">Produktion · Kamera · Schnitt</p>
                <p class="mt-s3 font-sans text-body text-ink">
                    Publisher von immobilien-redaktion.com. Produzent der Formate OfficeTalk, IMMOLIVE und Immo Voices. Verantwortlich für Kamera, Schnitt und Publikation aller Videoproduktionen der Plattform.
                </p>
            </article>
        </div>
    </div>
</section>
