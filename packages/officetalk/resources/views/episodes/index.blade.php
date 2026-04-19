<x-officetalk::layouts.app
    title="Alle Folgen – OfficeTalk"
    metaDescription="Archiv aller OfficeTalk-Episoden. Interviews mit Entscheidern der Wiener Immobilien- und Beratungsbranche."
>
    <section class="bg-bg py-s6">
        <div class="container">
            <x-officetalk::eyebrow>Archiv</x-officetalk::eyebrow>
            <h1 class="mt-s2 font-display text-h1 font-medium text-ink">Alle Folgen</h1>
            <p class="mt-s3 font-sans text-lead text-muted max-w-measure">
                Gespräche mit Führungskräften der Immobilien-, Bau-, PropTech- und Beratungsbranche. Interviewer: Walter Senk.
            </p>
        </div>
    </section>

    <section class="bg-bg pb-s7">
        <div class="container">
            <livewire:officetalk.episode-archive />
        </div>
    </section>
</x-officetalk::layouts.app>
