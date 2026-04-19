<?php

declare(strict_types=1);

namespace Officetalk\Support;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VimeoClient
{
    /**
     * Holt die aktuellsten Videos des authentifizierten Accounts, die den
     * gegebenen Tag tragen. Case-insensitive Match. Cacht 30 Minuten.
     *
     * @return array<int, array{id:string,title:?string,link:?string,thumbnail:?string}>
     */
    public static function latestByTag(string $tag, int $limit = 4): array
    {
        $token = config('services.vimeo.access');
        if (! $token) {
            return [];
        }

        $cacheKey = 'officetalk.vimeo.latest.'.strtolower($tag).'.'.$limit;

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($tag, $token, $limit): array {
            try {
                $response = self::request($token)->get('https://api.vimeo.com/me/videos', [
                    'per_page' => 100,
                    'sort' => 'date',
                    'direction' => 'desc',
                    'fields' => 'uri,name,link,tags.name,pictures.sizes',
                ]);

                if ($response->failed()) {
                    Log::warning('Vimeo-API Fehler', ['status' => $response->status(), 'body' => $response->body()]);

                    return [];
                }

                $needle = strtolower($tag);
                $matched = [];

                foreach ($response->json('data', []) as $video) {
                    $tags = array_map(
                        fn ($t) => strtolower((string) ($t['name'] ?? '')),
                        $video['tags'] ?? [],
                    );

                    if (! in_array($needle, $tags, true) || empty($video['uri'])) {
                        continue;
                    }

                    $matched[] = [
                        'id' => basename((string) $video['uri']),
                        'title' => $video['name'] ?? null,
                        'link' => $video['link'] ?? null,
                        'thumbnail' => self::pickThumbnail($video['pictures']['sizes'] ?? [], 640),
                    ];

                    if (count($matched) >= $limit) {
                        break;
                    }
                }

                return $matched;
            } catch (\Throwable $e) {
                Log::warning('Vimeo-API Ausnahme', ['error' => $e->getMessage(), 'tag' => $tag]);

                return [];
            }
        });
    }

    /**
     * Wählt aus der Vimeo-pictures.sizes-Liste die kleinste Variante,
     * die mindestens $targetWidth Pixel breit ist. Fallback: größte verfügbare.
     *
     * @param  array<int, array{width?:int,link?:string}>  $sizes
     */
    private static function pickThumbnail(array $sizes, int $targetWidth): ?string
    {
        if (empty($sizes)) {
            return null;
        }

        usort($sizes, fn ($a, $b) => ($a['width'] ?? 0) <=> ($b['width'] ?? 0));

        foreach ($sizes as $size) {
            if (($size['width'] ?? 0) >= $targetWidth) {
                return $size['link'] ?? null;
            }
        }

        return end($sizes)['link'] ?? null;
    }

    private static function request(string $token): PendingRequest
    {
        $request = Http::withToken($token)
            ->acceptJson()
            ->timeout(8);

        if (app()->environment('local')) {
            $request = $request->withoutVerifying();
        }

        return $request;
    }
}
