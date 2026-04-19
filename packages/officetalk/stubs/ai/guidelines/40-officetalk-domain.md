# OfficeTalk Domain – Entitäten, CMS, Routing

Diese Datei beschreibt das Datenmodell und die Geschäftslogik. Referenz für Migrations, Models, Controller, Livewire-Komponenten und Routen.

## Drei Modelle

Alle Modelle leben im Namespace `Officetalk\Models\` mit Tabellen-Präfix `officetalk_`.

### Episode

```
id                   bigint primary
number               unsigned int unique     // 1, 2, 3, ...
slug                 string unique           // ep-047-ulreich-bautraegertag
title                string                  // Hauptclaim der Folge
eyebrow              string nullable         // Override Meta-Eyebrow
abstract             text                    // 2–3 Sätze, SEO-relevant
lead_quote           text nullable           // Pullquote für Hero
guest_id             foreign → officetalk_guests
vimeo_id             string nullable
linkedin_url         string nullable
spotify_url          string nullable
transcript_markdown  longtext nullable       // Vollständiges Transkript
still_landscape      string                  // CDN-Pfad 16:9
still_square         string nullable         // CDN-Pfad 1:1
thumbnail_linkedin   string nullable         // LinkedIn-optimiert
duration_minutes     unsigned smallint nullable
published_at         datetime nullable
is_featured          boolean default false   // Hero-Slot
meta_title           string nullable
meta_description     string nullable
```

#### Accessoren

- `$episode->episode_label` → `OfficeTalk #047`
- `$episode->still_landscape_url` → absolute CDN-URL
- `$episode->still_square_url` → absolute CDN-URL oder null
- `$episode->resolved_meta_title` → Override oder Default
- `$episode->resolved_meta_description` → Override oder gekürzter Abstract
- `$episode->vimeoEmbedUrl()` → Vimeo-Player-URL mit Tracking-Opt-out-Parametern

#### Scopes

- `Episode::published()` → `published_at <= now() AND not null`
- `Episode::featured()` → `is_featured = true`

#### Route Key

`slug` (nicht `id`). Route-Model-Binding nutzt `{episode:slug}`.

### Guest

```
id                   bigint primary
slug                 string unique           // mueller-thomas
first_name           string
last_name            string
role                 string                  // CEO, Head of Marketing, etc.
company              string
company_url          string nullable
linkedin_url         string nullable
portrait             string                  // CDN-Pfad 1:1 (1200×1200)
bio_short            text nullable
bio_long             text nullable
```

#### Accessoren

- `$guest->full_name` → `first_name last_name`
- `$guest->role_line` → `CEO, BUWOG`

### Topic

```
id                   bigint primary
slug                 string unique
name                 string                  // "ESG", "Wohnbau", ...
description          text nullable
```

Pivot: `officetalk_episode_topic` mit `episode_id`, `topic_id`.

## Kuratiertes Topic-Vokabular

Keine Free-Tags. Topics werden via Seeder/Admin gepflegt. Startvokabular aus `config('officetalk.topics')`:

```
esg, wohnbau, projektentwicklung, finanzierung, regulierung,
zinshaus, proptech, digitalisierung, nachhaltigkeit, ki,
mietrecht, transaktion, vermarktung, fachkraefte, baupolitik
```

Neue Topics nur via Admin-Oberfläche, nicht via User-Input. Bei Bedarf neue Slugs erst im Vokabular ergänzen, dann per Seeder in die Datenbank.

## Routing

Alle Routes unter dem Prefix aus `config('officetalk.routes.prefix')` (Default: `officetalk`).

| Route-Name | URL-Pattern | Controller |
|---|---|---|
| `officetalk.landing` | `/officetalk` | `LandingController@__invoke` |
| `officetalk.episodes.index` | `/officetalk/folgen` | `EpisodeController@index` |
| `officetalk.episodes.show` | `/officetalk/folgen/{episode:slug}` | `EpisodeController@show` |
| `officetalk.guests.show` | `/officetalk/gaeste/{guest:slug}` | `GuestController@show` |
| `officetalk.topics.show` | `/officetalk/themen/{topic:slug}` | `TopicController@show` |

URL-Sprache deutsch (`folgen`, `gaeste`, `themen`). Zielgruppe ist österreichisch.

## Medien-Pfade

CDN-Struktur auf DigitalOcean Spaces (Config: `officetalk.media.paths`):

- `officetalk/stills/ep-047-landscape.webp`
- `officetalk/stills/ep-047-square.webp`
- `officetalk/portraits/mueller-thomas.webp`
- `officetalk/thumbnails/ep-047-linkedin.webp`

In der DB werden **relative Pfade** gespeichert, nicht absolute URLs. Die Umwandlung macht `CdnUrl::for($path)` bzw. die Accessoren auf den Modellen.

## Publication Workflow

Eine Episode durchläuft drei Zustände:

1. **Draft** – `published_at = null`, nicht öffentlich. Ausschließlich für die Redaktion sichtbar.
2. **Scheduled** – `published_at` in der Zukunft. Route zeigt 404.
3. **Published** – `published_at <= now()`. Öffentlich erreichbar, in Archiven gelistet.

Der `Episode::published()`-Scope filtert auf beide Bedingungen. Controller `show()` muss zusätzlich `abort_unless($episode->published_at?->isPast(), 404)` prüfen, weil Route-Model-Binding den Scope nicht automatisch anwendet.

## Was in neuen Controllers zu beachten ist

- `with(['guest', 'topics'])` eager loaden – N+1 vermeiden.
- Published-Scope bei jeder Episode-Abfrage in öffentlichen Controllern.
- Views immer mit `officetalk::`-Prefix referenzieren.
- Breadcrumbs folgen der Route-Hierarchie: Start → Folgen → Einzelfolge.

## Schema.org-Markup

Auf jeder Episode-Detailseite wird ein `VideoObject`-Schema als JSON-LD ausgeliefert. Template in `resources/views/episodes/show.blade.php`. Pflichtfelder: `name`, `description`, `thumbnailUrl`, `uploadDate`, `embedUrl`, `publisher`, `interviewer`, `about`.

Auf der Landingpage wird ein `WebSite`-Schema plus `Organization`-Schema empfohlen (offen).

## Migrations-Reihenfolge

Bei `php artisan migrate` werden die Tabellen in dieser Reihenfolge angelegt:

1. `officetalk_topics`
2. `officetalk_guests`
3. `officetalk_episodes` (mit FK auf guests)
4. `officetalk_episode_topic` (Pivot)

Die Timestamps in den Dateinamen stellen das sicher. Bei neuen Migrations die Reihenfolge beachten – Fremdschlüssel erfordern existierende Target-Tabellen.
