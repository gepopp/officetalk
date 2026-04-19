{{-- OfficeTalk Cookie-Consent-Banner · editorial Überarbeitung im Site-Stil.
     Logik des Whitecube-Pakets bleibt, Tailwind-Klassen ersetzen die generierten Styles. --}}
<aside
    id="cookies-policy"
    data-officetalk-consent
    class="officetalk-consent cookies cookies--no-js fixed inset-x-0 bottom-0 z-[90] bg-surface-strong text-bg drak:text-white shadow-[0_-16px_48px_-16px_rgba(17,17,17,0.3)]"
    data-text="{{ json_encode(__('cookieConsent::cookies.details')) }}"
>
    <div class="cookies__alert">
        <div class="cookies__container mx-auto max-w-[1280px] px-s3 py-s4 md:px-s5 md:py-s5">
            <div class="cookies__wrapper grid gap-s4 md:grid-cols-12 md:items-center md:gap-s5">

                {{-- Eyebrow + Titel + Intro --}}
                <div class="md:col-span-7 lg:col-span-8">
                    <p class="font-sans text-eyebrow uppercase tracking-[0.12em] text-accent">
                        @lang('cookieConsent::cookies.title')
                    </p>
                    <div class="cookies__intro mt-s2 font-sans text-body leading-relaxed text-bg/90 drak:text-white">
                        <p>@lang('cookieConsent::cookies.intro')</p>
                        @if($policy)
                            <p class="mt-s1 font-sans text-meta text-bg/70 drak:text-white">
                                @lang('cookieConsent::cookies.link', ['url' => $policy])
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Action-Buttons · Accept all + Essentials only --}}
                <div class="cookies__actions flex flex-col gap-s2 md:col-span-5 md:items-end md:justify-end lg:col-span-4">
                    @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'cookiesBtn cookiesBtn--accept officetalk-consent-btn officetalk-consent-btn--accent'])
                    @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'cookiesBtn cookiesBtn--essentials officetalk-consent-btn officetalk-consent-btn--outline'])
                </div>
            </div>
        </div>

        {{-- Customize-Toggle · öffnet per #anchor das Detail-Panel --}}
        <a
            href="#cookies-policy-customize"
            class="cookies__btn cookies__btn--customize mx-auto flex max-w-[1280px] items-center justify-between gap-s2 border-t border-bg/15 px-s3 py-s3 font-sans text-meta text-bg/80 transition-colors duration-200 hover:text-accent md:px-s5"
        >
            <span>@lang('cookieConsent::cookies.customize')</span>
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true" class="transition-transform duration-300">
                <path d="M4 7 L10 13 L16 7" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>

        {{-- Expandable · Detail-Konfiguration pro Kategorie --}}
        <div
            class="cookies__expandable cookies__expandable--custom border-t border-bg/15 bg-surface-strong"
            id="cookies-policy-customize"
        >
            <form
                action="{{ route('cookieconsent.accept.configuration') }}"
                method="post"
                class="cookies__customize mx-auto max-w-[1280px] px-s3 py-s5 md:px-s5 md:py-s6"
            >
                @csrf
                <div class="cookies__sections grid gap-s4 md:grid-cols-2">
                    @foreach($cookies->getCategories() as $category)
                        <div class="cookies__section border-t border-bg/20 pt-s3">
                            <label for="cookies-policy-check-{{ $category->key() }}" class="cookies__category flex cursor-pointer flex-col gap-s2">
                                <div class="flex items-start gap-s2">
                                    @if ($category->key() === 'essentials')
                                        <input type="hidden" name="categories[]" value="{{ $category->key() }}" />
                                        <input
                                            type="checkbox"
                                            name="categories[]"
                                            value="{{ $category->key() }}"
                                            id="cookies-policy-check-{{ $category->key() }}"
                                            checked="checked"
                                            disabled="disabled"
                                            class="mt-[3px] h-5 w-5 shrink-0 accent-accent"
                                        />
                                    @else
                                        <input
                                            type="checkbox"
                                            name="categories[]"
                                            value="{{ $category->key() }}"
                                            id="cookies-policy-check-{{ $category->key() }}"
                                            class="mt-[3px] h-5 w-5 shrink-0 accent-accent"
                                        />
                                    @endif
                                    <span class="cookies__box">
                                        <strong class="cookies__label font-display text-h4 font-medium not-italic text-bg drak:text-white">
                                            {{ $category->title }}
                                        </strong>
                                    </span>
                                </div>

                                @if($category->description)
                                    <p class="cookies__info font-sans text-meta leading-relaxed text-bg/75 md:pl-s5">
                                        {{ $category->description }}
                                    </p>
                                @endif
                            </label>

                            <div class="cookies__expandable" id="cookies-policy-{{ $category->key() }}">
                                <ul class="cookies__definitions mt-s3 space-y-s2 border-t border-bg/15 pt-s3 md:ml-s5">
                                    @foreach($category->getCookies() as $cookie)
                                        <li class="cookies__cookie">
                                            <p class="cookies__name font-sans text-meta font-semibold text-bg drak:text-white">{{ $cookie->name }}</p>
                                            <p class="cookies__duration font-sans text-eyebrow uppercase tracking-[0.08em] text-bg/60 drak:text-white">
                                                {{ Carbon\Carbon::now()->diffForHumans(Carbon\Carbon::now()->addMinutes($cookie->duration), true) }}
                                            </p>
                                            @if($cookie->description)
                                                <p class="cookies__description mt-s1 font-sans text-meta leading-relaxed text-bg/75">
                                                    {{ $cookie->description }}
                                                </p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <a
                                href="#cookies-policy-{{ $category->key() }}"
                                class="cookies__details mt-s2 inline-block font-sans text-meta text-bg/70 drak:text-white underline underline-offset-2 transition-colors duration-200 hover:text-accent md:ml-s5"
                            >
                                @lang('cookieConsent::cookies.details.more')
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="cookies__save mt-s5 border-t border-bg/20 pt-s4">
                    <button
                        type="submit"
                        class="officetalk-consent-btn officetalk-consent-btn--accent"
                    >
                        @lang('cookieConsent::cookies.save')
                    </button>
                </div>
            </form>
        </div>
    </div>
</aside>

{{-- Essentielles Paket-JavaScript · steuert Expand/Collapse + Consent-Submission --}}
<script data-cookie-consent>
    {!! file_get_contents(LCC_ROOT . '/dist/script.js') !!}
</script>

<style data-cookie-consent>
    /* OfficeTalk Consent-Styling · überschreibt Paket-Defaults, ergänzt um CSS-Variablen der Seite */
    [data-officetalk-consent] {
        font-family: var(--font-sans);
    }
    [data-officetalk-consent].cookies--no-js {
        display: none;
    }
    /* Expand-Animation ist JS-gesteuert: Paket setzt style="height: Xpx" als inline-Style
       und toggled .cookies__expandable--open. CSS hier nur für den geschlossenen Grundzustand
       plus die Transition. Nicht max-height benutzen — das überschreibt die JS-Inline-Höhe. */
    [data-officetalk-consent] .cookies__expandable {
        height: 0;
        overflow: hidden;
        transition: height 0.3s cubic-bezier(0.22, 1, 0.36, 1);
    }
    [data-officetalk-consent] .cookies__expandable--open {
        height: auto;
    }
    [data-officetalk-consent] .cookies__btn--customize {
        text-decoration: none;
    }
    [data-officetalk-consent] .cookies__btn--customize:hover svg {
        transform: translateY(2px);
    }
    /* Button-Basis · beide Varianten */
    .officetalk-consent-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        font-family: var(--font-sans);
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid transparent;
        transition: background-color 0.2s, color 0.2s, border-color 0.2s;
        cursor: pointer;
        line-height: 1.2;
    }
    .officetalk-consent-btn:focus-visible {
        outline: 2px solid var(--color-accent);
        outline-offset: 2px;
    }
    /* Primary-Variante · Accent-Fläche */
    .officetalk-consent-btn--accent {
        background-color: var(--color-accent);
        color: #111;
        border-color: var(--color-accent);
    }
    .officetalk-consent-btn--accent:hover {
        background-color: #111;
        color: var(--color-accent);
        border-color: #111;
    }
    /* Outline-Variante · transparent mit beige Border */
    .officetalk-consent-btn--outline {
        background-color: transparent;
        color: var(--color-bg);
        border-color: rgba(250, 250, 247, 0.4);
    }
    .officetalk-consent-btn--outline:hover {
        background-color: var(--color-bg);
        color: var(--color-ink);
        border-color: var(--color-bg);
    }
    /* Form-Button im Customize-Panel spiegelt Accent-Variante */
    .cookies__save .officetalk-consent-btn {
        width: auto;
    }
    /* Die Form selbst · verschachtelte Action-Buttons erhalten gleiches Styling */
    .cookiesBtn > form,
    .cookiesBtn {
        display: inline-block;
    }
    .cookiesBtn__link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }
    /* Verhindert Paket-Default-Styles · unser <style> steht nach dem eingefügten Paket-CSS */
    [data-officetalk-consent] .cookies__title,
    [data-officetalk-consent] .cookies__label,
    [data-officetalk-consent] .cookies__info,
    [data-officetalk-consent] .cookies__intro,
    [data-officetalk-consent] .cookies__btn,
    [data-officetalk-consent] .cookies__details {
        color: inherit;
    }
    @media (max-width: 767px) {
        [data-officetalk-consent] .officetalk-consent-btn {
            width: 100%;
        }
    }
</style>
