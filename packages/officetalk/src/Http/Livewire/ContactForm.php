<?php

declare(strict_types=1);

namespace Officetalk\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Officetalk\Mail\ContactConfirmationMail;
use Officetalk\Models\ContactRequest;

class ContactForm extends Component
{
    #[Validate('nullable|string|max:255')]
    public string $company = '';

    #[Validate('required|string|max:255')]
    public string $contact_name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|in:bautraeger,immobilien-konzern,kanzlei,architektur,proptech,sonstige')]
    public string $role = '';

    #[Validate('required|string|min:20|max:2000')]
    public string $occasion = '';

    #[Validate('nullable|string|max:100')]
    public string $preferred_timing = '';

    // Honeypot
    #[Validate('prohibited')]
    public string $website = '';

    public bool $submitted = false;

    public function submit(): void
    {
        $this->validate();

        $contactRequest = ContactRequest::create([
            'company' => $this->company ?: '—',
            'contact_name' => $this->contact_name,
            'email' => $this->email,
            'role' => $this->role ?: 'sonstige',
            'occasion' => $this->occasion,
            'preferred_timing' => $this->preferred_timing ?: null,
            'confirmation_token' => ContactRequest::generateToken(),
        ]);

        try {
            Mail::to($contactRequest->email, $contactRequest->contact_name)
                ->send(new ContactConfirmationMail($contactRequest));
        } catch (\Throwable $e) {
            Log::error('OfficeTalk ContactConfirmationMail fehlgeschlagen', [
                'id' => $contactRequest->id,
                'email' => $contactRequest->email,
                'error' => $e->getMessage(),
            ]);
        }

        $this->submitted = true;
        $this->reset(['company', 'contact_name', 'email', 'role', 'occasion', 'preferred_timing']);
    }

    public function render(): View
    {
        return view('officetalk::livewire.contact-form');
    }
}
