<?php

declare(strict_types=1);

namespace App\Providers;

use Whitecube\LaravelCookieConsent\CookiesServiceProvider as ServiceProvider;
use Whitecube\LaravelCookieConsent\Facades\Cookies;

class CookiesServiceProvider extends ServiceProvider
{
    /**
     * Definiert, welche Cookies auf officetalk.watch gesetzt werden
     * und unter welcher Kategorie sie im Consent-Banner auftauchen.
     */
    protected function registerCookies(): void
    {
        // Laravel-Essentials: Session-Cookie + CSRF-Token.
        // Werden automatisch in die Kategorie „Notwendig" eingehängt und können nicht abgelehnt werden.
        Cookies::essentials()
            ->session()
            ->csrf();

        // Google Analytics 4 · lädt nur nach ausdrücklicher Einwilligung via Consent-Banner.
        // Die Shorthand-Methode registriert _ga, _ga_* und das gtag-Snippet und sorgt dafür,
        // dass der Tracker nie vor Consent loadet.
        if (config('cookieconsent.google_analytics.id')) {
            Cookies::analytics()
                ->google(
                    id: config('cookieconsent.google_analytics.id'),
                    anonymizeIp: config('cookieconsent.google_analytics.anonymize_ip'),
                );
        }
    }
}
