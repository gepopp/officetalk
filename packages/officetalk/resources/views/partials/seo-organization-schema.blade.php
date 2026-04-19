@php
    $seo = config('officetalk.seo');
    $contact = config('officetalk.contact');
    $org = $seo['organization'];

    $schema = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        '@id' => url('/#organization'),
        'name' => $contact['brand_name'],
        'legalName' => $contact['legal_name'],
        'description' => $org['description'],
        'url' => $seo['site_url'],
        'logo' => url($org['logo']),
        'image' => url($seo['default_image']['url']),
        'telephone' => $contact['phone'] !== '[Telefonnummer]' ? $contact['phone'] : null,
        'email' => $contact['email'],
        'priceRange' => $org['price_range'],
        'address' => array_filter([
            '@type' => 'PostalAddress',
            'streetAddress' => $contact['address']['street'],
            'postalCode' => $contact['address']['postal_code'],
            'addressLocality' => $contact['address']['city'],
            'addressRegion' => 'Wien',
            'addressCountry' => 'AT',
        ]),
        'areaServed' => array_map(fn ($country) => [
            '@type' => 'Country',
            'name' => $country,
        ], $org['area_served']),
        'founder' => [
            '@type' => 'Person',
            'name' => 'Gerhard Popp',
        ],
        'foundingDate' => (string) $org['founding_year'],
        'sameAs' => array_values(array_filter([
            $contact['linkedin_url'] ?? null,
        ])),
    ], fn ($value) => $value !== null && $value !== []);
@endphp

<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
