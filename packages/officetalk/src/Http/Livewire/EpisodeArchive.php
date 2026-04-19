<?php

declare(strict_types=1);

namespace Officetalk\Http\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Officetalk\Models\Episode;
use Officetalk\Models\Topic;

class EpisodeArchive extends Component
{
    use WithPagination;

    #[Url(as: 'thema')]
    public ?string $topicSlug = null;

    #[Url(as: 'q')]
    public string $search = '';

    public function updatingTopicSlug(): void
    {
        $this->resetPage();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->topicSlug = null;
        $this->search = '';
        $this->resetPage();
    }

    public function render(): View
    {
        return view('officetalk::livewire.episode-archive', [
            'episodes' => $this->episodes(),
            'topics' => Topic::query()->orderBy('name')->get(),
        ]);
    }

    private function episodes(): LengthAwarePaginator
    {
        return Episode::query()
            ->published()
            ->with(['guest', 'topics'])
            ->when($this->topicSlug, fn ($q, $slug) => $q->whereHas('topics', fn ($q) => $q->where('slug', $slug)))
            ->when($this->search, function ($q, $term): void {
                $q->where(function ($q) use ($term): void {
                    $q->where('title', 'like', "%{$term}%")
                        ->orWhere('abstract', 'like', "%{$term}%")
                        ->orWhereHas('guest', fn ($q) => $q
                            ->where('last_name', 'like', "%{$term}%")
                            ->orWhere('company', 'like', "%{$term}%")
                        );
                });
            })
            ->orderByDesc('published_at')
            ->paginate(config('officetalk.pagination.episodes_per_page', 12));
    }
}
