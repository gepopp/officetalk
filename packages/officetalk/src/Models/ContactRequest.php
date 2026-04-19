<?php

declare(strict_types=1);

namespace Officetalk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ContactRequest extends Model
{
    protected $table = 'officetalk_contact_requests';

    protected $fillable = [
        'company',
        'contact_name',
        'email',
        'role',
        'occasion',
        'preferred_timing',
        'confirmation_token',
        'confirmed_at',
        'summary_sent_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'summary_sent_at' => 'datetime',
    ];

    /**
     * Die Label für die Branche im lesbaren Format.
     *
     * @var array<string, string>
     */
    public static array $roleLabels = [
        'bautraeger' => 'Bauträger / Projektentwicklung',
        'immobilien-konzern' => 'Immobilien-Konzern',
        'kanzlei' => 'Kanzlei (Recht, Steuer, WP)',
        'architektur' => 'Architektur / Planung',
        'proptech' => 'PropTech',
        'sonstige' => 'Sonstige',
    ];

    public function roleLabel(): string
    {
        return self::$roleLabels[$this->role] ?? $this->role;
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed_at !== null;
    }

    public function markConfirmed(): void
    {
        $this->confirmed_at = Carbon::now();
        $this->save();
    }

    public function markSummarySent(): void
    {
        $this->summary_sent_at = Carbon::now();
        $this->save();
    }

    public function getRouteKeyName(): string
    {
        return 'confirmation_token';
    }

    public static function generateToken(): string
    {
        return Str::random(64);
    }

    public function confirmationUrl(): string
    {
        return route('officetalk.contact.confirm', ['token' => $this->confirmation_token]);
    }
}
