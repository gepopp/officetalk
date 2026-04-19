<?php

declare(strict_types=1);

namespace Officetalk\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Officetalk\Models\Guest;

class GuestController extends Controller
{
    public function show(Guest $guest): View
    {
        $guest->load(['episodes' => fn ($q) => $q->published()->orderByDesc('published_at')]);

        return view('officetalk::guests.show', [
            'guest' => $guest,
        ]);
    }
}
