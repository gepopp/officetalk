<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    |
    | Prefix und Middleware-Stack der OfficeTalk-Routen. Bei Bedarf im Host-
    | Projekt via .env überschreiben. Deutsche URL-Segmente sind bewusst
    | gewählt – die Zielgruppe ist österreichisch.
    |
    */

    'routes' => [
        'enabled' => env('OFFICETALK_ROUTES_ENABLED', true),
        'prefix' => env('OFFICETALK_ROUTES_PREFIX', 'officetalk'),
        'middleware' => ['web'],
        'segments' => [
            'episodes' => 'folgen',
            'guests' => 'gaeste',
            'topics' => 'themen',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Medien und CDN
    |--------------------------------------------------------------------------
    |
    | Die Plattform liefert Stills, Portraits und Thumbnails über DigitalOcean
    | Spaces aus. Der Disk-Name entspricht der Filesystems-Konfiguration des
    | Host-Projekts.
    |
    */

    'media' => [
        'disk' => env('OFFICETALK_MEDIA_DISK', 'spaces'),
        'cdn_base' => env('OFFICETALK_CDN_BASE', 'https://cdn.immobilien-redaktion.com'),
        'paths' => [
            'stills' => 'officetalk/stills',
            'portraits' => 'officetalk/portraits',
            'thumbnails' => 'officetalk/thumbnails',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Video-Provider
    |--------------------------------------------------------------------------
    |
    | Vimeo ist die Primärquelle aus Tracking- und Markengründen. LinkedIn-
    | Native-Videos werden nur als Sekundär-Link referenziert.
    |
    */

    'video' => [
        'provider' => 'vimeo',
        'vimeo' => [
            'player_url' => 'https://player.vimeo.com/video/',
            'default_params' => [
                'title' => 0,
                'byline' => 0,
                'portrait' => 0,
                'dnt' => 1,
                'texttrack' => 'de',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Redaktion
    |--------------------------------------------------------------------------
    |
    | Feste Daten, die auf Meta-Tags, Schema.org-Markup und Impressum
    | durchschlagen.
    |
    */

    'redaktion' => [
        'interviewer' => 'Walter Senk',
        'interviewer_url' => 'https://immobilien-redaktion.com/user/walter-senk',
        'produzent' => 'Gerhard Popp',
        'publisher' => 'Die unabhängige Immobilien Redaktion',
        'publisher_url' => 'https://immobilien-redaktion.com',
        'contact_email' => env('OFFICETALK_CONTACT_EMAIL', 'redaktion@immobilien-redaktion.com'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    */

    'pagination' => [
        'episodes_per_page' => 12,
    ],

    /*
    |--------------------------------------------------------------------------
    | Topic-Vokabular
    |--------------------------------------------------------------------------
    |
    | Kuratiertes Tag-Vokabular. Neue Topics ausschliesslich über Admin-
    | Oberfläche. Kein Free-Tag.
    |
    */

    'topics' => [
        'esg', 'wohnbau', 'projektentwicklung', 'finanzierung', 'regulierung',
        'zinshaus', 'proptech', 'digitalisierung', 'nachhaltigkeit', 'ki',
        'mietrecht', 'transaktion', 'vermarktung', 'fachkraefte', 'baupolitik',
    ],

];
