# officetalk/officetalk

> Redaktionelles LinkedIn-Videointerview-Subsystem für `immobilien-redaktion.com`.
> Enthält Domain-Modelle, Blade-Komponenten, Routes, Livewire-Komponenten und AI-Guidelines für Laravel Boost und Claude Code.

**Stack:** Laravel 13 · PHP 8.3 · Livewire 3 · Tailwind 3.4+

---

## Was ist drin

- **Domain-Layer** – drei Eloquent-Modelle (`Episode`, `Guest`, `Topic`), vier Migrationen mit Tabellen-Präfix `officetalk_`, vier Controller, zwei Livewire-Komponenten.
- **UI-Layer** – fünf Blade-Komponenten, zwei Patterns (Nav, Footer), App-Layout, Landing-Page und vier weitere Seitentemplates.
- **Asset-Layer** – CSS-Tokens und -Animationen, JavaScript für Scroll-Progress, Nav-Shrink und Divider-Reveal, Tailwind-Preset mit semantischen Keys.
- **AI-Layer** – sieben Guidelines (Projekt-Kontext, Design-System, Content-Voice, Frontend-Konventionen, Domain-Modell, Accessibility, Performance/SEO) und drei Skills (Episode anlegen, SEO-Metadaten, Komponenten-Bau).

---

## Installation

### 1. Paket einbinden

Wenn das Paket lokal unter `packages/officetalk/` im Host-Projekt liegt:

```bash
# Einmalig im Host-Projekt registrieren
composer config repositories.officetalk path packages/officetalk

# Paket anfordern
composer require officetalk/officetalk:@dev
```

Alternativ via Git-Repository:

```bash
composer config repositories.officetalk vcs git@github.com:officetalk/officetalk.git
composer require officetalk/officetalk:^0.1
```

Der Service Provider registriert sich automatisch über Laravels Package-Discovery.

### 2. Assets und Konfiguration publizieren

```bash
# Alles in einem Rutsch
php artisan vendor:publish --tag=officetalk

# Oder selektiv:
php artisan vendor:publish --tag=officetalk-config       # config/officetalk.php
php artisan vendor:publish --tag=officetalk-views        # resources/views/vendor/officetalk/
php artisan vendor:publish --tag=officetalk-assets       # resources/css|js/vendor/officetalk/
php artisan vendor:publish --tag=officetalk-tailwind     # tailwind.preset.officetalk.js
php artisan vendor:publish --tag=officetalk-guidelines   # .ai/guidelines/officetalk/
php artisan vendor:publish --tag=officetalk-skills       # .claude/skills/*
```

Guidelines und Skills werden beim nächsten `boost:update` automatisch von Laravel Boost erfasst und in die `CLAUDE.md` integriert.

### 3. Migrations ausführen

```bash
php artisan migrate
```

Vier Tabellen werden angelegt: `officetalk_topics`, `officetalk_guests`, `officetalk_episodes`, `officetalk_episode_topic`.

### 4. Topics seeden

```bash
php artisan tinker
```

```php
use Officetalk\Models\Topic;

$topics = [
    'esg' => 'ESG',
    'wohnbau' => 'Wohnbau',
    'projektentwicklung' => 'Projektentwicklung',
    'finanzierung' => 'Finanzierung',
    'regulierung' => 'Regulierung',
    'zinshaus' => 'Zinshaus',
    'proptech' => 'PropTech',
    'digitalisierung' => 'Digitalisierung',
    'nachhaltigkeit' => 'Nachhaltigkeit',
    'ki' => 'KI',
    'mietrecht' => 'Mietrecht',
    'transaktion' => 'Transaktion',
    'vermarktung' => 'Vermarktung',
    'fachkraefte' => 'Fachkräfte',
    'baupolitik' => 'Baupolitik',
];

foreach ($topics as $slug => $name) {
    Topic::firstOrCreate(['slug' => $slug], ['name' => $name]);
}
```

### 5. Tailwind-Preset einbinden

In `tailwind.config.js` des Host-Projekts:

```js
export default {
    presets: [require('./tailwind.preset.officetalk.js')],
    content: [
        './resources/**/*.blade.php',
        './vendor/officetalk/officetalk/resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],
};
```

### 6. Fonts und Assets

In `resources/css/app.css`:

```css
@import '../../vendor/officetalk/officetalk/resources/css/officetalk.css';
```

In `resources/js/app.js`:

```js
import '../../vendor/officetalk/officetalk/resources/js/officetalk.js';
```

Oder wenn Assets publiziert wurden:

```css
@import './vendor/officetalk/officetalk.css';
```

### 7. Routes prüfen

```bash
php artisan route:list --path=officetalk
```

Erwartete Routes:

| Name | URL |
|---|---|
| `officetalk.landing` | `/officetalk` |
| `officetalk.episodes.index` | `/officetalk/folgen` |
| `officetalk.episodes.show` | `/officetalk/folgen/{slug}` |
| `officetalk.guests.show` | `/officetalk/gaeste/{slug}` |
| `officetalk.topics.show` | `/officetalk/themen/{slug}` |

---

## Konfiguration

Nach `vendor:publish --tag=officetalk-config` liegt die Datei unter `config/officetalk.php`. Alle wichtigen Einstellungen sind via `.env` überschreibbar:

