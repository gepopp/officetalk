<figure {{ $attributes->merge(['class' => 'officetalk-pullquote my-s5']) }}>
    <blockquote class="font-display text-2xl leading-snug italic text-ink md:text-[28px]">
        {{ $slot }}
    </blockquote>
    @if ($author)
        <figcaption class="mt-s2 font-sans text-meta text-muted not-italic">
            — {{ $author }}
        </figcaption>
    @endif
</figure>
