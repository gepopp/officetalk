<?php

return [
    'title' => 'Cookies auf officetalk.watch',
    'intro' => 'Wir nutzen notwendige Cookies, um die Website zu betreiben, und – nur nach Ihrer Einwilligung – einen anonymisierten Google-Analytics-Zähler für die Reichweitenmessung.',
    'link' => 'Details in der <a href=":url">Datenschutzerklärung</a>.',

    'essentials' => 'Nur notwendige',
    'all' => 'Alle akzeptieren',
    'customize' => 'Einstellungen anpassen',
    'manage' => 'Cookie-Einstellungen',
    'details' => [
        'more' => 'Mehr Details',
        'less' => 'Weniger Details',
    ],
    'save' => 'Auswahl speichern',

    'categories' => [
        'essentials' => [
            'title' => 'Notwendig',
            'description' => 'Für den Betrieb der Website unverzichtbar. Diese Cookies speichern Ihre Consent-Entscheidung, sichern Formulare gegen CSRF-Angriffe und halten Ihre Session. Ohne sie funktioniert die Seite nicht – daher kein Opt-out.',
        ],
        'analytics' => [
            'title' => 'Analyse',
            'description' => 'Anonymisierte Reichweitenmessung via Google Analytics 4. Zeigt uns, welche Inhalte funktionieren. IP-Adressen werden gekürzt, keine Werbeprofile, keine Weitergabe an Dritte.',
        ],
        'optional' => [
            'title' => 'Optional',
            'description' => 'Komfort-Cookies für zusätzliche Funktionen. Werden aktuell nicht gesetzt.',
        ],
    ],

    'defaults' => [
        'consent' => 'Speichert Ihre Consent-Entscheidung, damit das Banner nicht bei jedem Besuch erneut erscheint.',
        'session' => 'Identifiziert Ihre Browsing-Session, damit Seiten-Zustände (z. B. geöffnete Modals) erhalten bleiben.',
        'csrf' => 'Schützt Formulare gegen Cross-Site-Request-Forgery-Angriffe (z. B. das Kontaktformular).',
        '_ga' => 'Unterscheidet anonymisiert Besucher voneinander (Google Analytics 4).',
        '_ga_ID' => 'Hält den Session-Zustand in Google Analytics 4 (properties-spezifisch).',
        '_gid' => 'Identifiziert den Nutzer für Google Analytics – wird in GA4 nicht mehr gesetzt, ist aber als Legacy-Cookie aufgeführt.',
        '_gat' => 'Drosselt die Abfragerate von Google Analytics bei hohem Traffic.',
    ],
];
