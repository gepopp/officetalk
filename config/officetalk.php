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
        'prefix' => env('OFFICETALK_ROUTES_PREFIX', ''),
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
            'tag' => env('OFFICETALK_VIMEO_TAG', 'officetalk'),
            'default_params' => [
                'title' => 0,
                'byline' => 0,
                'portrait' => 0,
                'dnt' => 1,
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
    | Kontakt-Daten (Footer)
    |--------------------------------------------------------------------------
    |
    | Zentrale Pflege der Footer-relevanten Pflichtangaben nach § 5 ECG und
    | § 14 UGB. Platzhalter in eckigen Klammern werden vor Go-Live befüllt.
    |
    */

    'contact' => [
        'legal_name' => 'Gerhard Popp',
        'brand_name' => 'OfficeTalk',
        'tagline' => 'B2B-Videoproduktion',
        'address' => [
            'street' => env('OFFICETALK_ADDRESS_STREET', 'Hasnerstrasse 18/12'),
            'postal_code' => env('OFFICETALK_ADDRESS_POSTAL_CODE', '1160'),
            'city' => env('OFFICETALK_ADDRESS_CITY', 'Wien'),
            'country' => env('OFFICETALK_ADDRESS_COUNTRY', 'Österreich'),
        ],
        'phone' => env('OFFICETALK_PHONE', '[Telefonnummer]'),
        'email' => env('OFFICETALK_EMAIL', 'gerhard@weloveinteraction.com'),
        'calendar_url' => env('OFFICETALK_CALENDAR_URL', '#'),
        'linkedin_url' => env('OFFICETALK_LINKEDIN_URL', 'https://www.linkedin.com/in/gerhardpopp/'),
        'partners' => [
            [
                'name' => 'Die unabhängige Immobilien Redaktion',
                'url' => 'https://immobilien-redaktion.com',
            ],
            [
                'name' => 'Bau & Immobilien Report',
                'url' => 'https://report.at',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO-Defaults
    |--------------------------------------------------------------------------
    |
    | Übergreifende SEO-Konfiguration für Meta-Tags, Open Graph, Twitter-Cards
    | und Schema.org-Organization-Entity. Pro-Seite-Overrides erfolgen via
    | x-slot in den Livewire-SFCs (seoTitle, metaDescription, ogImage, schema).
    |
    */

    'seo' => [
        'site_name' => 'OfficeTalk',
        'site_url' => env('APP_URL', 'https://www.officetalk.watch'),
        'locale' => 'de_AT',
        'twitter_handle' => env('OFFICETALK_TWITTER_HANDLE'),

        'default_image' => [
            'url' => '/distribution-parallax-image.jpg',
            'width' => 1920,
            'height' => 1080,
            'alt' => 'OfficeTalk – B2B-Videoproduktion in Wien, redaktionelle Distribution in Fachmedien',
        ],

        'organization' => [
            'description' => 'B2B-Videoproduktion in Wien für Immobilien, Bau, PropTech, Kanzleien, Architekturbüros und Steuerberatungen im DACH-Raum.',
            'logo' => '/images/logo/officetalk-logo.png',
            'founding_year' => 2024,
            'price_range' => '€€',
            'area_served' => ['Österreich', 'Deutschland', 'Schweiz'],
        ],

        'defaults' => [
            'robots' => env('OFFICETALK_SEO_ROBOTS', 'index, follow'),
            'og_type' => 'website',
            'twitter_card' => 'summary_large_image',
        ],
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