```env
OFFICETALK_ROUTES_ENABLED=true
OFFICETALK_ROUTES_PREFIX=officetalk
OFFICETALK_MEDIA_DISK=spaces
OFFICETALK_CDN_BASE=https://cdn.immobilien-redaktion.com
OFFICETALK_CONTACT_EMAIL=redaktion@immobilien-redaktion.com
```

---

## Nutzung

### Neue Episode anlegen

```php
use Officetalk\Models\Episode;
use Officetalk\Models\Guest;
use Officetalk\Models\Topic;

$guest = Guest::firstOrCreate(
    ['slug' => 'mueller-thomas'],
    [
        'first_name' => 'Thomas',
        'last_name' => 'Müller',
        'role' => 'CEO',
        'company' => 'BUWOG',
        'portrait' => 'officetalk/portraits/mueller-thomas.webp',
    ]
);

$episode = Episode::create([
    'number' => 47,
    'slug' => 'ep-047-mueller-esg-reporting',
    'title' => 'Was ESG-Reporting die Bauträger tatsächlich kostet',
    'abstract' => 'Thomas Müller (BUWOG) rechnet mit Walter Senk durch, was ESG-Reporting die Bauträger ab 2027 kostet. Zwischen 180.000 und 400.000 Euro pro Unternehmen.',
    'guest_id' => $guest->id,
    'vimeo_id' => '1234567890',
    'still_landscape' => 'officetalk/stills/ep-047-landscape.webp',
    'duration_minutes' => 28,
    'published_at' => now(),
    'is_featured' => true,
]);

$episode->topics()->sync(Topic::whereIn('slug', ['esg', 'regulierung'])->pluck('id'));
```

### Blade-Komponenten verwenden

```blade
<x-officetalk::layouts.app title="Titel" :metaDescription="$description">

    <x-officetalk::button variant="primary" icon="koffer" :href="route('...')">
        Folge ansehen
    </x-officetalk::button>

    <x-officetalk::video-card :episode="$episode" layout="split" />

    <x-officetalk::pullquote author="Walter Senk">
        OfficeTalk ist kein Imagefilm-Anbieter.
    </x-officetalk::pullquote>

</x-officetalk::layouts.app>
```

### Livewire-Komponenten verwenden

```blade
<livewire:officetalk.episode-archive />
<livewire:officetalk.contact-form />
```

---

## Integration mit Laravel Boost und Claude Code

Nach `vendor:publish --tag=officetalk-guidelines` und `--tag=officetalk-skills` erkennt Boost beim nächsten Lauf die neuen Dateien:

```bash
php artisan boost:update
```

**Was passiert:**

- Guidelines unter `.ai/guidelines/officetalk/*` werden in die `CLAUDE.md` des Host-Projekts aufgenommen und bei jedem Turn in den Claude-Code-Kontext geladen.
- Skills unter `.claude/skills/*` sind on-demand verfügbar – Claude Code aktiviert sie nur, wenn die Task-Beschreibung semantisch matcht (z. B. „neue Episode anlegen" → `create-episode`-Skill).

**MCP-Ergänzung empfehlen:**

Für Dritt-Package-Dokumentation über den Laravel-Ökosystem hinaus:

```bash
claude mcp add context7 -- npx -y @upstash/context7-mcp@latest
```

---

## Testing

```bash
composer install
composer test
```

Die Test-Suite nutzt Orchestra Testbench mit SQLite in-memory und Pest 3.

---

## Dateistruktur

```
officetalk/
├── composer.json
├── README.md
├── LICENSE
├── CHANGELOG.md
├── pint.json
├── phpunit.xml
├── testbench.yaml
│
├── config/
│   └── officetalk.php
│
├── database/
│   ├── migrations/
│   │   ├── ...000000_create_officetalk_topics_table.php
│   │   ├── ...000001_create_officetalk_guests_table.php
│   │   ├── ...000002_create_officetalk_episodes_table.php
│   │   └── ...000003_create_officetalk_episode_topic_table.php
│   └── factories/
│       ├── EpisodeFactory.php
│       ├── GuestFactory.php
│       └── TopicFactory.php
│
├── resources/
│   ├── css/officetalk.css
│   ├── js/officetalk.js
│   └── views/
│       ├── components/
│       │   ├── ui/         → button, eyebrow, logo-mark, pullquote
│       │   ├── patterns/   → nav, footer, video-card
│       │   └── layouts/    → app
│       ├── livewire/       → contact-form, episode-archive
│       ├── episodes/       → index, show
│       ├── guests/show.blade.php
│       ├── topics/show.blade.php
│       └── landing.blade.php
│
├── routes/
│   └── web.php
│
├── src/
│   ├── OfficetalkServiceProvider.php
│   ├── Models/             → Episode, Guest, Topic
│   ├── Http/
│   │   ├── Controllers/    → LandingController, EpisodeController, GuestController, TopicController
│   │   └── Livewire/       → EpisodeArchive, ContactForm
│   ├── View/Components/    → Button, VideoCard, Pullquote, Eyebrow, LogoMark
│   └── Support/CdnUrl.php
│
├── stubs/
│   ├── tailwind.preset.js
│   ├── ai/guidelines/      → 7 Guidelines für Boost
│   └── claude/skills/      → 3 Skills für Claude Code
│
└── tests/
    ├── Pest.php
    ├── TestCase.php
    └── Feature/EpisodeTest.php
```

---

## Support

Bei Fragen: [redaktion@immobilien-redaktion.com](mailto:redaktion@immobilien-redaktion.com)

## Lizenz

Proprietär. Siehe [LICENSE](LICENSE).
