/**
 * OfficeTalk Tailwind Preset
 * ---------------------------
 * Im Host-Projekt in tailwind.config.js einbinden:
 *
 *   export default {
 *     presets: [require('./tailwind.preset.officetalk.js')],
 *     content: [
 *       './resources/**\/*.blade.php',
 *       './vendor/officetalk/officetalk/resources/views/**\/*.blade.php',
 *       './app/Livewire/**\/*.php',
 *     ],
 *   }
 *
 * Die Farben sind als semantische Keys gesetzt (nicht als Override der
 * Tailwind-Defaultnamen). Im Markup also 'bg-bg', 'text-ink', 'bg-accent'
 * statt 'bg-white', 'text-gray-900', 'bg-yellow-400'.
 */

module.exports = {
    theme: {
        extend: {
            colors: {
                bg: '#FAFAF7',
                surface: '#F2F0EA',
                'surface-strong': '#2B2B28',
                accent: {
                    DEFAULT: '#E3B505',
                    hover: '#9A7A04',
                },
                ink: '#111111',
                muted: '#5A5A55',
                line: '#E4E2DB',
                success: '#2F6E3F',
                warning: '#B8501C',
            },
            fontFamily: {
                display: ['"Fraunces"', 'Georgia', 'serif'],
                sans: ['"Inter"', 'system-ui', '-apple-system', 'sans-serif'],
            },
            fontSize: {
                // Eyebrow-Labels
                'eyebrow': ['13px', { lineHeight: '1.2', letterSpacing: '0.08em', fontWeight: '600' }],
                // Body-Skala
                'meta': ['14px', { lineHeight: '1.45', letterSpacing: '0.01em' }],
                'body': ['17px', { lineHeight: '1.60' }],
                'lead': ['20px', { lineHeight: '1.55' }],
                // Display-Skala
                'h4': ['22px', { lineHeight: '1.20', letterSpacing: '-0.005em' }],
                'h3': ['30px', { lineHeight: '1.15', letterSpacing: '-0.01em' }],
                'h2': ['44px', { lineHeight: '1.10', letterSpacing: '-0.015em' }],
                'h1': ['72px', { lineHeight: '1.05', letterSpacing: '-0.02em' }],
            },
            spacing: {
                's1': '8px',
                's2': '16px',
                's3': '24px',
                's4': '32px',
                's5': '48px',
                's6': '64px',
                's7': '96px',
            },
            borderRadius: {
                DEFAULT: '4px',
                sm: '2px',
                md: '4px',
                lg: '4px',
            },
            transitionTimingFunction: {
                'editorial': 'cubic-bezier(0.65, 0, 0.35, 1)',
            },
            transitionDuration: {
                '180': '180ms',
                '220': '220ms',
                '240': '240ms',
                '600': '600ms',
                '900': '900ms',
            },
            maxWidth: {
                'editorial': '1280px',
                'measure': '68ch',
            },
            boxShadow: {
                'card-hover': '0 12px 32px rgba(17, 17, 17, 0.12)',
            },
        },
    },
    corePlugins: {
        // Dark-Mode ist in OfficeTalk nicht vorgesehen.
        // Redaktionelle Magazin-Logik bleibt Light-Only.
    },
    plugins: [],
};
