---
name: component-from-design-spec
description: "Use this skill when the user wants to build a new Blade component, Livewire component, or UI section for OfficeTalk based on a design specification. Triggers include: 'Komponente für X bauen', 'aus diesem Figma-Screen', 'neue Sektion für die Landingpage', 'Pullquote-Variante', 'FAQ-Accordion', 'Hero-Variante 2', 'Video-Card im Grid-Layout', or any request that mentions a visual spec plus the word 'Komponente/Component/Section'. Do NOT use for simple view file creation without design requirements, or for Livewire components that are pure business logic without UI."
---

# Skill: UI-Komponente aus Design-Spec bauen

## Wann diese Skill greift

Der User will eine neue UI-Einheit bauen – Blade-Komponente, Livewire-Komponente oder Sektion – auf Basis einer Design-Vorlage (Figma, Screenshot, textuelle Spec). Ziel ist eine produktions-reife Umsetzung mit Tokens, Varianten, Accessibility und Reduced-Motion.

## Ablauf

### 1. Spec interpretieren

Bevor Code geschrieben wird:

- **Was ist die Einheit?** Atom (Button, Eyebrow), Molecule (Video-Card, Pullquote), Organism (Hero, Episoden-Galerie)?
- **Ist sie wiederverwendbar?** Wenn ja: ins Paket unter `resources/views/components/{ui|patterns|sections}/`. Wenn nein (One-Shot-Sektion auf einer Seite): direkt ins Page-Template.
- **Hat sie Zustand?** Wenn ja: Livewire-Komponente. Wenn nein: Blade-Komponente.
- **Hat sie Varianten?** Split/Grid, primary/secondary, mit/ohne Icon?

### 2. Referenz-Guidelines aufrufen

- `10-design-system.md` für Farb-Tokens, Typografie, Spacing.
- `30-frontend-conventions.md` für Blade-/Livewire-Konventionen.
- `50-accessibility.md` für Focus-, ARIA-, Keyboard-Anforderungen.

Keine Farbwerte raten. Nur semantische Tokens: `bg-bg`, `text-ink`, `bg-accent`, `text-muted`, `border-line`.

### 3. Existierende Komponenten prüfen

Vor dem Neubau:

```bash
find vendor/officetalk/officetalk/resources/views/components -name "*.blade.php"
```

Oder via Boost-MCP `list-files` im Komponenten-Pfad. Eine neue „Card"-Variante ist oft nur ein weiteres Layout-Prop auf `video-card`, keine neue Komponente.

### 4. Komponenten-Klasse anlegen

Template für eine typische Blade-Komponente im Paket:

```php
<?php

declare(strict_types=1);

namespace Officetalk\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewComponent extends Component
{
    public function __construct(
        public string $variant = 'default',
        public ?string $label = null,
    ) {}

    public function render(): View
    {
        return view('officetalk::components.{ui|patterns|sections}.new-component');
    }
}
```

Props immer getypt. Default-Werte, falls nicht pflicht.

### 5. Blade-Template schreiben

**Struktur:**

```blade
@props(['variant' => 'default', 'label' => null])

<div {{ $attributes->merge(['class' => 'font-sans text-body text-ink']) }}>
    @if ($label)
        <x-officetalk::eyebrow>{{ $label }}</x-officetalk::eyebrow>
    @endif

    {{ $slot }}
</div>
```

**Regeln:**

- Nur Klassen aus dem Tailwind-Preset. Keine hardcoded HEX-Werte.
- Bestehende Sub-Komponenten (Eyebrow, Button, LogoMark) wiederverwenden, nicht duplizieren.
- `{{ $attributes->merge(...) }}` nutzen, damit Consumer zusätzliche Klassen durchreichen können.
- Semantic HTML: `<article>`, `<section>`, `<nav>` nicht `<div>`.

### 6. Accessibility einbauen

Pflicht:

- Fokus-Sichtbarkeit via `focus-visible`-Utilities (nicht deaktivieren).
- Icon-Only-Buttons: `aria-label="..."`.
- Dekorative Icons: `aria-hidden="true"`.
- Bilder: `alt="..."` beschreibend.
- Heading-Hierarchie innerhalb der Komponente konsistent.

### 7. Reduced-Motion respektieren

Jede Animation braucht eine Reduced-Motion-Variante:

```css
@media (prefers-reduced-motion: reduce) {
    .your-animated-class {
        transition: none;
        animation: none;
    }
}
```

Oder klassenfrei via Tailwind-Preset (`transition-all motion-reduce:transition-none`).

### 8. Host-Projekt-Integration

Sobald die Komponente im Paket liegt, ist sie automatisch als `<x-officetalk::...>` verfügbar. Keine Publish-Aktion nötig, außer Overrides werden gewünscht – dann:

```bash
php artisan vendor:publish --tag=officetalk-views
```

Kopiert die Views nach `resources/views/vendor/officetalk/`, wo sie im Host-Projekt überschrieben werden können.

### 9. Testen

**Blade-Komponente:**

```php
// tests/Feature/Components/NewComponentTest.php
use function Pest\Laravel\blade;

it('renders with default variant', function () {
    $output = blade('<x-officetalk::new-component />');
    expect($output)->toContain('font-sans');
});
```

**Livewire-Komponente:**

```php
use Livewire\Livewire;
use Officetalk\Http\Livewire\MyComponent;

it('renders', function () {
    Livewire::test(MyComponent::class)->assertOk();
});
```

### 10. Visuelle Regression

Optional, aber empfohlen bei kritischen Layout-Komponenten (Hero, Video-Card, Nav):

```bash
npx playwright test --update-snapshots
```

## Varianten-Pattern

Für Komponenten mit mehreren visuellen Modi (Button, Video-Card):

```php
class Button extends Component
{
    public function classes(): string
    {
        $base = 'inline-flex items-center gap-2 rounded px-6 py-3 font-sans font-semibold';

        return match ($this->variant) {
            'primary' => "{$base} bg-accent text-ink hover:bg-accent-hover",
            'secondary' => "{$base} bg-transparent border-[1.5px] border-ink text-ink",
            default => $base,
        };
    }
}
```

`match` statt Switch-Statement, und Klassen-Listen als String in der Klasse, nicht im Template (hält das Template lesbar).

## Typische Fehler

- Hardcoded Farb-HEX im Blade statt Token-Klassen.
- Neue Komponente, obwohl eine Variant-Prop-Erweiterung gereicht hätte.
- `<div>`-Salat statt semantischer HTML-Tags.
- `transition: all` ohne Reduced-Motion-Fallback.
- Props nicht getypt, Default-Werte in der render-Methode statt im Konstruktor.
- View-Namespace vergessen: `view('components.button')` statt `view('officetalk::components.ui.button')`.
- Component-Namespace-Registrierung: Für Pakete läuft das über `Blade::componentNamespace(...)` im ServiceProvider, bereits konfiguriert – keine manuelle Registrierung nötig.
