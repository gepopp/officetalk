<?php

declare(strict_types=1);

namespace Officetalk\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pullquote extends Component
{
    public function __construct(
        public ?string $author = null,
    ) {}

    public function render(): View
    {
        return view('officetalk::components.ui.pullquote');
    }
}
