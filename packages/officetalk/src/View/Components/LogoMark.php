<?php

declare(strict_types=1);

namespace Officetalk\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LogoMark extends Component
{
    public function __construct(
        public int $size = 32,
        public string $color = 'currentColor',
        public string $variant = 'color',
    ) {}

    public function render(): View
    {
        return view('officetalk::components.ui.logo-mark');
    }
}
