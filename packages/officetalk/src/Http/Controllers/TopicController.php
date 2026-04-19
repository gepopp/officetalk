<?php

declare(strict_types=1);

namespace Officetalk\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Officetalk\Models\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic): View
    {
        $topic->load(['episodes' => fn ($q) => $q->published()
            ->with('guest')
            ->orderByDesc('published_at'),
        ]);

        return view('officetalk::topics.show', [
            'topic' => $topic,
        ]);
    }
}
