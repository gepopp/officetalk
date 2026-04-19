<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Officetalk\Mail\ContactSummaryMail;
use Officetalk\Models\ContactRequest;

new
#[Layout('officetalk::components.layouts.app')]
#[Title('Anfrage bestätigt · OfficeTalk')]
class extends Component {
    public string $token = '';

    public ?ContactRequest $contactRequest = null;

    public bool $alreadyConfirmed = false;

    public bool $notFound = false;

    public function mount(string $token): void
    {
        $this->token = $token;

        $request = ContactRequest::query()
            ->where('confirmation_token', $token)
            ->first();

        if (! $request) {
            $this->notFound = true;
            return;
        }

        $this->contactRequest = $request;

        if ($request->isConfirmed()) {
            $this->alreadyConfirmed = true;
            return;
        }

        $request->markConfirmed();

        try {
            Mail::to($request->email, $request->contact_name)
                ->send(new ContactSummaryMail($request));

            $request->markSummarySent();
        } catch (\Throwable $e) {
            Log::error('OfficeTalk ContactSummaryMail fehlgeschlagen', [
                'id' => $request->id,
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);
        }
    }
};
?>

<x-slot:metaDescription>
    Ihre Kontaktanfrage an OfficeTalk ist bestätigt. Gerhard Popp meldet sich innerhalb von zwei Arbeitstagen.
</x-slot>

{{-- Transactional-Page · nicht indexieren, sichtbar nur mit gültigem Token --}}
<x-slot:robots>noindex, nofollow</x-slot>

<div>
    <section class="relative bg-bg py-s7">
        <div class="container max-w-[760px]">

            @if ($notFound)
                {{-- Token unbekannt / abgelaufen --}}
                <p class="font-sans text-eyebrow uppercase tracking-[0.12em] text-warning">
                    Bestätigung — Link nicht gültig
                </p>
                <h1 class="mt-s3 font-display text-h2 font-medium leading-tight text-balance text-ink">
                    Diesen Bestätigungs-Link kennen wir nicht.
                </h1>
                <p class="mt-s4 max-w-measure font-sans text-lead text-ink">
                    Möglicherweise ist der Link abgelaufen, wurde mehrfach geöffnet oder beim Kopieren abgeschnitten. Schreiben Sie uns direkt an <a href="mailto:gerhard@weloveinteraction.com" class="officetalk-link font-medium text-ink">gerhard@weloveinteraction.com</a> – wir kümmern uns um Ihre Anfrage manuell.
                </p>

                <div class="mt-s6 flex flex-wrap gap-s3">
                    <a
                        href="{{ route('officetalk.landing') }}"
                        class="inline-flex items-center gap-s2 bg-accent px-s4 py-s3 font-sans text-body font-semibold text-ink transition-colors duration-200 hover:bg-ink hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                    >
                        Zurück zur Startseite
                        <svg width="18" height="12" viewBox="0 0 18 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M 1 6 L 16 6" />
                            <path d="M 11 1 L 16 6 L 11 11" />
                        </svg>
                    </a>
                </div>
            @else
                {{-- Bestätigt (entweder jetzt frisch oder vorher schon) --}}
                <p class="font-sans text-eyebrow uppercase tracking-[0.12em] text-accent">
                    @if ($alreadyConfirmed)
                        Bestätigung — bereits erfolgt
                    @else
                        Bestätigung — erfolgreich
                    @endif
                </p>

                <h1 class="mt-s3 font-display text-h2 font-medium leading-tight text-balance text-ink">
                    Danke. Angekommen.
                </h1>

                <p class="mt-s4 max-w-measure font-sans text-lead text-ink">
                    @if ($alreadyConfirmed)
                        Ihre Anfrage ist bereits bestätigt und liegt uns vor. Gerhard Popp meldet sich innerhalb von zwei Arbeitstagen bei Ihnen — je nach Anlass per Mail oder Telefonat.
                    @else
                        Ihre E-Mail-Adresse ist bestätigt. Ihre Anfrage liegt jetzt bei Gerhard Popp. Er meldet sich innerhalb von zwei Arbeitstagen bei Ihnen — je nach Anlass per Mail oder Telefonat.
                    @endif
                </p>

                {{-- Mini-Zusammenfassung als Reassurance --}}
                @if ($contactRequest)
                    <div class="mt-s6 border-t-2 border-ink pt-s4">
                        <p class="font-sans text-eyebrow uppercase tracking-[0.08em] text-muted">
                            Ihre Anfrage
                        </p>
                        <dl class="mt-s3 grid gap-x-s5 gap-y-s3 md:grid-cols-[auto_1fr]">
                            <dt class="font-sans text-meta font-semibold uppercase tracking-[0.06em] text-muted">Ansprechperson</dt>
                            <dd class="font-sans text-body text-ink">{{ $contactRequest->contact_name }}</dd>

                            <dt class="font-sans text-meta font-semibold uppercase tracking-[0.06em] text-muted">E-Mail</dt>
                            <dd class="font-sans text-body text-ink">{{ $contactRequest->email }}</dd>

                            @if ($contactRequest->company !== '—')
                                <dt class="font-sans text-meta font-semibold uppercase tracking-[0.06em] text-muted">Unternehmen</dt>
                                <dd class="font-sans text-body text-ink">{{ $contactRequest->company }}</dd>
                            @endif

                            <dt class="font-sans text-meta font-semibold uppercase tracking-[0.06em] text-muted">Eingegangen</dt>
                            <dd class="font-sans text-body text-ink">
                                {{ $contactRequest->created_at?->timezone('Europe/Vienna')->format('d.m.Y · H:i') }} Uhr
                            </dd>
                        </dl>
                    </div>

                    <p class="mt-s5 font-display text-h4 italic text-muted">
                        @if (! $alreadyConfirmed)
                            Eine Zusammenfassung Ihrer Angaben ist gerade zusätzlich in Ihrem E-Mail-Postfach gelandet.
                        @endif
                    </p>
                @endif

                <div class="mt-s6 flex flex-wrap gap-s3">
                    <a
                        href="{{ route('officetalk.landing') }}"
                        class="inline-flex items-center gap-s2 bg-accent px-s4 py-s3 font-sans text-body font-semibold text-ink transition-colors duration-200 hover:bg-ink hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                    >
                        Zurück zur Startseite
                        <svg width="18" height="12" viewBox="0 0 18 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M 1 6 L 16 6" />
                            <path d="M 11 1 L 16 6 L 11 11" />
                        </svg>
                    </a>
                    <a
                        href="{{ route('officetalk.episodes.index') }}"
                        class="inline-flex items-center gap-s2 border border-ink bg-transparent px-s4 py-s3 font-sans text-body font-semibold text-ink transition-colors duration-200 hover:bg-ink hover:text-bg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ink"
                    >
                        Alle Folgen ansehen
                    </a>
                </div>
            @endif

        </div>
    </section>
</div>
