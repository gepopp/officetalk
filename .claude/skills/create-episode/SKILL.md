---
name: create-episode
description: "Use this skill when the user wants to add a new OfficeTalk episode to the database, or create any of the assets that go with a new episode. Triggers include: 'neue Folge', 'Episode anlegen', 'OfficeTalk mit [Gast] dokumentieren', 'Folge #047 erstellen', 'Interview mit [Name] in die DB eintragen', 'Transkript einpflegen'. Use this whenever the input mentions creating/adding/publishing an OfficeTalk episode or when there's talk of a new guest with video material. Do NOT use for editing existing episodes (that's plain CRUD) or for creating unrelated Laravel models."
---

# Skill: Neue OfficeTalk-Episode anlegen

## Wann diese Skill greift

Der User bittet darum, eine neue Folge anzulegen, ein Interview in die Plattform einzupflegen, oder die vollständige Veröffentlichung einer Episode vorzubereiten. Das umfasst Datenbank-Eintrag, Asset-Placement, SEO-Metadaten und Publikations-Vorbereitung.

## Ablauf

Acht Schritte, in dieser Reihenfolge.

### 1. Kontext klären

Frage nach, falls nicht offensichtlich:

- Episodennummer? (sollte fortlaufend sein – letzte Nummer via Boost-MCP `tinker` prüfen: `Officetalk\Models\Episode::max('number')`)
- Gast-Name, Rolle, Unternehmen?
- Existiert der Gast bereits in `officetalk_guests`? Falls ja, `guest_id` nutzen, nicht neuen Eintrag erzeugen.
- Drehdatum und geplantes Publikationsdatum?
- Themen-Tags aus kuratiertem Vokabular (`config('officetalk.topics')`)?

### 2. Datei-Assets prüfen

Vor dem DB-Eintrag müssen die Assets auf dem CDN liegen:

- **Still Landscape:** `officetalk/stills/ep-{nummer}-landscape.webp` (1920×1080, WebP Q80)
- **Still Square:** `officetalk/stills/ep-{nummer}-square.webp` (1200×1200, WebP Q80)
- **LinkedIn-Thumbnail:** `officetalk/thumbnails/ep-{nummer}-linkedin.webp`
- **Gast-Portrait** (wenn Gast neu): `officetalk/portraits/{guest-slug}.webp`

Wenn Assets fehlen: User fragen, wo sie liegen. Nicht erfinden, nicht raten.

### 3. Slug erzeugen

Nach Schema `ep-{nummer}-{gast-nachname}-{thema-kurz}`. Beispiele:

- `ep-047-mueller-esg-reporting`
- `ep-048-ulreich-bautraegertag-2026`

Regeln (siehe `20-content-voice.md`):

- Kebab-case
- Keine Umlaute (`ae oe ue ss`)
- Nummer immer 3-stellig mit führenden Nullen

### 4. Guest anlegen (falls neu)

```php
use Officetalk\Models\Guest;

$guest = Guest::create([
    'slug' => 'mueller-thomas',
    'first_name' => 'Thomas',
    'last_name' => 'Müller',
    'role' => 'CEO',
    'company' => 'BUWOG',
    'company_url' => 'https://buwog.com',
    'linkedin_url' => 'https://linkedin.com/in/...',
    'portrait' => 'officetalk/portraits/mueller-thomas.webp',
    'bio_short' => '...',
    'bio_long' => '...',
]);
```

Bio im Senk-Duktus schreiben (siehe `20-content-voice.md`). Kurze, aktive Sätze. Keine Marketingsprache.

### 5. Topics zuordnen

Nur Slugs aus `config('officetalk.topics')` verwenden. Falls ein passendes Topic fehlt: zuerst Seeder erweitern und Migration für das neue Topic schreiben, nicht on-the-fly erstellen.

```php
use Officetalk\Models\Topic;

$topicIds = Topic::whereIn('slug', ['esg', 'regulierung'])->pluck('id');
```

### 6. Episode anlegen

```php
use Officetalk\Models\Episode;

$episode = Episode::create([
    'number' => 47,
    'slug' => 'ep-047-mueller-esg-reporting',
    'title' => 'Was ESG-Reporting den Bauträgern 2026 tatsächlich kostet',
    'eyebrow' => null, // nur overrides, sonst auto
    'abstract' => '...', // 2–3 Sätze, lead-first, siehe 20-content-voice.md
    'lead_quote' => '...', // optional, Hero-Zitat
    'guest_id' => $guest->id,
    'vimeo_id' => '1234567890',
    'linkedin_url' => 'https://www.linkedin.com/feed/update/...',
    'spotify_url' => null,
    'still_landscape' => 'officetalk/stills/ep-047-landscape.webp',
    'still_square' => 'officetalk/stills/ep-047-square.webp',
    'thumbnail_linkedin' => 'officetalk/thumbnails/ep-047-linkedin.webp',
    'duration_minutes' => 28,
    'published_at' => '2026-04-22 07:30:00',
    'is_featured' => true, // nur die aktuellste soll featured sein
]);

$episode->topics()->attach($topicIds);
```

### 7. Featured-Rotation

Nur **eine** Episode darf `is_featured = true` haben (Hero-Slot). Beim Neuanlegen die bisher-featured Episode unflaggen:

```php
Episode::where('is_featured', true)
    ->whereKeyNot($episode->id)
    ->update(['is_featured' => false]);
```

### 8. Validierung

Nach dem Anlegen prüfen:

- `php artisan tinker` → `Officetalk\Models\Episode::latest()->first()->load('guest', 'topics')` – stimmen die Relationen?
- Im Browser die Episoden-Detailseite öffnen und Schema.org JSON-LD checken (Google Rich Results Test).
- LinkedIn-Thumbnail im LinkedIn Post Inspector testen.
- OG-Image im Facebook Debugger testen.

## Abstract-Vorlage

Wenn der Abstract fehlt, im Senk-Stil nach diesem Muster:

```
[Wer] diskutiert mit Walter Senk [was], [wichtiger Kontext in einem Nebensatz]. 
[Konkrete Zahl oder konkreter Beleg aus dem Gespräch]. 
[Optional: eine These oder Kern-Aussage des Gastes.]
```

Beispiel: „Thomas Müller (BUWOG) rechnet mit Walter Senk durch, was die ESG-Reporting-Pflicht die österreichischen Bauträger ab 2027 tatsächlich kostet. Zwischen 180.000 und 400.000 Euro pro Unternehmen, schätzt der CEO. Wer früh standardisiert, spart sechsstellig."

## Typische Fehler

- Featured-Flag vergessen umzuschalten → zwei Episoden gleichzeitig featured.
- Slug mit Umlauten → URL-Brüche.
- Abstract über 240 Zeichen → Meta-Description wird gekürzt und wirkt abgebrochen.
- Portrait-Pfad absolute URL statt relativer CDN-Pfad → CdnUrl-Helper verdoppelt Basis.
- Drehdatum statt Publikationsdatum in `published_at` → falsche Sortierung im Archiv.
- Free-Tag-Topic erfunden, das nicht in `config('officetalk.topics')` existiert.
