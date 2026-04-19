<?php

use Livewire\Component;

new class extends Component {};
?>

<section class="bg-surface pt-s7 pb-s5" id="kontakt">
    <div class="container">
        <div class="mb-s5 max-w-measure">
            <x-officetalk::eyebrow>Kontakt</x-officetalk::eyebrow>
            <h2 class="mt-s2 font-display text-h2 font-medium text-ink">
                Wir melden uns innerhalb von zwei Arbeitstagen.
            </h2>
            <p class="mt-s3 font-sans text-lead text-muted">
                Schreiben Sie uns eine kurze Nachricht. Drei Informationen reichen: Thema, Zeitrahmen, Ansprechpartner.
            </p>
        </div>

        <livewire:officetalk.contact-form />
    </div>
</section>
