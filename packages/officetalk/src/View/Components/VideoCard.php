<?php

declare(strict_types=1);

namespace Officetalk\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Officetalk\Models\Episode;

class VideoCard extends Component
{
    public function __construct(
        public Episode $episode,
        public string $layout = 'split',
    ) {}

    public function render(): View
    {
        return view('officetalk::components.patterns.video-card');
    }
}
