<?php

declare(strict_types=1);

namespace Officetalk\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public string $variant = 'primary',
        public ?string $href = null,
        public ?string $icon = null,
        public string $iconPosition = 'left',
        public bool $arrow = true,
    ) {}

    public function classes(): string
    {
        $base = 'group relative inline-flex items-center gap-2 rounded px-6 py-3 font-sans font-semibold text-base'
            .' transition-[background-color,color,border-color,transform,box-shadow] duration-300 ease-editorial'
            .' focus-visible:outline focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-ink'
            .' motion-safe:hover:-translate-y-0.5 motion-safe:active:translate-y-0 motion-safe:active:duration-100';

        return match ($this->variant) {
            'primary' => "{$base} bg-accent text-accent-content hover:bg-accent-hover hover:text-bg"
                .' motion-safe:hover:shadow-[0_14px_30px_-12px_rgba(17,17,17,0.28)] motion-safe:active:shadow-none',
            'secondary' => "{$base} bg-transparent text-ink border-[1.5px] border-ink hover:bg-ink hover:text-bg"
                .' motion-safe:hover:shadow-[0_14px_30px_-12px_rgba(17,17,17,0.22)] motion-safe:active:shadow-none',
            'ghost' => 'inline-flex items-center gap-1 font-sans font-medium text-ink officetalk-link',
            default => $base,
        };
    }

    public function render(): View
    {
        return view('officetalk::components.ui.button');
    }
}
