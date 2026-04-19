# Changelog

Alle nennenswerten Änderungen am Paket `officetalk/officetalk` werden in dieser Datei dokumentiert.

Das Format folgt [Keep a Changelog](https://keepachangelog.com/de/1.1.0/), und dieses Paket folgt [Semantic Versioning](https://semver.org/lang/de/).

## [Unreleased]

### Hinzugefügt

- Service Provider mit sieben publish-Tags (config, views, assets, tailwind, guidelines, skills, komplett)
- Drei Eloquent-Modelle: `Episode`, `Guest`, `Topic` mit Factories und Relationen
- Vier Migrationen für Topics, Guests, Episodes und Pivot-Tabelle
- Vier Controller: Landing, Episode, Guest, Topic mit deutschem URL-Schema
- Zwei Livewire-Komponenten: `EpisodeArchive` (Filter nach Topic und Suche), `ContactForm` (mit Honeypot)
- Fünf Blade-Komponenten: `button`, `video-card`, `pullquote`, `eyebrow`, `logo-mark`
- Zwei Pattern-Komponenten: `nav` (sticky mit Shrink-on-Scroll), `footer`
- App-Layout und vier Page-Views: Landing, Episoden-Index, Episoden-Detail, Gäste-Detail, Topic-Detail
- CSS-Tokens und -Animationen (`officetalk.css`)
- JavaScript für Scroll-Progress, Divider-Reveal, Nav-Shrink (`officetalk.js`)
- Tailwind-Preset mit semantischen Farb-, Typografie-, Spacing-Tokens
- Sieben AI-Guidelines für Laravel Boost und Claude Code
- Drei Agent Skills: `create-episode`, `seo-meta-for-episode`, `component-from-design-spec`
- Pest-Test-Setup mit Orchestra Testbench
- Feature-Test für Episode-Scopes, -Relationen, -Accessoren
- Pint-Config mit Strict-Types-Enforcement

## [0.1.0] – 2026-04-18

Initiale Version.
