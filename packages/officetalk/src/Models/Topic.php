<?php

declare(strict_types=1);

namespace Officetalk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Officetalk\Database\Factories\TopicFactory;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'officetalk_topics';

    protected static function newFactory(): TopicFactory
    {
        return TopicFactory::new();
    }

    protected $fillable = [
        'slug',
        'name',
        'description',
    ];

    public function episodes(): BelongsToMany
    {
        return $this->belongsToMany(
            Episode::class,
            'officetalk_episode_topic',
            'topic_id',
            'episode_id',
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
