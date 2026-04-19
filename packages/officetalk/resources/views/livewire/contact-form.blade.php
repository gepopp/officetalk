<div>
    @if ($submitted)
        <div class="rounded border-l-4 border-accent bg-surface p-s5">
            <h3 class="font-display text-h3 font-medium text-ink">Ein Klick noch.</h3>
            <p class="mt-s2 font-sans text-body text-ink">
                Wir haben Ihnen eine Bestätigungs-E-Mail geschickt. Bitte öffnen Sie die Mail und klicken auf <em class="font-display italic">„E-Mail-Adresse bestätigen"</em>. Danach geht Ihre Anfrage an Gerhard Popp.
            </p>
            <p class="mt-s3 font-sans text-meta text-muted">
                Prüfen Sie gegebenenfalls den Spam-Ordner. Kein Eingang? Schreiben Sie an <a href="mailto:gerhard@weloveinteraction.com" class="officetalk-link font-medium">gerhard@weloveinteraction.com</a>.
            </p>
        </div>
    @else
        <form wire:submit="submit" class="grid gap-s4 md:grid-cols-2">

            {{-- Honeypot, vor Screenreadern versteckt --}}
            <div aria-hidden="true" class="hidden">
                <label>
                    Website
                    <input type="text" wire:model="website" tabindex="-1" autocomplete="off">
                </label>
            </div>

            <div>
                <label for="company" class="block font-sans text-meta font-medium text-ink">
                    Ihr Unternehmen <span aria-hidden="true" class="text-accent">*</span>
                </label>
                <input
                    id="company"
                    type="text"
                    wire:model="company"
                    required
                    autocomplete="organization"
                    class="mt-s1 w-full rounded border border-line bg-bg px-s3 py-s2 font-sans text-body text-ink focus-visible:border-ink focus-visible:outline focus-visible:outline-3 focus-visible:outline-ink focus-visible:outline-offset-2"
                />
                @error('company') <p class="mt-s1 font-sans text-meta text-warning">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="contact_name" class="block font-sans text-meta font-medium text-ink">
                    Ansprechperson <span aria-hidden="true" class="text-accent">*</span>
                </label>
                <input
                    id="contact_name"
                    type="text"
                    wire:model="contact_name"
                    required
                    autocomplete="name"
                    class="mt-s1 w-full rounded border border-line bg-bg px-s3 py-s2 font-sans text-body text-ink focus-visible:border-ink focus-visible:outline focus-visible:outline-3 focus-visible:outline-ink focus-visible:outline-offset-2"
                />
                @error('contact_name') <p class="mt-s1 font-sans text-meta text-warning">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block font-sans text-meta font-medium text-ink">
                    E-Mail <span aria-hidden="true" class="text-accent">*</span>
                </label>
                <input
                    id="email"
                    type="email"
                    wire:model="email"
                    required
                    autocomplete="email"
                    class="mt-s1 w-full rounded border border-line bg-bg px-s3 py-s2 font-sans text-body text-ink focus-visible:border-ink focus-visible:outline focus-visible:outline-3 focus-visible:outline-ink focus-visible:outline-offset-2"
                />
                @error('email') <p class="mt-s1 font-sans text-meta text-warning">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="role" class="block font-sans text-meta font-medium text-ink">
                    Branche <span aria-hidden="true" class="text-accent">*</span>
                </label>
                <select
                    id="role"
                    wire:model="role"
                    required
                    class="mt-s1 w-full rounded border border-line bg-bg px-s3 py-s2 font-sans text-body text-ink focus-visible:border-ink focus-visible:outline focus-visible:outline-3 focus-visible:outline-ink focus-visible:outline-offset-2"
                >
                    <option value="">Bitte wählen</option>
                    <option value="bautraeger">Bauträger / Projektentwicklung</option>
                    <option value="immobilien-konzern">Immobilien-Konzern</option>
                    <option value="kanzlei">Kanzlei (Recht, Steuer, WP)</option>
                    <option value="architektur">Architektur / Planung</option>
                    <option value="proptech">PropTech</option>
                    <option value="sonstige">Sonstige</option>
                </select>
                @error('role') <p class="mt-s1 font-sans text-meta text-warning">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="occasion" class="block font-sans text-meta font-medium text-ink">
                    Anlass <span aria-hidden="true" class="text-accent">*</span>
                </label>
                <textarea
                    id="occasion"
                    wire:model="occasion"
                    rows="5"
                    required
                    placeholder="Worum geht es? Thema, geplanter Zeitpunkt, Besonderheiten."
                    class="mt-s1 w-full rounded border border-line bg-bg px-s3 py-s2 font-sans text-body text-ink placeholder:text-muted focus-visible:border-ink focus-visible:outline focus-visible:outline-3 focus-visible:outline-ink focus-visible:outline-offset-2"
                ></textarea>
                @error('occasion') <p class="mt-s1 font-sans text-meta text-warning">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="preferred_timing" class="block font-sans text-meta font-medium text-ink">
                    Wunschtermin (optional)
                </label>
                <input
                    id="preferred_timing"
                    type="text"
                    wire:model="preferred_timing"
                    placeholder="z. B. vor MIPIM 2026 oder KW 18"
                    class="mt-s1 w-full rounded border border-line bg-bg px-s3 py-s2 font-sans text-body text-ink placeholder:text-muted focus-visible:border-ink focus-visible:outline focus-visible:outline-3 focus-visible:outline-ink focus-visible:outline-offset-2"
                />
            </div>

            <div class="md:col-span-2">
                <x-officetalk::button
                    variant="primary"
                    icon="koffer"
                    type="submit"
                >
                    <span wire:loading.remove wire:target="submit">Anfrage absenden</span>
                    <span wire:loading wire:target="submit">Wird gesendet …</span>
                </x-officetalk::button>

                <p class="mt-s3 font-sans text-meta text-muted">
                    <span class="text-accent">*</span> Pflichtfelder. Mit dem Absenden erklären Sie sich mit der Kontaktaufnahme durch die Redaktion einverstanden.
                </p>
            </div>
        </form>
    @endif
</div>
