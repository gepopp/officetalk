<?php

declare(strict_types=1);

use Officetalk\Models\Episode;
use Officetalk\Models\Guest;
use Officetalk\Models\Topic;

it('generates a proper episode label', function (): void {
    $episode = Episode::factory()->make(['number' => 47]);

    expect($episode->episode_label)->toBe('OfficeTalk #047');
});

it('scopes published episodes', function (): void {
    Episode::factory()->create(['published_at' => now()->subDay()]);
    Episode::factory()->draft()->create();
    Episode::factory()->scheduled()->create();

    expect(Episode::published()->count())->toBe(1);
});

it('limits featured episodes for hero slot', function (): void {
    Episode::factory()->featured()->create();
    Episode::factory()->count(3)->create();

    expect(Episode::featured()->count())->toBe(1);
});

it('resolves cdn urls for stills', function (): void {
    $episode = Episode::factory()->make([
        'still_landscape' => 'officetalk/stills/ep-047-landscape.webp',
    ]);

    expect($episode->still_landscape_url)
        ->toBe('https://cdn.test/officetalk/stills/ep-047-landscape.webp');
});

it('falls back to generated meta description when none is set', function (): void {
    $episode = Episode::factory()->make([
        'abstract' => str_repeat('Ein analytischer Satz mit redaktionellem Anspruch. ', 10),
        'meta_description' => null,
    ]);

    expect(strlen($episode->resolved_meta_description))->toBeLessThanOrEqual(160);
});

it('connects guests to episodes', function (): void {
    $guest = Guest::factory()->create();
    $episode = Episode::factory()->create(['guest_id' => $guest->id]);

    expect($episode->guest->is($guest))->toBeTrue()
        ->and($guest->episodes->first()->is($episode))->toBeTrue();
});

it('attaches topics via pivot', function (): void {
    $episode = Episode::factory()->create();
    $topics = Topic::factory()->count(2)->create();

    $episode->topics()->attach($topics->pluck('id'));

    expect($episode->fresh()->topics)->toHaveCount(2);
});

it('routes by slug, not id', function (): void {
    $episode = Episode::factory()->make();

    expect($episode->getRouteKeyName())->toBe('slug');
});
