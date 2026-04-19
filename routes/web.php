<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Officetalk\Http\Controllers\EpisodeController;
use Officetalk\Http\Controllers\GuestController;
use Officetalk\Http\Controllers\TopicController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

$segments = config('officetalk.routes.segments', [
    'episodes' => 'folgen',
    'guests' => 'gaeste',
    'topics' => 'themen',
]);

Route::name('officetalk.')->group(function () use ($segments): void {
    Route::livewire('/', 'officetalk::landing')->name('landing');

    Route::get($segments['episodes'], [EpisodeController::class, 'index'])
        ->name('episodes.index');

    Route::get($segments['episodes'].'/{episode:slug}', [EpisodeController::class, 'show'])
        ->name('episodes.show');

    Route::get($segments['guests'].'/{guest:slug}', [GuestController::class, 'show'])
        ->name('guests.show');

    Route::get($segments['topics'].'/{topic:slug}', [TopicController::class, 'show'])
        ->name('topics.show');

    // Kontakt-Bestätigung · öffnet nach Klick im Confirmation-Mail, triggert Summary-Mail
    Route::livewire('kontakt/bestaetigen/{token}', 'officetalk::kontakt-bestaetigen')
        ->name('contact.confirm');

    // Pflicht-Links im Footer · Impressum, Datenschutzerklärung, AGB
    Route::name('legal.')->prefix('rechtliches')->group(function (): void {
        Route::livewire('impressum', 'officetalk::impressum')->name('impressum');
        Route::livewire('datenschutz', 'officetalk::datenschutz')->name('datenschutz');
        Route::livewire('agb', 'officetalk::agb')->name('agb');
    });
});

// Sitemap · dynamisch generiert, listet alle indexierbaren öffentlichen URLs.
// AGB + Kontakt-Bestätigung absichtlich ausgeschlossen (noindex bzw. transactional).
Route::get('/sitemap.xml', function () {
    return Sitemap::create()
        ->add(
            Url::create(route('officetalk.landing'))
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY),
        )
        ->add(
            Url::create(route('officetalk.legal.impressum'))
                ->setPriority(0.3)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY),
        )
        ->add(
            Url::create(route('officetalk.legal.datenschutz'))
                ->setPriority(0.3)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY),
        )
        ->toResponse(request());
})->name('sitemap');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
