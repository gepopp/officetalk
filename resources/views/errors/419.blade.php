@extends('errors.layout')

@section('title', '419 · Sitzung abgelaufen')
@section('eyebrow', 'Fehler 419 — Sitzung abgelaufen.')
@section('code', '419')
@section('headline', 'Ihre Sitzung ist abgelaufen.')
@section('subline', 'Aus Sicherheitsgründen wurde Ihre Session zurückgesetzt. Laden Sie die Seite neu und wiederholen Sie Ihre letzte Aktion.')

@section('secondary-cta')
    <button
        type="button"
        onclick="window.location.reload()"
        class="inline-flex items-center gap-s2 border border-ink bg-transparent px-s4 py-s3 font-sans text-body font-semibold text-ink transition-colors duration-200 hover:bg-ink hover:text-bg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ink"
    >
        Seite neu laden
    </button>
@endsection
