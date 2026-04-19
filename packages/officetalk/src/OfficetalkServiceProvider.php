<?php

declare(strict_types=1);

namespace Officetalk;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Officetalk\Http\Livewire\ContactForm;
use Officetalk\Http\Livewire\EpisodeArchive;

class OfficetalkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/officetalk.php', 'officetalk');
    }

    public function boot(): void
    {
        $this->registerViews();
        $this->registerLivewireComponents();
        $this->registerMigrations();
        $this->registerPublishables();
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'officetalk');

        Blade::componentNamespace('Officetalk\\View\\Components', 'officetalk');
    }

    private function registerLivewireComponents(): void
    {
        if (! class_exists(Livewire::class)) {
            return;
        }

        Livewire::component('officetalk.episode-archive', EpisodeArchive::class);
        Livewire::component('officetalk.contact-form', ContactForm::class);
    }

    private function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    private function registerPublishables(): void
    {
        // Config
        $this->publishes([
            __DIR__.'/../config/officetalk.php' => config_path('officetalk.php'),
        ], 'officetalk-config');

        // Views (für Overrides im Host-Projekt)
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/officetalk'),
        ], 'officetalk-views');

        // Assets (CSS-Tokens, JS-Animationen)
        $this->publishes([
            __DIR__.'/../resources/css' => resource_path('css/vendor/officetalk'),
            __DIR__.'/../resources/js' => resource_path('js/vendor/officetalk'),
        ], 'officetalk-assets');

        // Tailwind-Preset
        $this->publishes([
            __DIR__.'/../stubs/tailwind.preset.js' => base_path('tailwind.preset.officetalk.js'),
        ], 'officetalk-tailwind');

        // AI-Guidelines für Boost und Claude Code
        $this->publishes([
            __DIR__.'/../stubs/ai/guidelines' => base_path('.ai/guidelines/officetalk'),
        ], 'officetalk-guidelines');

        // Agent Skills
        $this->publishes([
            __DIR__.'/../stubs/claude/skills' => base_path('.claude/skills'),
        ], 'officetalk-skills');

        // Komplett-Install (alles auf einmal)
        $this->publishes([
            __DIR__.'/../config/officetalk.php' => config_path('officetalk.php'),
            __DIR__.'/../stubs/ai/guidelines' => base_path('.ai/guidelines/officetalk'),
            __DIR__.'/../stubs/claude/skills' => base_path('.claude/skills'),
            __DIR__.'/../stubs/tailwind.preset.js' => base_path('tailwind.preset.officetalk.js'),
        ], 'officetalk');
    }
}
