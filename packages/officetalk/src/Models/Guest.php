<?php

declare(strict_types=1);

namespace Officetalk\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Officetalk\Database\Factories\GuestFactory;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'officetalk_guests';

    protected static function newFactory(): GuestFactory
    {
        return GuestFactory::new();
    }

    protected $fillable = [
        'slug',
        'first_name',
        'last_name',
        'role',
        'company',
        'company_url',
        'linkedin_url',
        'portrait',
        'bio_short',
        'bio_long',
    ];

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::get(fn (): string => trim("{$this->first_name} {$this->last_name}"));
    }

    protected function roleLine(): Attribute
    {
        return Attribute::get(fn (): string => "{$this->role}, {$this->company}");
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
