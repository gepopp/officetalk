<?php

declare(strict_types=1);

namespace Officetalk\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Officetalk\Database\Factories\EpisodeFactory;
use Officetalk\Support\CdnUrl;

class Episode extends Model
{
    use HasFactory;

    protected $table = 'officetalk_episodes';

    protected static function newFactory(): EpisodeFactory
    {
        return EpisodeFactory::new();
    }

    protected $fillable = [
        'number',
        'slug',
        'title',
        'eyebrow',
        'abstract',
        'lead_quote',
        'guest_id',
        'vimeo_id',
        'linkedin_url',
        'spotify_url',
        'transcript_markdown',
        'still_landscape',
        'still_square',
        'thumbnail_linkedin',
        'duration_minutes',
        'published_at',
        'is_featured',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
            'duration_minutes' => 'integer',
            'number' => 'integer',
        ];
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(
            Topic::class,
            'officetalk_episode_topic',
            'episode_id',
            'topic_id',
        );
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    protected function episodeLabel(): Attribute
    {
        return Attribute::get(fn (): string => 'OfficeTalk #'.str_pad((string) $this->number, 3, '0', STR_PAD_LEFT));
    }

    protected function stillLandscapeUrl(): Attribute
    {
        return Attribute::get(fn (): string => CdnUrl::for($this->still_landscape));
    }

    protected function stillSquareUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->still_square
            ? CdnUrl::for($this->still_square)
            : null);
    }

    protected function resolvedMetaTitle(): Attribute
    {
        return Attribute::get(fn (): string => $this->meta_title
            ?? "{$this->title} – {$this->episodeLabel}"
        );
    }

    protected function resolvedMetaDescription(): Attribute
    {
        return Attribute::get(fn (): string => $this->meta_description
            ?? str($this->abstract)->limit(157)->toString()
        );
    }

    public function vimeoEmbedUrl(): ?string
    {
        if (! $this->vimeo_id) {
            return null;
        }

        $params = http_build_query(config('officetalk.video.vimeo.default_params', []));
        $base = config('officetalk.video.vimeo.player_url', 'https://player.vimeo.com/video/');

        return "{$base}{$this->vimeo_id}?{$params}";
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
