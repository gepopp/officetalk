<?php

declare(strict_types=1);

namespace Officetalk\Support;

class CdnUrl
{
    /**
     * Liefert eine CDN-URL für einen Medien-Pfad.
     * Absolute URLs werden unverändert zurückgegeben.
     */
    public static function for(?string $path): string
    {
        if (blank($path)) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $base = rtrim((string) config('officetalk.media.cdn_base'), '/');
        $path = ltrim($path, '/');

        return "{$base}/{$path}";
    }
}
