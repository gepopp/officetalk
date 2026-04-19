<?php

declare(strict_types=1);

namespace Officetalk\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VideoPlayer extends Component
{
    public function __construct(
        public ?string $vimeoId = null,
        public ?string $title = null,
        public ?string $posterUrl = null,
        public string $posterAlt = '',
        public bool $eager = false,
    ) {}

    public function render(): View
    {
        return view('officetalk::components.ui.video-player');
    }
}
