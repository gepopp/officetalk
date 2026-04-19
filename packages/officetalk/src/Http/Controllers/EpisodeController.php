<?php

declare(strict_types=1);

namespace Officetalk\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Officetalk\Models\Episode;

class EpisodeController extends Controller
{
    public function index(): View
    {
        return view('officetalk::episodes.index');
    }

    public function show(Episode $episode): View
    {
        abort_unless($episode->published_at?->isPast(), 404);

        $episode->load(['guest', 'topics']);

        $related = Episode::query()
            ->published()
            ->whereKeyNot($episode->id)
            ->whereHas('topics', fn ($q) => $q->whereIn('topic_id', $episode->topics->pluck('id')))
            ->with(['guest'])
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('officetalk::episodes.show', [
            'episode' => $episode,
            'related' => $related,
        ]);
    }
}
